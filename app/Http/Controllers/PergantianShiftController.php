<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Regu;
use Carbon\Carbon;
//DB dari Pergantian Shift
use App\Models\Tugas;

class PergantianShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tugass = Tugas::whereDate('created_at','=',date('Y-m-d'))->get();

        $page_title = 'Tugas Jaga';
        $page_description = 'Some description for the page';
        $logo = "images/petro-logo.png";
        $logoText = "images/petro-text.png";
        $action = __FUNCTION__;
        return view('jurnal.pergantianshift', compact('page_title', 'page_description', 'action','logo','logoText','tugass'));
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
        $input = $request->all();
        // $time = Carbon::parse($input['pukul'])->format('H:i');
        // dd($time);
        Tugas::create([
            'pukul' => $input['pukul'],
            'uraian_tugas' => $input['uraian_tugas'],
            'keterangan' => $input['keterangan'],
            'regu_id' => $input['regu_id'],
        ]);

        if($input['regu_id'] == '1'){
            return redirect('/pergantian-shift')->withInput(['tab'=>'tab-reguA']); 
         }elseif($input['regu_id'] == '2'){
             return redirect('/pergantian-shift')->withInput(['tab'=>'tab-reguB']);
         }elseif ($input['regu_id'] == '3') {
             return redirect('/pergantian-shift')->withInput(['tab'=>'tab-reguC']);
         }else{
             return redirect('/pergantian-shift')->withInput(['tab'=>'tab-reguD']);
         }
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
        $tugas = Tugas::where('id',$id)->first();
        // dd($input,$tugas);
        if($tugas->update([
            'pukul'         =>$input['pukul'],
            'uraian_tugas'  =>$input['uraian_tugas'],
            'keterangan'    =>$input['keterangan'],
        ]));
        if($input['regu_id'] == '1'){
            return redirect('/pergantian-shift')->withInput(['tab'=>'tab-reguA'])->with('statusA', 'Data Berhasil Diupdate!'); 
         }elseif($input['regu_id'] == '2'){
             return redirect('/pergantian-shift')->withInput(['tab'=>'tab-reguB'])->with('statusB', 'Data Berhasil Diupdate!');
         }elseif ($input['regu_id'] == '3') {
             return redirect('/pergantian-shift')->withInput(['tab'=>'tab-reguC'])->with('statusC', 'Data Berhasil Diupdate!');
         }else{
             return redirect('/pergantian-shift')->withInput(['tab'=>'tab-reguD'])->with('statusD', 'Data Berhasil Diupdate!');
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tugas = Tugas::where('id',$id)->delete();
        return redirect('/pergantian-shift')->with('status', 'Data Berhasil Dihapus');
    }
}
