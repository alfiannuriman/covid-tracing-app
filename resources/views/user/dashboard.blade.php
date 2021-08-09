@extends('admin.layouts.template')
@section('content')
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header bg-transparent">
          <h6 class="text-muted ls-1 mb-1">Selamat datang,</h6>
          <h5 class="h3 mb-0 text-uppercase">{{ auth()->user()->name }}</h5>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-md-6">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">
                Total active alert 
                <a 
                  href="#" 
                  data-toggle="tooltip" 
                  data-placement="top" 
                  title="Help" 
                  class="mx-2"
                >
                  <i class="fa fa-question-circle"></i>
                </a>
              </h5>
              <span class="h2 font-weight-bold mb-0">350,897</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                <i class="fa fas fa-exclamation-circle"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
            <span class="text-nowrap">Since last month</span>
          </p>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">
                Total alert resolved
                <a 
                  href="#" 
                  data-toggle="tooltip" 
                  data-placement="top" 
                  title="Help" 
                  class="mx-2"
                >
                  <i class="fa fa-question-circle"></i>
                </a>
              </h5>
              <span class="h2 font-weight-bold mb-0">2,356</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                <i class="fa fas fa-check-double"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
            <span class="text-nowrap">Since last month</span>
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12 col-md-12">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">
                Today place visited
                <a 
                  href="#" 
                  data-toggle="tooltip" 
                  data-placement="top" 
                  title="Help" 
                  class="mx-2"
                >
                  <i class="fa fa-question-circle"></i>
                </a>
              </h5>
              <span class="h2 font-weight-bold mb-0">325,000</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                <i class="fa fas fa-map-marked-alt"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
            <span class="text-nowrap">Since last month</span>
          </p>
        </div>
      </div>
    </div>
  </div>
@stop