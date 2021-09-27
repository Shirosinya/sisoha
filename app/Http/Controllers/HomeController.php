<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Zona;
use App\Models\Satpam;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->User = new User();
        // $this->middleware('auth');
    }

    public function index(){
        
        $zonaid = Auth::user()->zona_id;
        $nama_zona = Auth::user()->zona->nama;
        $satpams = Satpam::all()->count();
        $satpam_zona = Satpam::all()->where('zona_id', '=', $zonaid)->count();
        // dd($satpams);
        $action = __FUNCTION__;
        $page_title = 'Home';
        if($zonaid == null)
        {
            $nama_zona = "Admin Dashboard";
        }else{
            $nama_zona = Auth::user()->zona->nama;
        }
        
        return view('home', compact('action','nama_zona','page_title', 'satpams', 'satpam_zona','nama_zona'));
    }
}
