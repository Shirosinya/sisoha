<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Zona;
use App\Models\Satpam;
use App\Models\Pamswakarsa;

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
        $pamswakarsas = Pamswakarsa::whereDate('created_at','=',date('Y-m-d'))->where('zona_id', '=', $zonaid)->get();
        $pamsumAPO = 0;
        $pamsumAPB = 0;
        $pamsumAOK = 0;

        $pamsumBPO = 0;
        $pamsumBPB = 0;
        $pamsumBOK = 0;

        $pamsumCPO = 0;
        $pamsumCPB = 0;
        $pamsumCOK = 0;

        $pamsumDPO = 0;
        $pamsumDPB = 0;
        $pamsumDOK = 0;
        foreach($pamswakarsas as $pamswakarsa){
            if($pamswakarsa->regu_id == '1'){
                $pamsumAPO += $pamswakarsa->po;
                $pamsumAPB += $pamswakarsa->pb;
                $pamsumAOK += $pamswakarsa->ok;
            }elseif($pamswakarsa->regu_id == '2'){
                $pamsumBPO += $pamswakarsa->po;
                $pamsumBPB += $pamswakarsa->pb;
                $pamsumBOK += $pamswakarsa->ok;
            }elseif($pamswakarsa->regu_id == '3'){
                $pamsumCPO += $pamswakarsa->po;
                $pamsumCPB += $pamswakarsa->pb;
                $pamsumCOK += $pamswakarsa->ok;
            }else{
                $pamsumDPO += $pamswakarsa->po;
                $pamsumDPB += $pamswakarsa->pb;
                $pamsumDOK += $pamswakarsa->ok;
            }
        }
        // dd(json_encode($pamswaRegu), json_encode($pamswaPO), json_encode($pamswaPB), json_encode($pamswaOK));
        $action = __FUNCTION__;
        $page_title = 'Home';
        if($zonaid == null)
        {
            $nama_zona = "Admin Dashboard";
        }else{
            $nama_zona = Auth::user()->zona->nama;
        }
        
        return view('home', compact('action','nama_zona','page_title', 'satpams', 'satpam_zona','nama_zona',
         'pamswakarsas', 'pamsumAPO', 'pamsumAPB', 'pamsumAOK', 'pamsumBPO', 'pamsumBPB', 'pamsumBOK',
         'pamsumCPO', 'pamsumCPB', 'pamsumCOK', 'pamsumDPO', 'pamsumDPB', 'pamsumDOK'));
    }
}
