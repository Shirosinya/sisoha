<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\RekapTugas;
use App\Models\Satpam;
use App\Models\Regu;
use App\Models\Lampiran;


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

        $rekap_tugassA_ids = array();
        foreach($rekap_tugassA as $rekap){
            array_push($rekap_tugassA_ids, $rekap->id);
        }
        $rekap_tugassB_ids = array();
        foreach($rekap_tugassB as $rekap){
            array_push($rekap_tugassB_ids, $rekap->id);
        }
        $rekap_tugassC_ids = array();
        foreach($rekap_tugassC as $rekap){
            array_push($rekap_tugassC_ids, $rekap->id);
        }
        $rekap_tugassD_ids = array();
        foreach($rekap_tugassD as $rekap){
            array_push($rekap_tugassD_ids, $rekap->id);
        }
        //lampiran
        $lampiransA = Lampiran::whereIn('rekap_tugas_id',$rekap_tugassA_ids)->get();
        $lampiransB = Lampiran::whereIn('rekap_tugas_id',$rekap_tugassB_ids)->get();
        $lampiransC = Lampiran::whereIn('rekap_tugas_id',$rekap_tugassC_ids)->get();
        $lampiransD = Lampiran::whereIn('rekap_tugas_id',$rekap_tugassD_ids)->get();
        return view('jurnal.rekap-tugas', compact('page_title', 'page_description', 'action','logo','logoText',
        'satpams', 'rekap_tugassA', 'rekap_tugassB', 'rekap_tugassC', 'rekap_tugassD', 'regusArr', 'lampiransA',
        'lampiransB', 'lampiransC', 'lampiransD'));
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
        // dd($request->all());
        $request->validate([
            'uraian_tugas' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            'keterangan' => 'required',
            'lampirans' => 'required',
            'lampirans.*' => 'mimes:jpg,png,jpeg,PNG|max:4000',
        ]);
        $user_zona = Auth::user()->zona->id;
        $input = $request->all();
        // $time = Carbon::parse($input['pukul'])->format('H:i');
        // dd(isset($input['lampirans']));
        // $satpam = Satpam::where('id',$input['satpam_id'])->first();
        // dd($satpam->regu_id);
        $data = RekapTugas::create([
            'uraian_tugas' => $input['uraian_tugas'],
            'mulai' => $input['mulai'],
            'selesai' => $input['selesai'],
            'keterangan' => $input['keterangan'],
            'satpam_id' => $input['satpam_id'],
        ]);

        foreach($input['lampirans'] as $lampiran){
            $random = Str::random(10);
            $destination_path = 'public/lampiran/';
            $image = $lampiran;
            // $image_name = $image->getCLientOriginalName();
            $ext = $lampiran->extension();
            $image_name = $random.'.'.$ext;
            $path = $lampiran->storeAs($destination_path, $image_name);
            // dd($data->id);
            Lampiran::create([
                'nama_lampiran' => $image_name,
                'rekap_tugas_id' => $data->id,
            ]);
        }
        
        
        if($input['regu_id'] == '1'){
            return redirect('/rekap-tugas')->withInput(['tab'=>'tab-reguA'])->with('statusA','Data Berhasil Ditambah!'); 
        }elseif($input['regu_id'] == '2'){
            return redirect('/rekap-tugas')->withInput(['tab'=>'tab-reguB'])->with('statusB','Data Berhasil Ditambah!');
        }elseif ($input['regu_id'] == '3'){
            return redirect('/rekap-tugas')->withInput(['tab'=>'tab-reguC'])->with('statusC','Data Berhasil Ditambah!');
        }else{
            return redirect('/rekap-tugas')->withInput(['tab'=>'tab-reguD'])->with('statusD','Data Berhasil Ditambah!');
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
        // dd($request->all());
        $request->validate([
            'uraian_tugas' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            'keterangan' => 'required',
            'lampirans' => 'required',
            'lampirans.*' => 'mimes:jpg,png,jpeg,PNG|max:4000',
        ]);
        $user_zona = Auth::user()->zona->id;
        $input = $request->all();
        $rekap_tugas = RekapTugas::where('id',$id);
        $rekap_tugas->update([
            'uraian_tugas' => $input['uraian_tugas'],
            'mulai' => $input['mulai'],
            'selesai' => $input['selesai'],
            'keterangan' => $input['keterangan'],
            'satpam_id' => $input['satpam_id'],
        ]);

        $lampirans = Lampiran::where('rekap_tugas_id', $id)->get();
        Lampiran::where('rekap_tugas_id', $id)->delete();
        foreach($lampirans as $lampiran){
            File::delete('storage/lampiran/'.$lampiran->nama_lampiran);
        }

        foreach($input['lampirans'] as $lampiran){
            $random = Str::random(10);
            $destination_path = 'public/lampiran/';
            $image = $lampiran;
            // $image_name = $image->getCLientOriginalName();
            $ext = $lampiran->extension();
            $image_name = $random.'.'.$ext;
            $path = $lampiran->storeAs($destination_path, $image_name);
            // dd($data->id);
            Lampiran::create([
                'nama_lampiran' => $image_name,
                'rekap_tugas_id' => $id,
            ]);
        }
        if($input['regu_id'] == '1'){
            return redirect('/rekap-tugas')->withInput(['tab'=>'tab-reguA'])->with('statusA','Data Berhasil Diupdate!'); 
        }elseif($input['regu_id'] == '2'){
            return redirect('/rekap-tugas')->withInput(['tab'=>'tab-reguB'])->with('statusB','Data Berhasil Diupdate!');
        }elseif ($input['regu_id'] == '3'){
            return redirect('/rekap-tugas')->withInput(['tab'=>'tab-reguC'])->with('statusC','Data Berhasil Diupdate!');
        }else{
            return redirect('/rekap-tugas')->withInput(['tab'=>'tab-reguD'])->with('statusD','Data Berhasil Diupdate!');
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
        $rekaptugas = RekapTugas::where('id',$id)->delete();
        $lampirans = Lampiran::where('rekap_tugas_id', $id)->get();
        Lampiran::where('rekap_tugas_id', $id)->delete();

        foreach($lampirans as $lampiran){
            File::delete('storage/lampiran/'.$lampiran->nama_lampiran);
        }

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
