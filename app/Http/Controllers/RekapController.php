<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Satpam;
use App\Models\Regu;
use App\Models\Tugas;
use App\Models\Zona;
use App\Models\Pos;
use App\Models\PosSatpam;
use App\Models\Pamswakarsa;
use App\Models\DetailShift;
use App\Models\Produksi;
use App\Models\Pemindahan;
use App\Models\GiatArmada;
use App\Models\Inventaris;
use App\Models\RekapTugas;



class RekapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) //optional request for datepicker
    {
        if(!is_null($request->datepicker)){
            $date = $request->datepicker;
        }else{
            $date = date('Y-m-d');
        }

        $page_title = 'Rekap';
        $page_description = 'Some description for the page';
        $logo = "images/petro-logo.png";
        $logoText = "images/petro-text.png";
        $action = __FUNCTION__;

        $leveluser = Auth::user()->level_user; //mengambil level_user
        if($leveluser == 'admin'){ //check kalau level admin, maka akan ditampilkan dari semua zona
            $satpams = Satpam::all();
            // $regus = Regu::all();
        }else{                      //else, akan ditampilkan sesuai zona masing2 akun
            $userzona = Auth::user()->zona->id;
            $satpams = Satpam::all()->where('zona_id',$userzona);

            //Pergantian Shift
            $tugass = Tugas::whereDate('created_at','=',$date)->where('zona_id', '=', $userzona)->get();

            //Tugas Jaga
            $shifts = array();
            $str_arr = explode("-",$date); //misahin year month day
            $year  = $str_arr[0] ?? date('Y');
            $month = $str_arr[1] ?? date('n');
            $day   = $str_arr[2] ?? date('d');
            $day = ltrim($day, '0');
            $group = null;
            $code = 400;
            if($year < 2020){
                $code = 400;
                $msg = "year must be greater than 2020";
            }

            $schedules = generate_schedule($year);
            if( is_null($group) ){
                $code = 200;
                $data = $schedules[int_to_month($month)][$day]["shift"];
                $msg = "Success fetch data shift on selected day";
            }else{
                $code = 200;
                $data = translate_pattern( $schedules[int_to_month($month)][$day]["shift"][$group] );
                $msg  = "Success fetch data of group $group on selected day";
            }
            $content = [
                "success" => $code==200? True:False,
                "data" => $data ?? null,
                "message" => $msg ?? null,
            ];
            $shifts = array($content['data']['A'],$content['data']['B'],$content['data']['C'],$content['data']['D']);
            $reg = Regu::all();
            foreach($reg as $regu){
                $id = $regu->id;
                $index = $regu->id-1;
                if($shifts[$index]=="p"){
                    $value = '1';
                }elseif($shifts[$index]=="s"){
                    $value = '2';
                }elseif($shifts[$index]=="m"){
                    $value = '3';
                }else{$value = '4';}
                $store_shift = Regu::where('id',$id) //updating shift_id
                    ->update(['shift_id'=>$value]);
            }

            $satpams = Satpam::all()->where('zona_id',$userzona);

            $poss = Pos::all()->where('zona_id', '=', $userzona);
            $pos_array = array();
            foreach($poss as $pos){
                array_push($pos_array, $pos);
            }
            
            $reguA_arr = array();
            $reguB_arr = array(); 
            $reguC_arr = array();
            $reguD_arr = array();
            //memasukkan data satpam ke array sesuai regunya masing2   
            foreach($satpams as $satpam){
                if($satpam->regu->nama == 'Regu A'){
                    array_push($reguA_arr,$satpam);
                }elseif($satpam->regu->nama == 'Regu B'){
                    array_push($reguB_arr,$satpam);
                }elseif($satpam->regu->nama == 'Regu C'){
                    array_push($reguC_arr,$satpam);
                }else{
                    array_push($reguD_arr,$satpam);
                }
            }
            //memasukkan id shift masing2 regu untuk hari ini.
            $shiftA = "";
            foreach ($reguA_arr as $reguA){
                $shiftA =$reguA->regu->shift->id;
            }
            $shiftB = "";
            foreach ($reguB_arr as $reguB){
                $shiftB =$reguB->regu->shift->id;
            }
            $shiftC = "";
            foreach ($reguC_arr as $reguC){
                $shiftC =$reguC->regu->shift->id;
            }
            $shiftD = "";
            foreach ($reguD_arr as $reguD){
                $shiftD =$reguD->regu->shift->id;
            }

            //mengambil detail shift dari shift hari ini
            $detail_shiftA = DetailShift::all()->where('shift_id','=',$shiftA);
            $detail_shiftB = DetailShift::all()->where('shift_id','=',$shiftB);
            $detail_shiftC = DetailShift::all()->where('shift_id','=',$shiftC);
            $detail_shiftD = DetailShift::all()->where('shift_id','=',$shiftD);

            //mengambil data pos satpam hari ini
            $pos_satpams = PosSatpam::whereDate('created_at','=',$date)->get();
            }
            
            //Pamswakarsa
            $pamswakarsas = Pamswakarsa::whereDate('created_at','=',$date)->where('zona_id', '=', $userzona)->get();

            //Produksi
            $produksis = Produksi::whereDate('created_at','=',$date)->where('zona_id', '=', $userzona)->get();

            //Pemindahan
            $pemindahans = Pemindahan::whereDate('created_at','=',$date)->where('zona_id', '=', $userzona)->get();
            
            //Giat Armada
            $giat_armadas = GiatArmada::whereDate('created_at','=',$date)->where('zona_id', '=', $userzona)->get();

            //Inventaris
            $inventariss = Inventaris::whereDate('created_at','=',$date)->where('zona_id', '=', $userzona)->get();

            //Rekap Tugas
            $rekap_tugassA = RekapTugas::whereDate('created_at',$date)
            ->whereHas('satpam', function ($query) use ($userzona) 
            {
                $query->where('zona_id', $userzona)->where('regu_id', '=', '1');
            })->get();

            $rekap_tugassB = RekapTugas::whereDate('created_at',$date)
            ->whereHas('satpam', function ($query) use ($userzona) 
            {
                $query->where('zona_id', $userzona)->where('regu_id', '=', '2');
            })->get();

            $rekap_tugassC = RekapTugas::whereDate('created_at',$date)
            ->whereHas('satpam', function ($query) use ($userzona) 
            {
                $query->where('zona_id', $userzona)->where('regu_id', '3');
            })->get();

            $rekap_tugassD = RekapTugas::whereDate('created_at',$date)
            ->whereHas('satpam', function ($query) use ($userzona) 
            {
                $query->where('zona_id', $userzona)->where('regu_id', '4');
            })->get();

        return view('jurnal.rekap', compact('page_title', 'page_description','action','logo','logoText','tugass', 'satpams',
        'reguA_arr','reguB_arr','reguC_arr','reguD_arr', 'detail_shiftA', 'detail_shiftB','detail_shiftC','detail_shiftD','pos_satpams', 
        'pamswakarsas', 'produksis', 'pemindahans', 'giat_armadas', 'inventariss', 'rekap_tugassA', 'rekap_tugassB', 
        'rekap_tugassC', 'rekap_tugassD', 'date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
