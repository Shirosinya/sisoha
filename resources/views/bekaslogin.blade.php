{{-- Extends layout --}}
@extends('layout.fullwidth')


{{-- Content --}}
@section('content')
	<div class="col-md-6">
      <div class="authincation-content">
          <div class="row no-gutters">
              <div class="col-xl-12">
                  <div class="auth-form">
                      <div class="text-center mb-3">
                        <a href="{!! url('/index'); !!}"><img  src="{{ asset('images/logo-full.png') }}" alt=""></a>
                      </div>
                      <h4 class="text-center mb-4">Masukkan Akun Zona</h4>
                      <form method="POST" action="{{route('login')}}">
                          <div class="form-group">
                              <label class="mb-1"><strong>Nama Pengguna</strong></label>
                              <input required name="nama" type="text" class="form-control" placeholder="Masukkan Nama Pengguna">
                          </div>
                          <div class="form-group">
                              <label class="mb-1"><strong>Password</strong></label>
                              <input required name="password" type="password" class="form-control" placeholder="Password">
                          </div>
                          <div class="form-row d-flex justify-content-between mt-4 mb-2">
                              <div class="form-group">
                                 <div class="custom-control custom-checkbox ml-1">
                                    <input type="checkbox" class="custom-control-input" id="basic_checkbox_1">
                                    <label class="custom-control-label" for="basic_checkbox_1">Ingat Saya</label>
                                </div>
                              </div>
                              <div class="form-group">
                                  <a href="{!! url('/page-forgot-password'); !!}">Forgot Password?</a>
                              </div>
                          </div>
                          <div class="text-center">
                              <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                          </div>
                      </form>
                      <!-- <div class="new-account mt-3">
                          <p>Don't have an account? <a class="text-primary" href="{!! url('/page-register'); !!}">Sign up</a></p>
                      </div> -->
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection