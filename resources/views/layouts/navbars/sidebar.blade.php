<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="/" class="simple-text logo-normal">
      <h2>{{ __('WRMS') }}</h2>
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'webspace_list' || $activePage == 'webspace_add') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#webspace" aria-expanded="false">
          <i class="material-icons">cloud</i>
          <p>{{ __('Webspace') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'webspace_list' || $activePage == 'webspace_add') ? ' show' : '' }}" id="webspace">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'webspace_list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('webspace.list') }}">
                <span class="sidebar-mini"> WL </span>
                <span class="sidebar-normal">{{ __('List') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'webspace_add' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('webspace.add') }}">
                <span class="sidebar-mini"> WAN </span>
                <span class="sidebar-normal"> {{ __('Add New') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'owner_list' || $activePage == 'owner_add') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#owner" aria-expanded="false">
          <i class="material-icons">face</i>
          <p>{{ __('Owner') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'owner_list' || $activePage == 'owner_add') ? ' show' : '' }}" id="owner">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'owner_list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('owner.list') }}">
                <span class="sidebar-mini"> OL </span>
                <span class="sidebar-normal">{{ __('List') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'owner_add' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('owner.add') }}">
                <span class="sidebar-mini"> OAN </span>
                <span class="sidebar-normal"> {{ __('Add New') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'platform_list' || $activePage == 'platform_add') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#platform" aria-expanded="false">
          <i class="material-icons">domain</i>
          <p>{{ __('Platform') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'platform_list' || $activePage == 'platform_add') ? ' show' : '' }}" id="platform">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'platform_list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('platform.list') }}">
                <span class="sidebar-mini"> PL </span>
                <span class="sidebar-normal">{{ __('List') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'platform_add' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('platform.add') }}">
                <span class="sidebar-mini"> PAN </span>
                <span class="sidebar-normal"> {{ __('Add New') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'department_list' || $activePage == 'department_add') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#department" aria-expanded="false">
        <i class="material-icons">store</i>
          <p>{{ __('Department') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'department_list' || $activePage == 'department_add') ? ' show' : '' }}" id="department">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'department_list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('department.list') }}">
                <span class="sidebar-mini"> DL </span>
                <span class="sidebar-normal">{{ __('List') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'department_add' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('department.add') }}">
                <span class="sidebar-mini"> DAN </span>
                <span class="sidebar-normal"> {{ __('Add New') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'designation_list' || $activePage == 'designation_add') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#designation" aria-expanded="false">
          <i class="material-icons">how_to_reg</i>
          <p>{{ __('Designation') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'designation_list' || $activePage == 'designation_add') ? ' show' : '' }}" id="designation">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'designation_list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('designation.list') }}">
                <span class="sidebar-mini"> DeL </span>
                <span class="sidebar-normal">{{ __('List') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'designation_add' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('designation.add') }}">
                <span class="sidebar-mini"> DeAN </span>
                <span class="sidebar-normal"> {{ __('Add New') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'user-management' || $activePage == 'user_add') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#user" aria-expanded="false">
          <i class="material-icons">how_to_reg</i>
          <p>{{ __('Users') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'user-management' || $activePage == 'user_add') ? ' show' : '' }}" id="user">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UL </span>
                <span class="sidebar-normal">{{ __('List') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user_add' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.create') }}">
                <span class="sidebar-mini"> UAN </span>
                <span class="sidebar-normal"> {{ __('Add New') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>