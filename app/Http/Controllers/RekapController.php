<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Satpam;
use App\Models\Regu;
use App\Models\Tugas;
use App\Models\Zona;
use App\Models\Pos;

class RekapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        }

        $tugass = Tugas::all();
        $poss = Pos::all()->where('zona_id', '=', $userzona);
        $pos_array = array();
        foreach($poss as $pos){
            array_push($pos_array, $pos);
        }
        // dd($pos_array[0]);
        $tugas_jagas = Satpam::leftjoin('zonas','satpams.zona_id', '=', 'zonas.id')
            ->select('satpams.nama as nama','satpams.nik as nik', 'satpams.status as status','zonas.nama as nama_zona')
            ->where('zonas.id', '=', $userzona)
            ->get();
            // ->first();
		    // dd($tugas_jagas);
        return view('jurnal.rekap', compact('page_title', 'page_description','action','logo','logoText','tugass','tugas_jagas'));
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
