 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

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
            <a href="{{ route('dashboard.category.index') }}" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Category
              </p>
            </a>
          </li>
          {{-- navigation for alternative --}}

          
          @if (Str::startsWith(Route::currentRouteName(), 'dashboard.process.'))
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
          <li class="nav-item">
            <a href="{{ route('dashboard.user.index') }}" class="nav-link">
              <i class="fas fa-users nav-icon"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/logout" class="nav-link">
              <i class="fas fa-power-off nav-icon"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
