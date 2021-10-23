<div class="offcanvas offcanvas-start bg-dark" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
  <div class="offcanvas-header">
    <div class="d-flex align-middle mx-auto">
      <i class="fas fa-tools fs-1 me-3"></i>
      <h5 class="offcanvas-title d-inline-block" id="sidebarLabel">
        Admin Panel
      </h5>
    </div>
    <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">
      <i class="fas fa-times"></i>
    </button>
  </div>
  <div class="divider ms-3 mb-0"></div>
  <div class="offcanvas-body pt-0 pb-5">
    <a class="section-item ms-0 pt-3" href="/">
      <i class="fas fa-home me-2"></i>
      Home
    </a>
    
    <div class="divider w-100"></div>
    <p class="section-title">Core</p>
    <a class="section-item {{ request()->is('admin') ? 'active' : '' }}" href="/admin">
      <i class="fas fa-tachometer-alt me-2"></i>
      Dashboard
    </a>
    <a class="section-item {{ request()->is('admin/core/message') ? 'active' : '' }}" href="/admin/core/message">
      <i class="fas fa-envelope me-2"></i>
      Message
    </a>

    <div class="divider w-100"></div>
    <p class="section-title">Photo</p>
    <a class="section-item {{ request()->is('admin/photo/carousel') ? 'active' : '' }}" href="/admin/photo/carousel">
      <i class="fas fa-images me-2"></i>
      Carousel
    </a>
    <a class="section-item {{ request()->is('admin/photo/portfolio') ? 'active' : '' }}" href="/admin/photo/portfolio">
      <i class="fas fa-image me-2"></i>
      Portfolio
    </a>

    <div class="divider w-100"></div>
    <p class="section-title">Interface</p>
    <a class="section-item {{ request()->is('admin/interface/about') ? 'active' : '' }}" href="/admin/interface/about">
      <i class="fas fa-id-card me-2"></i>
      About me
    </a>
    <a class="section-item {{ request()->is('admin/interface/contact') ? 'active' : '' }}" href="/admin/interface/contact">
      <i class="fas fa-address-book me-2"></i>
      My contact
    </a>

    <div class="divider w-100"></div>
    <p class="section-title">Account</p>
    <a class="section-item {{ request()->is('admin/account/change-username') ? 'active' : '' }}" href="/admin/account/change-username">
      <i class="fas fa-user me-2"></i>
      Change username
    </a>
    <a class="section-item {{ request()->is('admin/account/change-password') ? 'active' : '' }}" href="/admin/account/change-password">
      <i class="fas fa-key me-2"></i>
      Change password
    </a>
  </div>
</div>