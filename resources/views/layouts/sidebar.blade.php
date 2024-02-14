<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon">
          <!-- Ваш логотип у форматі зображення -->
          <img src="{{ asset('admin_assets/img/logom.jpg') }}" alt="Логотип" style="max-width: 100%; height: auto;">
      </div>
      
  </a>
  
    
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="fas fa-fw fa-home"></i>
          <span>Дашборд</span>
      </a>
  </li>
  
  <li class="nav-item">
      <a class="nav-link" href="{{ route('products') }}">
          <i class="fas fa-fw fa-users"></i>
          <span>Клієнти</span>
      </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('project') }}">
        <i class="fas fa-fw fa-folder"></i>
        <span>Проекти</span>
    </a>
</li>
  
  <li class="nav-item">
      <a class="nav-link" href="/profile">
          <i class="fas fa-fw fa-user"></i>
          <span>Профіль</span>
      </a>
  </li>
  
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    
    
  </ul>