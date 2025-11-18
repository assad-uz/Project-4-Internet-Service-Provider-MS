<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ url('/') }}" class="app-brand-link">
        <span class="app-brand-logo demo">
            <img src="{{ asset('admin-src/assets/img/logo/my_logo.png') }}" alt="My Company Logo" class="w-auto h-auto" style="height: 25px;"/> 
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
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div class="text-truncate" data-i18n="Layouts">Users</div>
      </a>
    </li>

    <li class="menu-item {{ request()->is('customer_types*') ? 'active' : '' }}">
  <a href="{{ route('customer_types.index') }}" class="menu-link">
    <i class="menu-icon tf-icons bx bx-user-pin"></i> 
    <div class="text-truncate" data-i18n="Customer Types">Customer Types</div>
  </a>
</li>
    
    <li class="menu-item {{ request()->is('packages') ? 'active' : '' }}">
      <a href="{{route('packages.index')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-list-ul"></i>
        <div class="text-truncate" data-i18n="Layouts">Packages</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Location</span></li>
    <li class="menu-item {{ request()->is('areas*') ? 'active' : '' }}">
  <a href="{{ route('areas.index') }}" class="menu-link">
    <i class="menu-icon tf-icons bx bx-bullseye"></i> <div class="text-truncate" data-i18n="Areas">Areas</div>
  </a>
</li>

    <li class="menu-item {{ request()->is('distribution_boxes*') ? 'active' : '' }}">
  <a href="{{ route('distribution_boxes.index') }}" class="menu-link">
    <i class="menu-icon tf-icons bx bx-box"></i> <div class="text-truncate" data-i18n="Distribution Box">Distribution Box</div>
  </a>
</li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Connections</span></li>
    <li class="menu-item {{ request()->is('customers*') ? 'active' : '' }}">
      <a href="{{ route('customers.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user-plus"></i> 
        <div class="text-truncate" data-i18n="Customers">Customers</div>
      </a>
    </li>

    <li class="menu-item {{ request()->is('connections*') ? 'active' : '' }}">
      <a href="{{ route('connections.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-globe"></i> 
        <div class="text-truncate" data-i18n="Connections">Connections</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Billing &amp; Payments</span></li>
    <li class="menu-item {{ request()->is('billings*') ? 'active' : '' }}">
      <a href="{{ route('billings.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-credit-card"></i> 
        <div class="text-truncate" data-i18n="Billings">Billings</div>
      </a>
    </li>

    <li class="menu-item {{ request()->is('payments*') ? 'active' : '' }}">
      <a href="{{ route('payments.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-wallet"></i> 
        <div class="text-truncate" data-i18n="Payments">Payments</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Services</span></li>
    <li class="menu-item {{ request()->is('') ? 'active' : '' }}">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-help-circle"></i>
        <div class="text-truncate" data-i18n="Layouts">Support Tickets</div>
      </a>
    </li>

    <li class="menu-item {{ request()->is('') ? 'active' : '' }}">
      <a href="javascript:void(0);" class="menu-link">
        <i class="menu-icon tf-icons bx bx-envelope-open"></i>
        <div class="text-truncate" data-i18n="Layouts">Contact Messages</div>
      </a>
    </li>

    <li class="menu-item {{ request()->is('admin*') ? 'active' : '' }}">
      <a href="{{ route('admin.newsletter.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-notification"></i>
        <div class="text-truncate" data-i18n="Layouts">Newsletter Subscribers</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Report</span></li>
    <li class="menu-item {{ request()->is('reports') ? 'active' : '' }}">
      <a href="/reports" class="menu-link">
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