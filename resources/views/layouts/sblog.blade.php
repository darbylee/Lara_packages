<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Dusan\'s Simple Blog'))</title>
    <!-- Styles -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css" rel="stylesheet">
    <link href="{{ asset('vendor/sblog/css/sblog.css') }}" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Customize Styles -->
    @yield('page_css')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  </head>

  <body>
  <section class="hero is-primary">
    <!-- Hero head: will stick at the top -->
    <div class="hero-head">
      <nav class="navbar">
        <div class="container">
          <div class="navbar-start">
            <div class="navbar-item">
              <a class="button is-primary" href="{{ route(config('sblog.route_name_prefix') . '.post.index') }}"><strong>Posts</strong></a>
            </div>
            @auth
              <div class="navbar-item">
                <a class="button is-primary" href="{{ route(config('sblog.route_name_prefix') . '.post.create') }}"><strong>Create New Post</strong></a>
              </div>
            @endauth
          </div>

          <div class="navbar-end">
            <div class="navbar-item">
              <div class="buttons">
                @guest
                  @if (Route::has('register'))
                    <a class="button is-primary"  href="{{ route('register') }}"><strong>Sign up</strong></a>
                  @endif
                  <a class="button is-light"  href="{{ route('login') }}">Log in</a>
                @else
                  <div class="button is-primary">
                    <span class="icon is-large">
                      <span class="fa-stack fa-md">
                        <i class="fa fa-user"></i>
                      </span>
                    </span>
                    <p>{{ Auth::user()->name }}</p>
                  </div>

                  <a class="button is-light" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                @endguest
              </div>
            </div>
          </div>
        </div>
      </nav>
    </div>

    <!-- Hero content: will be in the middle -->
    <div class="hero-body">
      <div class="container has-text-centered">
        <h1 class="title">{{ $title }}</h1>
      </div>
    </div>
  </section>
  @yield('content')
</body>

<!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="{{ asset('vendor/sblog/js/sblog.js') }}"></script>
<!-- Customize Scripts -->
@yield('page_js')
</html>
