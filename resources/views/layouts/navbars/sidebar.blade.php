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
      <li class="nav-item {{ ($activePage == 'webspace_list' || $activePage == 'webspace_add') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('webspace.list') }}" >
          <i class="material-icons">cloud</i>
          <p>{{ __('Webspace') }}</p>
        </a>
      </li>
      @hasanyrole("super-admin|admin|editor")
      <li class="nav-item {{ ($activePage == 'owner_list' || $activePage == 'owner_add') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('owner.list') }}">
          <i class="material-icons">face</i>
          <p>{{ __('Owner') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'platform_list' || $activePage == 'platform_add') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('platform.list') }}">
          <i class="material-icons">domain</i>
          <p>{{ __('Platform') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'department_list' || $activePage == 'department_add') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('department.list') }}">
          <i class="material-icons">store</i>
          <p>{{ __('Department') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'designation_list' || $activePage == 'designation_add') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('designation.list') }}">
          <i class="material-icons">how_to_reg</i>
          <p>{{ __('Designation') }}</p>
        </a>
      </li>
      @hasanyrole("super-admin|admin")
      <li class="nav-item {{ ($activePage == 'user-management' || $activePage == 'user_add') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.index') }}">
          <i class="material-icons">how_to_reg</i>
          <p>{{ __('Users') }}</p>
        </a>
      </li>
      @endhasanyrole
      @hasanyrole("super-admin|admin")
      <li class="nav-item {{ ($activePage == 'webspace-export' || $activePage == 'site-settings') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#admin" aria-expanded="false">
          <i class="material-icons">settings</i>
          <p>{{ __('Administration') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'webspace-export' || $activePage == 'site-settings' || $activePage == 'webspace-import') ? ' show' : '' }}" id="admin">
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
      @endhasanyrole
    </ul>
    @endauth
  </div>
</div>