<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Styles -->
    <style>
        .sidebar {
            background-color: #def9ec;
            /* Green color */
            color: white;
            /* Text color */
            z-index: 1000;
        }

        .sidebar.controller {
            position: fixed;
        }

        /* Adjust the positioning on smaller screens */
        @media (max-width: 576px) {
            .sidebar {
                top: auto;
                bottom: 0;
            }

            .sidebar.controller {
                position: relative;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="row">
            @guest
            @else
                <!-- Sidebar -->
                <div class="col-md-3 col-lg-2 sidebar position-relative">
                    <div class="controller">
                        <ul class="nav flex-column">
                            <!-- App Icon -->
                            <li class="nav-item">
                                <a class="nav-link active fs-3 text-dark p-3" href="#">
                                    Nursery Garden<br> Admin Panel
                                </a>
                            </li>
                            <!-- Function Button -->
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-gear"></i> Settings
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endguest


            <!-- Main Content -->
            @guest
                <div class="col-md-11 col-lg-12 px-0">
                @else
                    <div class="col-md-9 col-lg-10 px-0">
                    @endguest

                    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm px-3">
                        <div class="container">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav me-auto">

                                </ul>

                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ms-auto">
                                    <!-- Authentication Links -->
                                    @guest
                                        @if (Route::has('login'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                        @endif

                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                                role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }}
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @endguest
                                </ul>
                            </div>
                        </div>
                    </nav>

                    <main class="py-4">
                        @yield('content')
                    </main>
                </div>

            </div>
        </div>
</body>

</html>
