<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AkunController extends Controller
{
    //login
    public function otentifikasi(Request $request){
        // $this->validate($request, [
        //     'nama' => 'required|string',
        //     'password' => 'required|string|min:8',
        // ]);

        // $page_title = 'Landing';
        // $page_description = 'Some description for the page';
        // $logo = "images/logo.png";
        // $logoText = "images/logo-text.png";
        // $action = __FUNCTION__;
        // $user = $request->all();
        // if (User::where('nama',$user)->first()) {
            //JIKA BERHASIL, MAKA REDIRECT KE HALAMAN HOME
        //     $request->session()->regenerate();
        //     return redirect('index');
        // }else{
        //     return redirect('/');
        // }
    }
}
