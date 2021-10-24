<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GiatArmada;

class GiatArmadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_zona = Auth::user()->zona->id;
        $giat_armadas = GiatArmada::whereDate('created_at','=',date('Y-m-d'))->where('zona_id', '=', $user_zona)->get();
        // $detail_zonas = DetailZona::where('zona_id', '=', $user_zona)->get();
        // dd($detail_zonas);
        $page_title = 'Giat Armada';
        $page_description = 'Some description for the page';
        $logo = "images/petro-logo.png";
        $logoText = "images/petro-text.png";
        $action = __FUNCTION__;
        return view('jurnal.giat-armada', compact('page_title', 'page_description', 'action','logo','logoText','giat_armadas'));
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
        $user_zona = Auth::user()->zona->id;
        $input = $request->all();
        // $time = Carbon::parse($input['pukul'])->format('H:i');
        // dd($input);
        GiatArmada::create([
            'nama' => $input['nama'],
            'keterangan' => $input['keterangan'],
            'regu_id' => $input['regu_id'],
            'zona_id' => $user_zona,
        ]);

        if($input['regu_id'] == '1'){
            return redirect('/giat-armada')->withInput(['tab'=>'tab-reguA']); 
         }elseif($input['regu_id'] == '2'){
             return redirect('/giat-armada')->withInput(['tab'=>'tab-reguB']);
         }elseif ($input['regu_id'] == '3'){
             return redirect('/giat-armada')->withInput(['tab'=>'tab-reguC']);
         }else{
             return redirect('/giat-armada')->withInput(['tab'=>'tab-reguD']);
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
        $giat_armada = GiatArmada::where('id',$id)->first();
        // dd($input,$tugas);
        if($giat_armada->update([
            'nama' => $input['nama'],
            'keterangan' => $input['keterangan'],
        ]));
        if($input['regu_id'] == '1'){
            return redirect('/giat-armada')->withInput(['tab'=>'tab-reguA'])->with('statusA', 'Data Berhasil Diupdate!'); 
        }elseif($input['regu_id'] == '2'){
            return redirect('/giat-armada')->withInput(['tab'=>'tab-reguB'])->with('statusB', 'Data Berhasil Diupdate!');
        }elseif ($input['regu_id'] == '3') {
            return redirect('/giat-armada')->withInput(['tab'=>'tab-reguC'])->with('statusC', 'Data Berhasil Diupdate!');
        }else{
            return redirect('/giat-armada')->withInput(['tab'=>'tab-reguD'])->with('statusD', 'Data Berhasil Diupdate!');
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
        $giat_armada = GiatArmada::where('id',$id)->delete();
        return redirect('/giat-armada')->with('status', 'Data Berhasil Dihapus');
    }
}
