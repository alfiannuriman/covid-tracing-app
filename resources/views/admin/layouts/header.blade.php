<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">

      @if (session()->has('general.alert'))
        @php
          $flash_message = session('general.alert');
          $alert_class = 'alert-default';
          $alert_title = is_string($flash_message) ? $flash_message : '';
          $alert_subtitle = '';
          $alert_icon = 'fas fa-info-circle';

          if (is_array($flash_message)) {
            if (isset($flash_message['type'])) {
              $alert_class = 'alert-' . $flash_message['type'];

              switch ($flash_message['type']) {
                case 'success':
                  $alert_icon = 'fas fa-check-circle';
                  break;

                case 'warning':
                  $alert_icon = 'fas fa-exclamation-circle';
                  break;

                case 'danger':
                  $alert_icon = 'fas fa-times-circle';
                  break;
                
                default:
                  $alert_icon = 'fas fa-info-circle';
                  break;
              }

            }

            if (isset($flash_message['title'])) {
              $alert_title = $flash_message['title'];
            }

            if (isset($flash_message['subtitle'])) {
              $alert_subtitle = $flash_message['subtitle'];
            }
          }

        @endphp

        <div class="row align-items-center py-4">
          <div class="col-8 offset-2">
            <div class="alert alert-dismissible fade show {{ $alert_class }}" role="alert">
              <span class="alert-icon"><i class="{{ $alert_icon }}"></i></span>
              <span class="alert-text"><strong>{{ $alert_title }}</strong> {{ $alert_subtitle }}</span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
        </div>

      @endif

      <div class="row align-items-center py-4">
        <div class="col-lg-12 col-12">
          <h6 class="h2 text-white d-inline-block mb-0">{{ isset($meta['title']) ? $meta['title'] : '' }}</h6>
          @if (isset($meta['breadcrumbs']))
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                @foreach ($meta['breadcrumbs'] as $crumb)
                  <li class="breadcrumb-item">
                    <a href="{{ ( isset($crumb['link']) && !is_null($crumb['link']) ) ? $crumb['link'] : '#' }}">
                      @if (isset($crumb['icon']) && !is_null($crumb['icon']))
                        <i class="{{ $crumb['icon'] }}"></i>
                      @endif

                      {{ ( isset($crumb['title']) && !is_null($crumb['title']) ) ? $crumb['title'] : '' }}
                    </a>
                  </li>
                @endforeach
              </ol>
            </nav>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>