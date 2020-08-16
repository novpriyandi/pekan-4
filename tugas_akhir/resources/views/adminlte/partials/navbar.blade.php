<nav class="main-header navbar navbar-expand-lg navbar-light navbar-white sticky-top">
  <div class="container">
    <a href="#" class="navbar-brand">
      <img src="{{ asset('img/4.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">StackOverflow KW</span>
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('pertanyaan.index') }}" class="nav-link">Pertanyaan</a>
        </li>
    </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-0 ml-md-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
    </div>

    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <!-- Users Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          @auth
            {{ Auth::user()->name }}
            <img src="{{ asset(Auth::user()->profile->photo) }}" class="brand-image img-circle elevation-3 ml-3" alt="User Image">
          @endauth
          @guest
            <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="brand-image img-circle elevation-3" alt="User Image">
          @endguest
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <p class="dropdown-item" href="#">
            Poin Reputasi : {{ Auth::user()->profile->poin }}
          </p>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </li>
    </ul>
  </div>
</nav>
