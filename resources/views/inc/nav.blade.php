 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span>Polgon Illusion</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="{{ Request::routeIs('/.index') ? 'nav-link scrollto active' : '' }}" href="{{ route('/.index') }}">
            Home</a></li>
            <li><a class="nav-link scrollto" href="#team">Team</a></li>
          @auth
          <li><a class="{{ Request::routeIs('dashboard') ? 'nav-link scrollto' : '' }}" href="{{route('dashboard')}}">Dashboard</a></li>
          <li><a class="{{ Request::routeIs('blog.create') ? 'nav-link scrollto' : '' }}" href="{{route('blog.create')}}">Create Post</a></li>

          <li><a class="{{ Request::routeIs('category.create')? 'nav-link scrollto' : '' }}" href="{{ route('category.create') }}">Create Category</a></li>
          <li><a class="{{ Request::routeIs('category.index')? 'nav-link scrollto' : '' }}" href="{{ route('category.index') }}">Category List</a></li>
          @endauth
          <li><a class=" {{ Request::routeIs('blog.index') ? 'nav-link scrollto active' : '' }}" href="{{ route('blog.index') }}">Blog</a></li>

          @guest
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>

          {{-- <li><a class="getstarted scrollto" href="#about">Get Started</a></li> --}}
          @if (Session::has('loginID'))



          <li class="dropdown"><a href="#"><span> Action</span> <i class="bi bi-chevron-down"></i></a>

            <ul>
                <li><a href="{{ route('registeredUser.dashboard') }}">Profile</a></li>
              <li><a href="{{ route('registeredUserblog.logout') }}">Logout</a></li>

            </ul>
          </li>

          @else
          <li class="dropdown"><a href="#"><span>Join Us</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{ route('registeredUserlogin') }}">Login</a></li>
              <li><a href="{{ route('registeredUser.register') }}">Register</a></li>
            </ul>
          </li>
          @endif


          @endguest
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
