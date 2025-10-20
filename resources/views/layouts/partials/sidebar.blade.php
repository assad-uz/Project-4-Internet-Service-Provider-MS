<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ url('/dashboard') }}" class="app-brand-link">
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
    <li class="menu-item active open">
      <a href="/dashboard" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-smile"></i>
        <div class="text-truncate" data-i18n="Dashboards">Dashboards</div>
      </a>
    </li>

    <!-- Layouts -->
    <li class="menu-item">
      <a href="{{route('users.index')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div class="text-truncate" data-i18n="Layouts">Users</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="{{route('packages.index')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-list-ul"></i>
        <div class="text-truncate" data-i18n="Layouts">Packages</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-tachometer"></i>
        <div class="text-truncate" data-i18n="Layouts">Speed</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-link-alt"></i>
        <div class="text-truncate" data-i18n="Layouts">Connections</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-layout"></i>
        <div class="text-truncate" data-i18n="Layouts">Bills</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-wallet-alt"></i>
        <div class="text-truncate" data-i18n="Layouts">Payments</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-edit"></i>
        <div class="text-truncate" data-i18n="Layouts">Reports</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
              <span class="menu-header-text">MISC</span>
            </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-globe"></i>
        <div class="text-truncate" data-i18n="Layouts">Portal</div>
      </a>
    </li>
  </ul>
</aside>