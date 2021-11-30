<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pamswakarsa;
use App\Models\DetailZona;
use App\Models\Regu;

class PamswakarsaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_zona = Auth::user()->zona->id;
        $pamswakarsas = Pamswakarsa::whereDate('created_at','=',date('Y-m-d'))->where('zona_id', '=', $user_zona)->get();
        $detail_zonas = DetailZona::where('zona_id', '=', $user_zona)->get();
        // dd($detail_zonas);
        $page_title = 'Pamswakarsa';
        $page_description = 'Some description for the page';
        $logo = "images/petro-logo.png";
        $logoText = "images/petro-text.png";
        $action = __FUNCTION__;

        //regu shift
        $regus_active = Regu::where('shift_id', '!=', '4')->get();
        $regusArr = array();
        foreach($regus_active as $regu){
            array_push($regusArr,$regu->id);
        }
        return view('jurnal.pamswakarsa', compact('page_title', 'page_description', 'action','logo','logoText','pamswakarsas', 'detail_zonas', 'regusArr'));
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
        Pamswakarsa::create([
            'wilayah' => $input['wilayah'],
            'nama_petugas' => $input['nama_petugas'],
            'po' => $input['po'],
            'pb' => $input['pb'],
            'ok' => $input['ok'],
            'regu_id' => $input['regu_id'],
            'zona_id' => $user_zona,
        ]);

        if($input['regu_id'] == '1'){
            return redirect('/pamswakarsa')->withInput(['tab'=>'tab-reguA']); 
         }elseif($input['regu_id'] == '2'){
             return redirect('/pamswakarsa')->withInput(['tab'=>'tab-reguB']);
         }elseif ($input['regu_id'] == '3'){
             return redirect('/pamswakarsa')->withInput(['tab'=>'tab-reguC']);
         }else{
             return redirect('/pamswakarsa')->withInput(['tab'=>'tab-reguD']);
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
        $pamswakarsa = Pamswakarsa::where('id',$id)->first();
        // dd($input,$tugas);
        if($pamswakarsa->update([
            'wilayah' => $input['wilayah'],
            'nama_petugas' => $input['nama_petugas'],
            'po' => $input['po'],
            'pb' => $input['pb'],
            'ok' => $input['ok'],
        ]));
        if($input['regu_id'] == '1'){
            return redirect('/pamswakarsa')->withInput(['tab'=>'tab-reguA'])->with('statusA', 'Data Berhasil Diupdate!'); 
         }elseif($input['regu_id'] == '2'){
             return redirect('/pamswakarsa')->withInput(['tab'=>'tab-reguB'])->with('statusB', 'Data Berhasil Diupdate!');
         }elseif ($input['regu_id'] == '3') {
             return redirect('/pamswakarsa')->withInput(['tab'=>'tab-reguC'])->with('statusC', 'Data Berhasil Diupdate!');
         }else{
             return redirect('/pamswakarsa')->withInput(['tab'=>'tab-reguD'])->with('statusD', 'Data Berhasil Diupdate!');
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $input = $request->all();
        $pamswakarsa = Pamswakarsa::where('id',$id)->delete();
        if($input['regu_id'] == '1'){
            return redirect('/pamswakarsa')->withInput(['tab'=>'tab-reguA'])->with('statusA', 'Data Berhasil Dihapus'); 
        }elseif($input['regu_id'] == '2'){
            return redirect('/pamswakarsa')->withInput(['tab'=>'tab-reguB'])->with('statusB', 'Data Berhasil Dihapus');
        }elseif ($input['regu_id'] == '3') {
            return redirect('/pamswakarsa')->withInput(['tab'=>'tab-reguC'])->with('statusC', 'Data Berhasil Dihapus');
        }else{
            return redirect('/pamswakarsa')->withInput(['tab'=>'tab-reguD'])->with('statusD', 'Data Berhasil Dihapus');
        }
    }
}
