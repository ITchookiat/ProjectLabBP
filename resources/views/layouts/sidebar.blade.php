@php
  function active($currect_page) {
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);
    if($currect_page == $url) {
      echo 'active'; //class name in css
    }
  }
@endphp

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('index','home') }}" class="brand-link">
      <img src="{{ asset('dist/img/Mazdalogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Body and Pain</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      {{--<div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->username }}</a>
        </div>
      </div>--}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if(auth::user()->position == "Admin")
            <li class="nav-item has-treeview {{ Request::is('maindata/view*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-window-restore"></i>
                <p>
                  ข้อมูลหลัก
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="margin-left: 15px;">
                <li class="nav-item">
                  <a href="{{ route('ViewMaindata') }}" class="nav-link active">
                    <i class="far fa-id-badge text-red nav-icon"></i>
                    <p>ข้อมูลผู้ใช้งานระบบ</p>
                  </a>
                </li>
              </ul>
            </li>
          @endif

          <li class="nav-item has-treeview {{ Request::is('MasterBP*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-sitemap"></i>
              <p>
                ระบบศูนย์ตัวถังและสี
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
              <ul class="nav nav-treeview">
                <li class="nav-item has-treeview {{ Request::is('MasterBP*') ? 'menu-open' : '' }}">
                  <a href="#" class="nav-link">
                    <i class="far fa-window-restore text-red nav-icon"></i>
                    <p>
                      ระบบ
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="margin-left: 15px;">
                        @if(auth::user()->position == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "SA")
                        <li class="nav-item">
                          <a href="{{ route('MasterBP.index') }}?type={{1}}" class="nav-link {{ (request()->is($type === '1')) ? 'active' : '' }}">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>รายการงานเคลม</p>
                          </a>
                        </li>
                        @endif
                        @if(auth::user()->position == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "SA" or auth::user()->position == "TECHNICIAN")
                        <li class="nav-item">
                          <a href="{{ route('MasterBP.index') }}?type={{2}}" class="nav-link {{ (request()->is($type === '2')) ? 'active' : '' }}">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>รายการรถระหว่างซ่อม</p>
                          </a>
                        </li>
                        @endif
                        @if(auth::user()->position == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "SA")
                        <li class="nav-item">
                          <a href="{{ route('MasterBP.index') }}?type={{3}}" class="nav-link {{ (request()->is($type === '3')) ? 'active' : '' }}">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>รายการรถส่งมอบ</p>
                          </a>
                        </li>
                        @endif
                        @if(auth::user()->position == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "SA" or auth::user()->position == "STAFF")
                        <li class="nav-item">
                          <a href="{{ route('MasterBP.index') }}?type={{4}}" class="nav-link {{ (request()->is($type === '4')) ? 'active' : '' }}">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>รายการอะไหล่</p>
                          </a>
                        </li>
                        @endif
                  </ul>
                </li>
                <!-- <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="far fa-window-restore text-red nav-icon"></i>
                    <p>
                      รายงาน
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="margin-left: 15px;">
                        <li class="nav-item">
                          <a href="{{ route('MasterBP.index') }}?type={{1}}" class="nav-link ">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>รายงานโทรแจ้ง</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>รายงานรถซ่อมจริง</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <i class="far fa-dot-circle nav-icon"></i>
                            <p>รายงานรถส่งมอบ</p>
                          </a>
                        </li>
                  </ul>
                </li> -->
              </ul>

          </li>

          {{--<li class="nav-item has-treeview {{ Request::is('Treasury/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link active">
              <span id="ShowData"></span>
              <span class="badge badge-danger navbar-badge">3</span>
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                แผนกการเงิน
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก การเงินใน" or auth::user()->type == "แผนก วิเคราะห์")
              <ul class="nav nav-treeview" style="margin-left: 15px;">
                <li class="nav-item">
                  <a href="{{ route('treasury', 1) }}" class="nav-link {{ Request::is('Treasury/Home/1') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Approving Transfers</p>
                  </a>
                </li>
              </ul>
            @endif
          </li>--}}

          {{--<li class="nav-item has-treeview {{ Request::is('Account/*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link active">
              <i class="nav-icon fab fa-leanpub"></i>
              <span id="ShowData"></span>
              <p>
                แผนกบัญชี
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            @if(auth::user()->type == "Admin" or auth::user()->type == "แผนก บัญชี" or auth::user()->type == "แผนก วิเคราะห์")
              <ul class="nav nav-treeview" style="margin-left: 15px;">
                <li class="nav-item">
                  <a href="{{ route('Accounting', 1) }}" class="nav-link {{ Request::is('Account/Home/1') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Internal Audit</p>
                  </a>
                  <a href="{{ route('Accounting', 3) }}" class="nav-link {{ Request::is('Account/Home/3') ? 'active' : '' }}">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Report PLoan-Micro</p>
                  </a>
                </li>
              </ul>
            @endif
          </li>--}}

        </ul>
      </nav>


    </div>
  </aside>