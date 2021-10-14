<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Satpam;
use App\Models\Regu;
use Carbon\Carbon;
// use App\Models\Shift;

class RegupersonilController extends Controller
{

    // function weekOfMonth($date) {
    //     //Get the first day of the month.
    //     $firstOfMonth = strtotime(date("Y-m-01", $date));
    //     //Apply above formula.
    //     return weekOfYear($date) - weekOfYear($firstOfMonth) + 1;
    // }
    
    function weekOfYear($date) {
        $weekOfYear = intval(date("W", $date));
        if (date('n', $date) == "1" && $weekOfYear > 51) {
            // It's the last week of the previos year.
            return 0;
        }
        else if (date('n', $date) == "12" && $weekOfYear == 1) {
            // It's the first week of the next year.
            return 53;
        }
        else {
            // It's a "normal" week.
            return $weekOfYear;
        }
    }

    function shiftOfRegu($id_regu,$day)
    {
        $a = array("S","OFF","P","M");
        $b = array("S","M","P","OFF");
        $c = array("OFF","M","S","P");
        $d = array("M","OFF","S","P");
        $e = array("M","P","OFF","S");
        $f = array("OFF","P","M","S");
        $g = array("P","S","M","OFF");
        $h = array("P","S","M","OFF");
        $i = array("P","S","OFF","M");
        $su = 'Sunday';
        $mo = 'Monday';
        $tu = 'Tuesday';
        $we = 'Wednesday';
        $th = 'Thursday';
        $fr = 'Friday';
        $sa = 'Saturday';
        //menampung hari selama sebulan sesuai urutan template shift
        //contoh: $days[bulan[mingguan[hari[Minggu[$a[S,OFF,P,M]], Senin[..[..]], Selasa.. Sabtu]]]]
        $days = array(  
                    array($a , $b, $c, $d, $e, $f, $g),
                    array($h, $i, $a, $b, $c, $d, $e),
                    array($f, $g, $h, $i, $a, $b, $c),
                    array($d, $e, $f, $g, $h, $i, $a),
                        );
            
            $index3 = $id_regu-1; //untuk index array dari variable jadwal shift ($a,$b..)
            //$day = date('2021-09-28'); //inisialisasi hari
            $hari = strtotime($day); 
            $dayname = date('l',$hari); //nama lengkap hari
            //$date = new DateTime($ddate);
            //$week = $date->format("W");
            $week = $this->weekOfYear(strtotime($day)); //menghitung $day itu week keberapa dalam 1 tahun
            //echo $week."<br>";
            if($dayname == 'Sunday'){
                $week = $week+1;
                if($week % 4 == 0){
                    $week=1;
                }elseif($week % 4 == 1){
                    $week=2;
                }elseif($week % 4 == 2){
                    $week=3;
                }elseif($week % 4 == 3){
                    $week=4;
                }
            }else{
                if($week % 4 == 0){
                    $week=1;
                }elseif($week % 4 == 1){
                    $week=2;
                }elseif($week % 4 == 2){
                    $week=3;
                }elseif($week % 4 == 3){
                    $week=4;
                }
            }
            //echo $week."<br>";
            if($week == '1'){
                $index1=0;
                if($dayname == $su){
                    $index2 =0;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $mo){
                    $index2 =1;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $tu){
                    $index2 =2;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $we){
                    $index2 =3;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $th){
                    $index2 =4;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $fr){
                    $index2 =5;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $sa){
                    $index2 =6;
                    return $days[$index1][$index2][$index3];
                }
            }elseif($week == '2'){
                $index1=1;
                if($dayname == $su){
                    $index2 =0;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $mo){
                    $index2 =1;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $tu){
                    $index2 =2;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $we){
                    $index2 =3;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $th){
                    $index2 =4;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $fr){
                    $index2 =5;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $sa){
                    $index2 =6;
                    return $days[$index1][$index2][$index3];
                }
            }elseif($week == '3'){
                $index1=2;
                if($dayname == $su){
                    $index2 =0;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $mo){
                    $index2 =1;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $tu){
                    $index2 =2;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $we){
                    $index2 =3;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $th){
                    $index2 =4;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $fr){
                    $index2 =5;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $sa){
                    $index2 =6;
                    return $days[$index1][$index2][$index3];
                }
            }elseif($week == '4'){
                $index1=3;
                if($dayname == $su){
                    $index2 =0;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $mo){
                    $index2 =1;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $tu){
                    $index2 =2;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $we){
                    $index2 =3;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $th){
                    $index2 =4;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $fr){
                    $index2 =5;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $sa){
                    $index2 =6;
                    return $days[$index1][$index2][$index3];
                }
            }else{
                $index1=0;
                if($dayname == $su){
                    $index2 =0;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $mo){
                    $index2 =1;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $tu){
                    $index2 =2;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $we){
                    $index2 =3;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $th){
                    $index2 =4;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $fr){
                    $index2 =5;
                    return $days[$index1][$index2][$index3];
                }elseif($dayname == $sa){
                    $index2 =6;
                    return $days[$index1][$index2][$index3];
                }
            }
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) //optional request pada route ex /regupersonil/{datepicker}
    {   
        if(!is_null($request->datepicker)){
            $date = $request->datepicker;
            // Hit this url http://shifter.test/api/find?year=2045&month=12&day=27&group=D
            // to fetch data at Desember 27th 2045, Group D
            $date = $request->datepicker; //ini ngereturn YYYY-mm-dd (js value) gabisa di dd harus var_dump
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
            // return "ini = ".strtoupper($shifts[0]);
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
                // dd($shifts);
            }
        }else{
            $date = date('Y-m-d');
            $shifts = array();
            $reg = Regu::all();
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
            // return "ini = ".strtoupper($shifts[0]);
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
        }

