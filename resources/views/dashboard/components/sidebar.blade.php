 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">DSS</span>
    </a> --}}

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        {{-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> --}}
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('dashboard.') }}" class="nav-link">
              {{-- <i class="nav-icon fas fa-th"></i> --}}
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Category
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('dashboard.category.index') }}" class="nav-link">
                  <i class="fas fa-eye nav-icon"></i>
                  <p>View all</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('dashboard.category.create') }}" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Add category</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- navigation for alternative --}}

          
          @if (Route::current()->getName() == 'dashboard.process.')
          {{-- @dd($categories_id) --}}
            <li class="nav-item">
              <a href="/dashboard/process/category/data/{{ $categories_id }}" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Data
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/dashboard/process/category/{{ $categories_id }}/alternative" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Alternative
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/dashboard/process/category/{{ $categories_id }}/criteria" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  Criteria
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/dashboard/process/category/{{ $categories_id }}/value" class="nav-link">
                <i class="fas fa-plus nav-icon"></i>
                <p>
                  Input value
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/dashboard/process/category/data/{{ $categories_id }}/result" class="nav-link">
                <i class="nav-icon fas fa-poll-h"></i>
                <p>
                  Result
                </p>
              </a>
            </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
