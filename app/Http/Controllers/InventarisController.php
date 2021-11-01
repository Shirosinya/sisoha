<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\Inventaris;
use App\Models\Regu;

use Illuminate\Http\Request;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_zona = Auth::user()->zona->id;
        $barangs = Barang::where('zona_id', '=', $user_zona)->get();
        $inventariss = Inventaris::whereDate('created_at','=',date('Y-m-d'))->where('zona_id', '=', $user_zona)->get();        
        // $detail_zonas = DetailZona::where('zona_id', '=', $user_zona)->get();
        // dd($inventariss);
        $page_title = 'Inventaris';
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
        return view('jurnal.inventaris', compact('page_title', 'page_description', 'action','logo','logoText','inventariss','barangs', 'regusArr'));
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
        $data = Inventaris::create([
            'kondisi' => $input['kondisi'],
            'keterangan' => $input['keterangan'],
            'barang_id' => $input['barang_id'],
            'regu_id' => $input['regu_id'],
            'zona_id' => $user_zona,
        ]);

        //membuat data inventaris all null except barang_id
        // Inventaris::create([
        //     'barang_id' => $data->id,
        // ]);
        //  return redirect('/inventaris')->with('status','Data Berhasil Ditambah!');
        if($input['regu_id'] == '1'){
            return redirect('/inventaris')->withInput(['tab'=>'tab-reguA'])->with('status','Data Berhasil Ditambah!'); 
        }elseif($input['regu_id'] == '2'){
            return redirect('/inventaris')->withInput(['tab'=>'tab-reguB'])->with('status','Data Berhasil Ditambah!');
        }elseif ($input['regu_id'] == '3'){
            return redirect('/inventaris')->withInput(['tab'=>'tab-reguC'])->with('status','Data Berhasil Ditambah!');
        }else{
            return redirect('/inventaris')->withInput(['tab'=>'tab-reguD'])->with('status','Data Berhasil Ditambah!');
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
        $inventaris = Inventaris::where('id',$id)->first();
        // dd($input,$tugas);
        if($inventaris->update([
            'kondisi' => $input['kondisi'],
            'keterangan' => $input['keterangan'],
            'barang_id' => $input['barang_id'],
        ]));
        if($input['regu_id'] == '1'){
            return redirect('/inventaris')->withInput(['tab'=>'tab-reguA'])->with('statusA', 'Data Berhasil Diupdate!'); 
        }elseif($input['regu_id'] == '2'){
            return redirect('/inventaris')->withInput(['tab'=>'tab-reguB'])->with('statusB', 'Data Berhasil Diupdate!');
        }elseif ($input['regu_id'] == '3') {
            return redirect('/inventaris')->withInput(['tab'=>'tab-reguC'])->with('statusC', 'Data Berhasil Diupdate!');
        }else{
            return redirect('/inventaris')->withInput(['tab'=>'tab-reguD'])->with('statusD', 'Data Berhasil Diupdate!');
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
        // dd($input['regu_id']);
        $inventaris = Inventaris::where('id',$id)->delete();
        if($input['regu_id'] == '1'){
            return redirect('/inventaris')->withInput(['tab'=>'tab-reguA'])->with('statusA', 'Data Berhasil Dihapus'); 
        }elseif($input['regu_id'] == '2'){
            return redirect('/inventaris')->withInput(['tab'=>'tab-reguB'])->with('statusB', 'Data Berhasil Dihapus');
        }elseif ($input['regu_id'] == '3') {
            return redirect('/inventaris')->withInput(['tab'=>'tab-reguC'])->with('statusC', 'Data Berhasil Dihapus');
        }else{
            return redirect('/inventaris')->withInput(['tab'=>'tab-reguD'])->with('statusD', 'Data Berhasil Dihapus');
        }
    }
}
