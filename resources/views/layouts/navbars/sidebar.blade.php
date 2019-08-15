<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="/" class="simple-text logo-normal">
      <h2>{{ __('WARMS') }}</h2>
    </a>
  </div>
  <div class="sidebar-wrapper">
    @auth
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'webspace_list' || $activePage == 'platform_list') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#webspace" aria-expanded="false">
        <i class="material-icons">cloud</i>
          <p>{{ __('Webspace') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'webspace_list' || $activePage == 'platform_list' ) ? ' show' : '' }}" id="webspace">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'webspace_list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('webspace.list') }}">
                <span class="sidebar-mini"> WL </span>
                <span class="sidebar-normal">{{ __('List') }} </span>
              </a>
            </li>
            @hasanyrole("super-admin|admin|editor")
            <li class="nav-item{{ $activePage == 'platform_list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('platform.list') }}">
              <span class="sidebar-mini"> PL </span>
                <span class="sidebar-normal">{{ __('Platform') }} </span>
              </a>
            </li>
            @endhasanyrole
          </ul>
        </div>
      </li>
      @hasanyrole("super-admin|admin|editor")
      <li class="nav-item {{ ($activePage == 'department_list' || $activePage == 'designation_list' || $activePage == 'owner_list') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#owner" aria-expanded="false">
          <i class="material-icons">face</i>
          <p>{{ __('Owner') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'department_list' || $activePage == 'designation_list' || $activePage == 'owner_list') ? ' show' : '' }}" id="owner">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'owner_list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('owner.list') }}">
                <span class="sidebar-mini"> OL </span>
                <span class="sidebar-normal">{{ __('List') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'department_list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('department.list') }}">
                <span class="sidebar-mini"> DL </span>
                <span class="sidebar-normal">{{ __('Department') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'designation_list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('designation.list') }}">
                <span class="sidebar-mini"> DeL </span>
                <span class="sidebar-normal"> {{ __('Designation') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      @endhasanyrole
      @hasanyrole("super-admin")
      <li class="nav-item{{ $activePage == 'server_list' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('server.list') }}">
          <i class="material-icons">developer_board</i>
            <p>{{ __('Server') }}</p>
        </a>
      </li>
      @endhasanyrole
      <li class="nav-item {{ ($activePage == 'webspace-export' || $activePage == 'webspace-import') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#tools" aria-expanded="false">
          <i class="material-icons">settings</i>
          <p>{{ __('Tools') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'webspace-export' || $activePage == 'webspace-import') ? ' show' : '' }}" id="tools">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'webspace-export' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('webspace.export') }}">
                <span class="sidebar-mini"> EW </span>
                <span class="sidebar-normal">{{ __('Export Webspace') }} </span>
              </a>
            </li>
            @hasanyrole("super-admin")
            <li class="nav-item{{ $activePage == 'webspace-import' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('webspace.import') }}">
                <span class="sidebar-mini"> EW </span>
                <span class="sidebar-normal">{{ __('Import Webspace') }} </span>
              </a>
            </li>
            @endhasanyrole
          </ul>
        </div>
      </li>
      @hasanyrole("admin|super-admin")
      <li class="nav-item {{ ( $activePage == 'site-settings'|| $activePage == 'user-management' ) ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#admin" aria-expanded="false">
          <i class="material-icons">settings</i>
          <p>{{ __('Administration') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'site-settings' || $activePage == 'user-management') ? ' show' : '' }}" id="admin">
          <ul class="nav">
            <li class="nav-item {{ ($activePage == 'user-management') ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
              <span class="sidebar-mini"> U </span>
                <p>{{ __('Users') }}</p>
              </a>
            </li>
            @hasanyrole("super-admin")
            <li class="nav-item{{ $activePage == 'site-settings' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('settings.edit') }}">
                <span class="sidebar-mini"> SS </span>
                <span class="sidebar-normal"> {{ __('Site Settings') }} </span>
              </a>
            </li>
            @endhasanyrole
          </ul>
        </div>
      </li>
      @endhasanyrole
    </ul>
    @endauth
  </div>
</div>