@extends('admin.layouts.template')
@section('content')

<div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url({{ asset('static/img/theme/profile-cover.jpg') }}); background-size: cover; background-position: center top;">
  <!-- Mask -->
  <span class="mask bg-gradient-default opacity-8"></span>
  <!-- Header container -->
  <div class="container-fluid d-flex align-items-center">
    <div class="row">
      <div class="col-lg-7 col-md-10">
        <h1 class="display-2 text-white">Hello {{ isset($user->name) ? $user->name : '' }}</h1>
        <p class="text-white mt-0 mb-5">This is your profile page. You can see and setup all information people need to know about yourself. Please setup your profile with valid information for better use of this platform</p>
      </div>
    </div>
  </div>
</div>


<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-xl-4 order-xl-2">
      <div class="card card-profile">
        <img src="{{ asset('static/img/theme/img-1-1000x600.jpg') }}" alt="Image placeholder" class="card-img-top">
        <div class="row justify-content-center">
          <div class="col-lg-3 order-lg-2">
            <div class="card-profile-image">
              <a href="#">
                <img src="{{ asset('static/img/theme/team-4.jpg') }}" class="rounded-circle">
              </a>
            </div>
          </div>
        </div>
        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
          <div class="d-flex justify-content-between">
          </div>
        </div>
        <div class="card-body pt-0">
          <div class="row">
            <div class="col">
              <div class="card-profile-stats d-flex justify-content-center">
              </div>
            </div>
          </div>
          <div class="text-center">
            <h5 class="h3">
              {{ $user->name }}<span class="font-weight-light">, {{ !is_null($profile) ? $profile->age : '' }}</span>
            </h5>
            <div class="h5 font-weight-300">
              <i class="ni location_pin mr-2"></i>{{ !is_null($profile->gender) ? $profile->gender->name : '' }}
            </div>
            <div class="h5 mt-4">
              <i class="ni business_briefcase-24 mr-2"></i>{{ $user->email }} | {{ !is_null($profile->phone) ? $profile->phone : '' }}
            </div>
            <div>
              {{ !is_null($profile->address) ? $profile->address : '' }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-8 order-xl-1">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Profile </h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="{{ url('/user/profile') }}" method="POST">
            @csrf
            <h6 class="heading-small text-muted mb-4">User information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label" for="input-username">name</label>
                    <input name="name" type="text" id="input-username" class="form-control" placeholder="Username" value="{{ isset($user->name) ? $user->name : '' }}" readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-country">Gender</label>
                    <select name="gender_id" id="input-country" class="form-control">
                      @foreach ($form_options['genders'] as $gender)
                        <option value="{{ $gender->id }}" {{ (isset($profile->gender_id) && $profile->gender_id == $gender->id) ? 'selected' : '' }}>{{ $gender->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-country">Birth date</label>
                    <input name="birth_date" type="text" id="input-country" class="form-control" placeholder="YYYY-mm-dd" value="{{ isset($profile->birth_date) ? $profile->birth_date : '' }}">
                  </div>
                </div>
              </div>
            </div>
            <hr class="my-4" />
            <!-- Address -->
            <h6 class="heading-small text-muted mb-4">Contact information</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-control-label" for="input-address">Address</label>
                    <input name="address" id="input-address" class="form-control" placeholder="Home Address" value="{{ isset($profile->address) ? $profile->address : '' }}" type="text">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-city">Phone</label>
                    <input name="phone" type="text" id="input-city" class="form-control" placeholder="Phone" value="{{ isset($profile->phone) ? $profile->phone : '' }}">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="input-email">Email address</label>
                    <input name="email" type="email" id="input-email" class="form-control" value="{{ isset($user->email) ? $user->email : '' }}" readonly>
                  </div>
                </div>
              </div>
            </div>
            <hr class="my-4" />
            <!-- Description -->
            <h6 class="heading-small text-muted mb-4">About me</h6>
            <div class="pl-lg-4">
              <div class="form-group">
                <label class="form-control-label">About Me</label>
                <textarea name="about" rows="4" class="form-control">{{ isset($profile->about) ? $profile->about : '' }}</textarea>
              </div>
            </div>
            
            <button type="submit" class="btn btn-primary float-right">Update profile</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@stop