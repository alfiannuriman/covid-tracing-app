@extends('layouts.minimum.template', ['page_title' => 'Register', 'page_subtitle' => 'Silahkan register dengan data pribadi anda.'])
@section('content')
  <div class="container mt--8 pb-5">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-body px-lg-5 py-lg-5">
            <div class="text-center text-muted mb-4">
              <small>Register with your information</small>
            </div>
            <form role="form" method="POST" action="{{ url('/auth/register') }}">

              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                  </div>
                  <input name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                  @error('name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                  </div>
                  <input name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                  @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="form-group">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                  </div>
                  <input name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" type="password">
                  @error('password')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary my-4 btn-block">Register</button>
              </div>
              @csrf
            </form>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <a href="{{ url('/auth/login') }}" class="text-light"><small>Already have an acoount ?, please login</small></a>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop