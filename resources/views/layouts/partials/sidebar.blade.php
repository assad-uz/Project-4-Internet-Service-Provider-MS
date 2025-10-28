<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ url('/') }}" class="app-brand-link">
        <span class="app-brand-logo demo">
            <img src="admin-src/assets/img/logo/my_logo.png" alt="My Company Logo" class="w-auto h-auto" style="height: 25px;"/> 
        </span>
        <span class="app-brand-text demo menu-text fw-bold ms-2">SwiftNet</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
    </a>
</div>

  <div class="menu-divider mt-0"></div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
      <a href="/dashboard" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-smile"></i>
        <div class="text-truncate" data-i18n="Dashboards">Dashboards</div>
      </a>
    </li>

    <!-- Layouts -->
    <li class="menu-item {{ request()->is('users') ? 'active' : '' }}">
      <a href="{{route('users.index')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div class="text-truncate" data-i18n="Layouts">Users</div>
      </a>
    </li>

    <li class="menu-item {{ request()->is('') ? 'active' : '' }}">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-building-house"></i>
        <div class="text-truncate" data-i18n="Layouts">Customer Types</div>
      </a>
    </li>
    
    <li class="menu-item {{ request()->is('packages') ? 'active' : '' }}">
      <a href="{{route('packages.index')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-list-ul"></i>
        <div class="text-truncate" data-i18n="Layouts">Packages</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Location</span></li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-bullseye"></i>
        <div class="text-truncate" data-i18n="Layouts">Areas</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-box"></i>
        <div class="text-truncate" data-i18n="Layouts">Distribution Box</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Connection &amp; Billings</span></li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-tachometer"></i>
        <div class="text-truncate" data-i18n="Layouts">Connections</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-layout"></i>
        <div class="text-truncate" data-i18n="Layouts">Billings</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-wallet-alt"></i>
        <div class="text-truncate" data-i18n="Layouts">Payments</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Services</span></li>
    <li class="menu-item {{ request()->is('') ? 'active' : '' }}">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-help-circle"></i>
        <div class="text-truncate" data-i18n="Layouts">Tickets</div>
      </a>
    </li>

    <li class="menu-item {{ request()->is('') ? 'active' : '' }}">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-envelope-open"></i>
        <div class="text-truncate" data-i18n="Layouts">Contact Messages</div>
      </a>
    </li>

    <li class="menu-item {{ request()->is('') ? 'active' : '' }}">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-notification"></i>
        <div class="text-truncate" data-i18n="Layouts">Newsletter Subscriptions</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Report</span></li>
    <li class="menu-item {{ request()->is('report') ? 'active' : '' }}">
      <a href="/report" class="menu-link">
        <i class="menu-icon tf-icons bx bx-edit"></i>
        <div class="text-truncate" data-i18n="Layouts">Reports</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
              <span class="menu-header-text">MISC</span>
            </li>

    <li class="menu-item">
      <a href="{{ url('http://127.0.0.1:8000/') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-globe"></i>
        <div class="text-truncate" data-i18n="Layouts">Portal</div>
      </a>
    </li>
  </ul>
</aside>