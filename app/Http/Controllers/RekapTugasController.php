<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\RekapTugas;
use App\Models\Satpam;
use App\Models\Regu;


class RekapTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_zona = Auth::user()->zona->id;
        $satpams = Satpam::where('zona_id','=',$user_zona)->get();
        // $rekap_tugass = RekapTugas::whereDate('created_at',date('Y-m-d'))
        // ->whereHas('satpam', function ($query) use ($user_zona)) 
        // {
        //     $query->where('zona_id',$user_zona );
        // }->get();
        // $rekap_tugass = RekapTugas::whereDate('created_at',date('Y-m-d'))
        // ->whereHas('satpam', function ($query) use ($user_zona) 
        // {
        //     $query->where('zona_id', $user_zona);
        // })->get();

        $rekap_tugassA = RekapTugas::whereDate('created_at',date('Y-m-d'))
        ->whereHas('satpam', function ($query) use ($user_zona) 
        {
            $query->where('zona_id', $user_zona)->where('regu_id', '=', '1');
        })->get();

        $rekap_tugassB = RekapTugas::whereDate('created_at',date('Y-m-d'))
        ->whereHas('satpam', function ($query) use ($user_zona) 
        {
            $query->where('zona_id', $user_zona)->where('regu_id', '=', '2');
        })->get();

        $rekap_tugassC = RekapTugas::whereDate('created_at',date('Y-m-d'))
        ->whereHas('satpam', function ($query) use ($user_zona) 
        {
            $query->where('zona_id', $user_zona)->where('regu_id', '3');
        })->get();

        $rekap_tugassD = RekapTugas::whereDate('created_at',date('Y-m-d'))
        ->whereHas('satpam', function ($query) use ($user_zona) 
        {
            $query->where('zona_id', $user_zona)->where('regu_id', '4');
        })->get();

        // dd($rekap_tugassA,$rekap_tugassB);
        $page_title = 'Rekap Tugas';
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
        return view('jurnal.rekap-tugas', compact('page_title', 'page_description', 'action','logo','logoText',
        'satpams', 'rekap_tugassA', 'rekap_tugassB', 'rekap_tugassC', 'rekap_tugassD', 'regusArr'));
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
        // $satpam = Satpam::where('id',$input['satpam_id'])->first();
        // dd($satpam->regu_id);
        $data = RekapTugas::create([
            'uraian_tugas' => $input['uraian_tugas'],
            'mulai' => $input['mulai'],
            'selesai' => $input['selesai'],
            'keterangan' => $input['keterangan'],
            'satpam_id' => $input['satpam_id'],
        ]);
        
        if($input['regu_id'] == '1'){
            return redirect('/rekap-tugas')->withInput(['tab'=>'tab-reguA'])->with('status','Data Berhasil Ditambah!'); 
        }elseif($input['regu_id'] == '2'){
            return redirect('/rekap-tugas')->withInput(['tab'=>'tab-reguB'])->with('status','Data Berhasil Ditambah!');
        }elseif ($input['regu_id'] == '3'){
            return redirect('/rekap-tugas')->withInput(['tab'=>'tab-reguC'])->with('status','Data Berhasil Ditambah!');
        }else{
            return redirect('/rekap-tugas')->withInput(['tab'=>'tab-reguD'])->with('status','Data Berhasil Ditambah!');
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
        //
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
        $rekaptugas = RekapTugas::where('id',$id)->delete();
        if($input['regu_id'] == '1'){
            return redirect('/rekap-tugas')->withInput(['tab'=>'tab-reguA'])->with('statusA', 'Data Berhasil Dihapus'); 
        }elseif($input['regu_id'] == '2'){
            return redirect('/rekap-tugas')->withInput(['tab'=>'tab-reguB'])->with('statusB', 'Data Berhasil Dihapus');
        }elseif ($input['regu_id'] == '3') {
            return redirect('/rekap-tugas')->withInput(['tab'=>'tab-reguC'])->with('statusC', 'Data Berhasil Dihapus');
        }else{
            return redirect('/rekap-tugas')->withInput(['tab'=>'tab-reguD'])->with('statusD', 'Data Berhasil Dihapus');
        }
    }
}
