<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/pertanyaan" class="brand-link">
        <img src="{{ asset('img/4.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">StackOverflow KW</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">

                @guest
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
                @endguest

                @auth

                @if (asset(Auth::user()->profile->photo))
                <img src="{{ asset(Auth::user()->profile->photo) }}" class="img-circle elevation-2" alt="User Image">

                @else
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                alt="User Image">
                @endif

                @endauth

            </div>
            <div class="info">

                @auth
                <a href="#" class="d-block">{{ Auth::user()->profile->full_name }}</a>
                @endauth
                @guest
                <a href="#" class="d-block">Guest</a>
                @endguest

            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/pertanyaan" class="nav-link {{ (request()->segment(1) == 'pertanyaan') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-home"></i>
                      <p>
                        Home
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-tag"></i>
                      <p>
                        Tags
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-users"></i>
                      <p>
                        Users
                      </p>
                    </a>
                  </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
