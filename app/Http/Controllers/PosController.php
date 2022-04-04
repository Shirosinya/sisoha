<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pos;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_zona = Auth::user()->zona->id;
        $poss = Pos::where('zona_id', '=', $user_zona)->get();
        $page_title = 'Pos Zona';
        $page_description = 'Some description for the page';
        $logo = "images/petro-logo.png";
        $logoText = "images/petro-text.png";
        $action = __FUNCTION__;
        return view('pos_zona', compact('page_title', 'page_description', 'action','logo','logoText','poss','user_zona'));
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
            'nama_pos' => 'required|max:64',
            'keterangan' => 'nullable|max:255',
        ]);
        $user_zona = Auth::user()->zona->id;
        $input = $request->all();
        $data = Pos::create([
            'nama_pos' => $input['nama_pos'],
            'keterangan' => $input['keterangan'],
            'zona_id' => $user_zona,
        ]);
        return redirect('/pos-zona')->with('status','Data Berhasil Ditambah!');
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
            'nama_pos' => 'required|max:64',
            'keterangan' => 'nullable|max:255',
        ]);
        
        $input = $request->all();
        $pos = Pos::where('id',$id)->first();
        // dd($input,$tugas);
        if($pos->update([
            'nama_pos' => $input['nama_pos'],
            'keterangan' => $input['keterangan'],
        ]));

        return redirect('/pos-zona')->with('status', 'Data Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pos = Pos::where('id',$id)->delete();
        return redirect('/pos-zona')->with('status', 'Data Berhasil Dihapus');
    }
}
