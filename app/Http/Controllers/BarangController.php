<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barang;
use App\Models\Inventaris;

class BarangController extends Controller
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
        // $detail_zonas = DetailZona::where('zona_id', '=', $user_zona)->get();
        // dd($detail_zonas);
        $page_title = 'Barang';
        $page_description = 'Some description for the page';
        $logo = "images/petro-logo.png";
        $logoText = "images/petro-text.png";
        $action = __FUNCTION__;
        return view('barang', compact('page_title', 'page_description', 'action','logo','logoText','barangs'));
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
            'nama_barang' => 'required|max:64',
            'jumlah' => 'required|integer',
            'zona_id' => 'required',
        ]);

        $user_zona = Auth::user()->zona->id;
        $input = $request->all();
        // $time = Carbon::parse($input['pukul'])->format('H:i');
        $data = Barang::create([
            'nama_barang' => $input['nama_barang'],
            'jumlah' => $input['jumlah'],
            'zona_id' => $user_zona,
        ]);

        //membuat data inventaris all null except barang_id
        // Inventaris::create([
        //     'barang_id' => $data->id,
        // ]);
         return redirect('/barang')->with('status','Data Berhasil Ditambah!');
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
            'nama_barang' => 'required|max:64',
            'jumlah' => 'required|integer',
        ]);
        
        $input = $request->all();
        $barang = Barang::where('id',$id)->first();
        // dd($input,$tugas);
        if($barang->update([
            'nama_barang' => $input['nama_barang'],
            'jumlah' => $input['jumlah'],
        ]));

        return redirect('/barang')->with('status', 'Data Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::where('id',$id)->delete();
        return redirect('/barang')->with('status', 'Data Berhasil Dihapus');
    }
}
