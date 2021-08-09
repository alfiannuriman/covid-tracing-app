<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header  align-items-center">
      <a class="navbar-brand" href="javascript:void(0)">
        <img src="{{ asset('static/img/brand/logo-black.png') }}" class="navbar-brand-img" alt="...">
      </a>
    </div>
    <div class="navbar-inner">
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Nav items -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="{{ (auth()->user()->hasRole(\App\Models\User::ROLE_USER_ADMIN)) ? url('/admin/dashboard') : url('/user/dashboard') }}">
              <i class="ni ni-tv-2 text-primary"></i>
              <span class="nav-link-text">Dashboard</span>
            </a>
          </li>

          @if ((auth()->user()->hasRole([\App\Models\User::ROLE_USER_ADMIN, \App\Models\User::ROLE_USER_PLACE_ADMIN])))
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/admin/places') }}">
                <i class="ni ni-building text-primary"></i>
                <span class="nav-link-text">Places</span>
              </a>
            </li>              
          @endif

          @if (auth()->user()->hasRole(\App\Models\User::ROLE_USER_CUSTOMER))
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/user/profile') }}">
                <i class="ni ni-single-02 text-primary"></i>
                <span class="nav-link-text">Profile</span>
              </a>
            </li>            
          @endif

          <li class="nav-item">
            <a class="nav-link" href="{{ url('/user/place-registration') }}">
              <i class="ni ni-pin-3 text-primary"></i>
              <span class="nav-link-text">Place registration</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/user/alerting') }}">
              <i class="ni ni-notification-70 text-primary"></i>
              <span class="nav-link-text">Alerting</span>
            </a>
          </li>
        </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading p-0 text-muted">
          <span class="docs-normal">Information</span>
        </h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-question-circle"></i>
              <span class="nav-link-text">Help center</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-info-circle"></i>
              <span class="nav-link-text">About</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-headset"></i>
              <span class="nav-link-text">119 | Hotline COVID-19</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>