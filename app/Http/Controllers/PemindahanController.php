<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemindahan;
use App\Models\Regu;

class PemindahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_zona = Auth::user()->zona->id;
        $pemindahans = Pemindahan::whereDate('created_at','=',date('Y-m-d'))->where('zona_id', '=', $user_zona)->get();
        // $detail_zonas = DetailZona::where('zona_id', '=', $user_zona)->get();
        // dd($detail_zonas);
        $page_title = 'Pemindahan';
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
        return view('jurnal.pemindahan', compact('page_title', 'page_description', 'action','logo','logoText','pemindahans', 'regusArr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pemindahan' => 'required|max:64',
            'gudang' => 'required|string|max:64',
            'tujuan' => 'required|max:64',
            'armada' => 'required|max:64',
            'keterangan' => 'required|max:255',
            'regu_id' => 'required',
            'zona_id' => 'required',
        ]);
        $user_zona = Auth::user()->zona->id;
        $input = $request->all();
        // $time = Carbon::parse($input['pukul'])->format('H:i');
        // dd($input);
        Pemindahan::create([
            'nama_pemindahan' => $input['nama_pemindahan'],
            'gudang' => $input['gudang'],
            'tujuan' => $input['tujuan'],
            'armada' => $input['armada'],
            'keterangan' => $input['keterangan'],
            'regu_id' => $input['regu_id'],
            'zona_id' => $user_zona,
        ]);

        if($input['regu_id'] == '1'){
            return redirect('/pemindahan')->withInput(['tab'=>'tab-reguA']); 
         }elseif($input['regu_id'] == '2'){
             return redirect('/pemindahan')->withInput(['tab'=>'tab-reguB']);
         }elseif ($input['regu_id'] == '3'){
             return redirect('/pemindahan')->withInput(['tab'=>'tab-reguC']);
         }else{
             return redirect('/pemindahan')->withInput(['tab'=>'tab-reguD']);
         }
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
        $request->validate([
            'nama_pemindahan' => 'required|max:64',
            'gudang' => 'required|string|max:64',
            'tujuan' => 'required|max:64',
            'armada' => 'required|max:64',
            'keterangan' => 'required|max:255',
        ]);
        $input = $request->all();
        $pemindahan = Pemindahan::where('id',$id)->first();
        // dd($input,$tugas);
        if($pemindahan->update([
            'nama_pemindahan' => $input['nama_pemindahan'],
            'gudang' => $input['gudang'],
            'tujuan' => $input['tujuan'],
            'armada' => $input['armada'],
            'keterangan' => $input['keterangan'],
        ]));
        if($input['regu_id'] == '1'){
            return redirect('/pemindahan')->withInput(['tab'=>'tab-reguA'])->with('statusA', 'Data Berhasil Diupdate!'); 
         }elseif($input['regu_id'] == '2'){
             return redirect('/pemindahan')->withInput(['tab'=>'tab-reguB'])->with('statusB', 'Data Berhasil Diupdate!');
         }elseif ($input['regu_id'] == '3') {
             return redirect('/pemindahan')->withInput(['tab'=>'tab-reguC'])->with('statusC', 'Data Berhasil Diupdate!');
         }else{
             return redirect('/pemindahan')->withInput(['tab'=>'tab-reguD'])->with('statusD', 'Data Berhasil Diupdate!');
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
        $pemindahan = Pemindahan::where('id',$id)->delete();
        if($input['regu_id'] == '1'){
            return redirect('/pemindahan')->withInput(['tab'=>'tab-reguA'])->with('statusA', 'Data Berhasil Dihapus'); 
        }elseif($input['regu_id'] == '2'){
            return redirect('/pemindahan')->withInput(['tab'=>'tab-reguB'])->with('statusB', 'Data Berhasil Dihapus');
        }elseif ($input['regu_id'] == '3') {
            return redirect('/pemindahan')->withInput(['tab'=>'tab-reguC'])->with('statusC', 'Data Berhasil Dihapus');
        }else{
            return redirect('/pemindahan')->withInput(['tab'=>'tab-reguD'])->with('statusD', 'Data Berhasil Dihapus');
        }
    }
}
