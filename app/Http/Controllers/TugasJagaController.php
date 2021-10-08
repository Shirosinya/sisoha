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
use App\Models\DetailShift;


class TugasJagaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = date('Y-m-d');
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

        $page_title = 'Tugas Jaga';
        $page_description = 'Some description for the page';
        $logo = "images/petro-logo.png";
        $logoText = "images/petro-text.png";
        $action = __FUNCTION__;

        $leveluser = Auth::user()->level_user; //mengambil level_user
        if($leveluser == 'admin'){ //check kalau level admin, maka akan ditampilkan dari semua zona
            $satpams = Satpam::all();
        }else{                      //else, akan ditampilkan sesuai zona masing2 akun
            $userzona = Auth::user()->zona->id;
            $satpams = Satpam::all()->where('zona_id',$userzona);
        }

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
        foreach ($reguA_arr as $reguA){
            $shiftA =$reguA->regu->shift->id;
        }
        foreach ($reguB_arr as $reguB){
            $shiftB =$reguB->regu->shift->id;
        }
        foreach ($reguC_arr as $reguC){
            $shiftC =$reguC->regu->shift->id;
        }
        foreach ($reguD_arr as $reguD){
            $shiftD =$reguD->regu->shift->id;
        }

        //mengambil detail shift dari shift hari ini
        $detail_shiftA = DetailShift::all()->where('shift_id','=',$shiftA);
        $detail_shiftB = DetailShift::all()->where('shift_id','=',$shiftB);
        $detail_shiftC = DetailShift::all()->where('shift_id','=',$shiftC);
        $detail_shiftD = DetailShift::all()->where('shift_id','=',$shiftD);

        //mengambil data pos satpam hari ini
        $pos_satpams = PosSatpam::whereDate('created_at','=',date('Y-m-d'))->get();
        // dd($pos_satpams);
     
        return view('jurnal.tugas-jaga', compact('page_title', 'page_description','shiftA','shiftB','shiftC','shiftD',
        'action','logo','logoText','poss','satpams','reguA_arr','reguB_arr','reguC_arr','reguD_arr', 'detail_shiftA',
        'detail_shiftB','detail_shiftC','detail_shiftD','pos_satpams'));
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
    public function PlottingPos(Request $request, $id)
    {
        $input = $request->all();
        $satpam = Satpam::all()->where('id',$id)->first();
        
        //mengambil id shift dari satpam untuk menyesuaikan detail shift hari ini
        $shift_id = $satpam->regu->shift->id;
        //mengambil detail2 shift dari shift satpam terpilih
        $detail_shift = DetailShift::all()->where('shift_id',$shift_id);

        //mengambil data pada tabel pos yang namanya sesuai dengan nama dari $request untuk tiap pos_1 sampai pos_4
        $pos_1 = Pos::all()->where('nama_pos',$input['pos_1'])->first();
        $pos_2 = Pos::all()->where('nama_pos',$input['pos_2'])->first();
        $pos_3 = Pos::all()->where('nama_pos',$input['pos_3'])->first();
        $pos_4 = Pos::all()->where('nama_pos',$input['pos_4'])->first();
        
        //mengecheck apakah data tiap pos_1 sampai pos_4. Apabila null maka variable menampung nilai null
        //jika tidak, variable menampung id dari $pos_1/$pos_2/$pos_3/$pos_4 
        $pos1_val = $pos_1 == null ? null : $pos_1->id;
        $pos2_val = $pos_2 == null ? null : $pos_2->id;
        $pos3_val = $pos_3 == null ? null : $pos_3->id;
        $pos4_val = $pos_4 == null ? null : $pos_4->id;

        //menampung id $pos_1 sampai $pos_4 ke array.
        $poss = array( $pos1_val, $pos2_val, $pos3_val, $pos4_val);

        //pengambil data pos_satpam hari ini yang id satpamnya sama dengan id satpam yang mau di plot pos nya
        $candidate = PosSatpam::whereDate('created_at','=',date('Y-m-d'))->where('satpam_id',$id)->get();
        $i = 0;

        //Apabila data pos satpam >= 4 row, maka akan di update. Jika tidak maka akan membuat baru.
        if($candidate->count() >= 4){
            //$candidate terdiri lebih dari satu data pos_satpam, maka di loop untuk diambil idnya.
            foreach($candidate as $candid){
                //looping $detail_shift yang berisi detail shift dari shift satpam terpilih.
                foreach($detail_shift as $ds){
                    PosSatpam::where('id',$candid->id)->update([
                        'jadwal_shift'  => $ds->waktu_awal,
                        'pos_id'        =>$poss[$i],
                        'satpam_id'     =>$id,
                    ]);
                }
                $i++; 
            }
            
        }else{
            //looping $detail_shift yang berisi detail shift dari shift satpam terpilih.
            foreach($detail_shift as $ds){
                PosSatpam::create([
                    'jadwal_shift'  => $ds->waktu_awal,
                    'pos_id'        =>$poss[$i],
                    'satpam_id'     =>$id,
                ]);
                $i++;
            }
        }
        
        //code return untuk redirect ke tab spesifik sesuai regu satpam terpilih.
        if($satpam->regu->nama == 'Regu A'){
           return redirect('/tugas-jaga')->withInput(['tab'=>'tab-reguA']); 
        }elseif($satpam->regu->nama == 'Regu B'){
            return redirect('/tugas-jaga')->withInput(['tab'=>'tab-reguB']);
        }elseif ($satpam->regu->nama == 'Regu C') {
            return redirect('/tugas-jaga')->withInput(['tab'=>'tab-reguC']);
        }else{
            return redirect('/tugas-jaga')->withInput(['tab'=>'tab-reguD']);
        }
        
        // return redirect('/tugas-jaga')->with('error', 'Kesalahan saat mengupdate!');
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
