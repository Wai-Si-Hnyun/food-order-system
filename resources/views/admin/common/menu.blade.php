<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="index.html" class="app-brand-link">
        <span class="app-brand-text fs-4 menu-text fw-bolder">Food Order System</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item" id="dashboard">
        <a href="index.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Pages</span>
      </li>
      <li class="menu-item" id="categories">
        <a href="{{ route('categories#index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div>Categories</div>
        </a>
      </li>
      <li class="menu-item" id="products">
        <a href="{{ route('products#index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div>Products</div>
        </a>
      </li>
      <li class="menu-item" id="orders">
        <a href="{{ route('orders#index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div>Orders</div>
        </a>
      </li>
      <li class="menu-item" id="reviews">
        <a href="#" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div>Reviews</div>
        </a>
      </li>
      <li class="menu-item" id="users">
        <a href="#" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div>Users</div>
        </a>
      </li>
    </ul>
  </aside>
  <!-- / Menu -->