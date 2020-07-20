<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@if (trim($__env->yieldContent('template_title'))) @yield('template_title') | @endif {{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">


  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- jQuery UI -->
  <script src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script>


  <!-- fullCalendar -->
  <link rel="stylesheet" href="/assets/plugins/fullcalendar/main.min.css">
  <script src="/assets/plugins/fullcalendar/main.min.js"></script>
  <script src="/assets/plugins/jquery/jquery.min.js"></script>
  <script src="/assets/plugins/fullcalendar-daygrid/main.min.js"></script>
  <script src="/assets/plugins/fullcalendar-timegrid/main.min.js"></script>
  <script src="/assets/plugins/fullcalendar-interaction/main.min.js"></script>
  <script src="/assets/plugins/fullcalendar-bootstrap/main.min.js"></script>
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  

</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">

          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="/calendar" class="nav-link">
                <i class="nav-icon fa fa-calendar"></i>
                <p>Calendar</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/courses" class="nav-link">
                <i class="nav-icon fas fa-graduation-cap"></i>
                <p>Course</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/course-students" class="nav-link">
                <i class="nav-icon fas fa-book-reader"></i>
                <p>Course Student</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/students" class="nav-link">
                <i class="nav-icon fas fa-user-graduate"></i>
                <p>Student</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/study-types" class="nav-link">
                <i class="nav-icon fas fa-university"></i>
                <p>StudyType</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/tuition-fees" class="nav-link">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>TuitionFee</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/skills" class="nav-link">
                <i class="nav-icon fa fa-tasks"></i>
                <p>Skill</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/schedules" class="nav-link">
                <i class="nav-icon fas fa-stopwatch"></i>
                <p>Schedules</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/teachers" class="nav-link">
                <i class="nav-icon fas fa-chalkboard-teacher	"></i>
                <p>Teacher</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/schedule-status" class="nav-link">
                <i class="nav-icon fas fa-chalkboard-teacher	"></i>
                <p>Schedule Status</p>
              </a>
            </li>


          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
      <main class="py-4">
        @yield('content')
      </main>
    </div>
    @yield('script')
</body>

</html>