        $leveluser = Auth::user()->level_user; //mengambil level_user
        if($leveluser == 'admin'){ //check kalau level admin, maka akan ditampilkan dari semua zona
            $satpams = Satpam::all();
            // $regus = Regu::all();
        }else{                      //else, akan ditampilkan sesuai zona masing2 akun
            $userzona = Auth::user()->zona->id;
            $satpams = Satpam::all()->where('zona_id',$userzona);
        }
        $page_title = 'Regu dan Personil';
        $page_description = 'Some description for the page';
        $logo = "images/petro-logo.png";
        $logoText = "images/petro-text.png";
        $action = __FUNCTION__;
        $regus = Regu::all(); //memanggil isi Model Regu setelah fungsi plot, agar menampilkan data terupdate

        return view('regupersonil', compact('page_title', 'page_description','action','logo','logoText','satpams',
        'regus','shifts','day'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dateFilter(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $userzona = Auth::user()->zona->id;
        $satpam = Satpam::create([
            'nama'      =>$request->nama,
            'nik'       =>$request->nik,
            'jabatan'   =>$request->jabatan,
            'status'    =>$request->status,
            'regu_id'   =>$request->regu,
            'zona_id'   =>$userzona
        ]);
        return redirect('/regupersonil')->with('status', 'Data Berhasil Ditambah');
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
        $input = $request->all();
        $satpam = Satpam::where('id',$id)->first();
        // dd($input);
        if($satpam->update([
            'nama'      =>$input['nama'],
            'nik'       =>$input['nik'],
            'jabatan'   =>$input['jabatan'],
            'status'    =>$input['status'],
            'regu_id'   =>$input['regu'],
        ]));
        {
            return redirect('/regupersonil')->with('status', 'Data Berhasil Diupdate!');
        }
        return redirect('/regupersonil')->with('error', 'Kesalahan saat mengupdate!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $satpam = Satpam::where('id',$id)->delete();
        return redirect('/regupersonil')->with('status', 'Data Berhasil Dihapus');
    }
}
