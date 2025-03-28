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
            <a href="{{ route('dashboard') }}">
              <div class="parent-icon"><i class="material-icons-outlined">dashboard</i>
              </div>
              <div class="menu-title">Dashboard</div>
            </a>
          </li>

          
          <li>
            <a href="{{ route('profile') }}">
              <div class="parent-icon"><i class="material-icons-outlined">person</i>
              </div>
              <div class="menu-title">My Profile</div>
            </a>
          </li>
         
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