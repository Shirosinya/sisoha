<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Satpam;
// use App\Models\User;

class OmahadminController extends Controller
{
    public function landing()
    {
        $page_title = 'Landing';
        $page_description = 'Some description for the page';
        $logo = "images/petro-logo.png";
        $logoText = "images/petro-text.png";
        $action = __FUNCTION__;
		
        return view('welcome', compact('page_title', 'page_description','action','logo','logoText'));
    }

    public function page_login()
    {
        $page_title = 'Page Login';
        $page_description = 'Some description for the page';
		
		$action = __FUNCTION__;

        return view('login', compact('page_title', 'page_description','action'));
    }

	public function dashboard_1()
    {
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        $logo = "images/petro-logo.png";
        $logoText = "images/petro-text.png";
        $action = __FUNCTION__;
        
        // $id= Auth::user()->id;
        if(Auth::user()->level_user = 'admin')
        {
            return view('home', compact('page_title', 'page_description','action','logo','logoText'));
        }else{
            return view('jurnal.rekap', compact('page_title', 'page_description','action','logo','logoText'));
        }
		
    }

    public function regupersonil()
    {
        $leveluser = Auth::user()->level_user;
        $satpams = Satpam::all()->first();
        // $satpam = $satpams->id;
        if($leveluser == 'admin'){
            $satpams = Satpam::all();
        }else{
            $userzona = Auth::user()->zona->id;
            $satpams = Satpam::all()->where('zona_id',$userzona);
            // $satpams = Satpam::where('pos_id->zona_id->id',$userzona);
            // $satpams = Satpam::leftjoin('poss','satpams.pos_id', '=', 'poss.id')
            // ->leftjoin('zonas','poss.zona_id', '=', 'zonas.id')
            // ->where('zonas.id',$userzona)
            // ->select('*')
            // ->get();
            
            // dd($satpams);
        }
        
        // $nama_regu = Satpam::all()->regu->nama;
        $page_title = 'Regu dan Personil';
        $page_description = 'Some description for the page';
        $logo = "images/petro-logo.png";
        $logoText = "images/petro-text.png";
        $action = __FUNCTION__;
        return view('regupersonil', compact('page_title', 'page_description','action','logo','logoText',
        'satpams'));
    }

    public function createpersonil(Request $request)
    {
        $input = $request->all();
        // dd($request);
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

    public function editpersonil($id)
    {
        // echo $id;
        $data = Satpam::find($id);
        dd($data);
        return view('regupersonil',compact('data'));
    }

    
    public function updatepersonil(Request $request, $id)
    {
        Satpam::where('id',$id)->update([
            'nama'      =>$request->nama,
            'nik'       =>$request->nik,
            'jabatan'   =>$request->jabatan,
            'status'    =>$request->status,
            'regu_id'   =>$request->regu,
        ]);

        return redirect('/regupersonil')->with('status', 'Data Berhasil Diupdate!');
    }

    public function rekap()
    {
        // $page_title = 'Rekap';
        // $page_description = 'Some description for the page';
        // $logo = "images/petro-logo.png";
        // $logoText = "images/petro-text.png";
        // $action = __FUNCTION__;
		
        // return view('jurnal.rekap', compact('page_title', 'page_description','action','logo','logoText'));
    }

	    // Dashboard
    // public function dashboard_1()
    // {
      
     
    //     $page_title = 'Dashboard';
    //     $page_description = 'Some description for the page';
    //     $logo = "images/petro-logo.png";
    //     $logoText = "images/petro-text.png";
    //     $action = __FUNCTION__;
		
    //     return view('dashboard.index', compact('page_title', 'page_description','action','logo','logoText'));
    // }
    
}
