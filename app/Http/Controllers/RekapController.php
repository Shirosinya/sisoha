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
use PDF;



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
            
            $count_tugassA = $tugass->where('regu_id','1')->count();
            $count_tugassB = $tugass->where('regu_id','2')->count();
            $count_tugassC = $tugass->where('regu_id','3')->count();
            $count_tugassD = $tugass->where('regu_id','4')->count();

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

            $satpams = Satpam::orderBy('jabatan', 'ASC')->where('zona_id',$userzona)->get();

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

            $count_pamswakarsasA = $pamswakarsas->where('regu_id','1')->count();
            $count_pamswakarsasB = $pamswakarsas->where('regu_id','2')->count();
            $count_pamswakarsasC = $pamswakarsas->where('regu_id','3')->count();
            $count_pamswakarsasD = $pamswakarsas->where('regu_id','4')->count();

            //Produksi
            $produksis = Produksi::whereDate('created_at','=',$date)->where('zona_id', '=', $userzona)->get();

            $count_produksisA = $produksis->where('regu_id','1')->count();
            $count_produksisB = $produksis->where('regu_id','2')->count();
            $count_produksisC = $produksis->where('regu_id','3')->count();
            $count_produksisD = $produksis->where('regu_id','4')->count();

            //Pemindahan
            $pemindahans = Pemindahan::whereDate('created_at','=',$date)->where('zona_id', '=', $userzona)->get();
            
            $count_pemindahansA = $pemindahans->where('regu_id','1')->count();
            $count_pemindahansB = $pemindahans->where('regu_id','2')->count();
            $count_pemindahansC = $pemindahans->where('regu_id','3')->count();
            $count_pemindahansD = $pemindahans->where('regu_id','4')->count();

            //Giat Armada
            $giat_armadas = GiatArmada::whereDate('created_at','=',$date)->where('zona_id', '=', $userzona)->get();

            $count_giat_armadasA = $giat_armadas->where('regu_id','1')->count();
            $count_giat_armadasB = $giat_armadas->where('regu_id','2')->count();
            $count_giat_armadasC = $giat_armadas->where('regu_id','3')->count();
            $count_giat_armadasD = $giat_armadas->where('regu_id','4')->count();

            //Inventaris
            $inventariss = Inventaris::whereDate('created_at','=',$date)->where('zona_id', '=', $userzona)->get();
            
            $count_inventarissA = $inventariss->where('regu_id','1')->count();
            $count_inventarissB = $inventariss->where('regu_id','2')->count();
            $count_inventarissC = $inventariss->where('regu_id','3')->count();
            $count_inventarissD = $inventariss->where('regu_id','4')->count();

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

            $count_rekap_tugassA = $rekap_tugassA->count();
            $count_rekap_tugassB = $rekap_tugassB->count();
            $count_rekap_tugassC = $rekap_tugassC->count();
            $count_rekap_tugassD = $rekap_tugassD->count();

            //regu shift
            $regus_active = Regu::where('shift_id', '!=', '4')->get();
            $regusArr = array();
            foreach($regus_active as $regu){
                array_push($regusArr,$regu->id);
            }
        return view('jurnal.rekap', compact('page_title', 'page_description','action','logo','logoText','tugass', 'satpams',
        'reguA_arr','reguB_arr','reguC_arr','reguD_arr', 'detail_shiftA', 'detail_shiftB','detail_shiftC','detail_shiftD','pos_satpams', 
        'pamswakarsas', 'produksis', 'pemindahans', 'giat_armadas', 'inventariss', 'rekap_tugassA', 'rekap_tugassB', 
        'rekap_tugassC', 'rekap_tugassD', 'date', 'regusArr',
        'count_tugassA', 'count_tugassB', 'count_tugassC', 'count_tugassD',
        'count_pamswakarsasA', 'count_pamswakarsasB', 'count_pamswakarsasC', 'count_pamswakarsasD',
        'count_produksisA', 'count_produksisB', 'count_produksisC', 'count_produksisD',
        'count_pemindahansA', 'count_pemindahansB', 'count_pemindahansC', 'count_pemindahansD',
        'count_giat_armadasA', 'count_giat_armadasB', 'count_giat_armadasC', 'count_giat_armadasD',
        'count_inventarissA', 'count_inventarissB', 'count_inventarissC', 'count_inventarissD',
        'count_rekap_tugassA', 'count_rekap_tugassB', 'count_rekap_tugassC', 'count_rekap_tugassD'));
    }

    public function exportPdf($date, $reguid){

        $action = __FUNCTION__;
        
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

        $pos_satpams = PosSatpam::whereDate('created_at','=',$date)->get();

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

        //regu shift
        $regus_active = Regu::where('shift_id', '!=', '4')->get();
        $regusArr = array();
        foreach($regus_active as $regu){
            array_push($regusArr,$regu->id);
        }

        $image = base64_encode(url('images\petro-logo-big.png'));
        // dd(base64_decode($image));
        view()->share([
        'reguid' => $reguid,
        'pos_satpams' => $pos_satpams,
        'satpams' => $satpams,
        'date' => $date,
        'reguA_arr' => $reguA_arr,
        'reguB_arr' => $reguB_arr,
        'reguC_arr' => $reguC_arr,
        'reguD_arr' => $reguD_arr,
        'detail_shiftA' => $detail_shiftA,
        'detail_shiftB' => $detail_shiftB,
        'detail_shiftC' => $detail_shiftC,
        'detail_shiftD' => $detail_shiftD,
        'tugass' => $tugass,
        'pamswakarsas' => $pamswakarsas,
        'produksis' => $produksis,
        'pemindahans' => $pemindahans,
        'giat_armadas' => $giat_armadas,
        'inventariss' => $inventariss,
        'rekap_tugassA' => $rekap_tugassA,
        'rekap_tugassB' => $rekap_tugassB,
        'rekap_tugassC' => $rekap_tugassC,
        'rekap_tugassD' => $rekap_tugassD,
        'regusArr' => $regusArr,
        'regus_active' => $regus_active,
        'image' => $image,
        'userzona' => $userzona,
        
        ]);

        if($reguid == '1'){
            $namaRegu = ' Regu A';
        }elseif($reguid == '2'){
            $namaRegu = ' Regu B';
        }elseif($reguid == '3'){
            $namaRegu = ' Regu C';
        }else{
            $namaRegu = ' Regu D';
        }

        // return view('jurnal.rekap-pdf');
        $pdf = PDF::loadview('jurnal.rekap-pdf');
        return $pdf->download($date.$namaRegu.' Jurnal-Rekap.pdf');
    }
}
