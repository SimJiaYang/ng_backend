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
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Include Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #fbfbfb;
        }

        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0;
            /* Height of navbar */
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
            width: 240px;
            z-index: 600;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }

        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto;
            /* Scrollable contents if viewport is shorter than content. */
        }
    </style>


<body>
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a href="#" class="list-group-item list-group-item-action ripple py-2" aria-current="true">
                        <img src="{{ url('/icon/home-icon.png') }}" alt="" width="20" height="20"
                            class="d-inline-block align-text-top mx-2">
                        <span class="mt-3">Dashboard</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action ripple py-2">
                        <img src="{{ url('/icon/find-job-icon.png') }}" alt="" width="20" height="20"
                            class="d-inline-block align-text-top mx-2">
                        <span class="mt-3">Customer</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action ripple py-2">
                        <img src="{{ url('/icon/flower-plant-icon.png') }}" alt="" width="20" height="20"
                            class="d-inline-block align-text-top mx-2">
                        <span class="mt-3">Plant</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action ripple py-2">
                        <img src="{{ url('/icon/box-package-icon.png') }}" alt="" width="20" height="20"
                            class="d-inline-block align-text-top mx-2">
                        <span class="mt-3">Product</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action ripple py-2">
                        <img src="{{ url('/icon/list-round-bullet-icon.png') }}" alt="" width="20"
                            height="20" class="d-inline-block align-text-top mx-2">
                        <span class="mt-3">Categories</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action ripple py-2">
                        <img src="{{ url('/icon/text-document-check-icon.png') }}" alt="" width="20"
                            height="20" class="d-inline-block align-text-top mx-2">
                        <span class="mt-3">Orders</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action ripple py-2">
                        <img src="{{ url('/icon/penalty-icon.png') }}" alt="" width="20" height="20"
                            class="d-inline-block align-text-top mx-2">
                        <span class="mt-3">Biddings</span>
                    </a>

                </div>
            </div>
        </nav>
        <!-- Sidebar -->

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Brand -->
                <a class="navbar-brand" href="#">
                    <img src="{{ url('/image/NurseryGarden.png') }}" height="25" alt="" />
                </a>

                <!-- Right links -->
                <ul class="navbar-nav
                            ms-auto d-flex flex-row">
                    <!-- Notification dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#"
                            id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ url('/icon/bell-icon.png') }}" alt="" width="20" height="20"
                                class="d-inline-block align-text-top mx-2">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="#">Some news</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Another news</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Icon -->
                    <li class="nav-item">
                        <a class="nav-link me-3 me-lg-0" href="#">
                            <i class="fas fa-fill-drip"></i>
                        </a>
                    </li>

                    <!-- Avatar -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                            id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ Auth::user()->name }}
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp"
                                class="rounded-circle px-1" height="22" alt="Avatar" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </li>
                            {{-- <li>
                                <a class="dropdown-item" href="#">Settings</a>
                            </li> --}}

                        </ul>
                    </li>
                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px">
        <div class="container pt-4">
            @yield('content')
        </div>
    </main>
    </div>
</body>

</html>
