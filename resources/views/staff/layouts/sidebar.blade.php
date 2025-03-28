<aside class="sidebar-wrapper">
    <div class="sidebar-header">
      <div class="logo-icon">
        <img src="/images/logo.svg" style="width: 140px" class="logo-img" alt="">
      </div>
      <div class="logo-name flex-grow-1">
        <h5 class="mb-0">HMS</h5>
      </div>
      <div class="sidebar-close">
        <span class="material-icons-outlined">close</span>
      </div>
    </div>
    <div class="sidebar-nav" data-simplebar="true">
      
        <!--navigation-->
        <ul class="metismenu" id="sidenav">
          <li>
            <a href="{{ route('staff.admin') }}">
              <div class="parent-icon"><i class="material-icons-outlined">dashboard</i>
              </div>
              <div class="menu-title">Dashboard</div>
            </a>
          </li>
          @if(auth()->user()->hasRole('Super Admin'))
          <li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><i class="material-icons-outlined">home</i>
              </div>
              <div class="menu-title">Roles & Permissions</div>
            </a>
            <ul>
              <li>
                <a href="{{ route('roles.index') }}"><i class="material-icons-outlined">arrow_right</i>Roles
                <span class="badge bg-info ml-2">{{ \Spatie\Permission\Models\Role::count() }}</span></a>
              </a>
                </li>
                <li>
                <a href="{{ route('permissions.index') }}"><i class="material-icons-outlined">arrow_right</i>Permissions
                <span class="badge bg-info ml-2">{{ \Spatie\Permission\Models\Permission::count() }}</span></a>
              </a>
                </li>
                <li>
                  <a href="{{ route('users.index') }}"><i class="material-icons-outlined">arrow_right</i>Users
                  <span class="badge bg-info ml-2">{{ \App\Models\User::count() }}</span></a>
                </a>
                  </li>
            </ul>
          </li>
          @endif
         </ul>
        <!--end navigation-->
    </div>
    <div class="sidebar-bottom gap-4">
        <div class="dark-mode">
          <a href="javascript:;" class="footer-icon dark-mode-icon">
            <i class="material-icons-outlined">dark_mode</i>  
          </a>
        </div>

    </div>
</aside>