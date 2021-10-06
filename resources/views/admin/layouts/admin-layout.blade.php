<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    @if (request()->is('*news/create') || request()->is('*news/*/edit'))
        <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    @endif

    <title>@yield('title-page')</title>

    <!-- Custom fonts for this template-->
    <link href="/fontawesome/css/all.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">


    @yield('custom-style')
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="d-flex align-items-center justify-content-center py-3" target="_blank" href="{{ route('magazine.index') }}" >
            @if(App\Helpers\Helper::useLogoByDefault())
                <img src="{{ asset('/images/logo/logo.png') }}" alt="Logo">
            @else
                <div class="sidebar-brand-text mx-3" style="color: white">{{ App\Helpers\Helper::getCompanyName() }} <i class="fas fa-feather-alt"></i></div>
            @endif
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
            <a class="nav-link py-2" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>{{ trans('admin.dashboard') }}</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            {{ trans('admin.news') }}
        </div>

        @if(App\Helpers\Helper::userIsAdmin())
            <!-- Nav Item - Categories Menu -->
            <li class="nav-item {{ request()->is('*authors*') ? 'active' : '' }}">
                <a class="nav-link py-1" href="{{ route('authors.index') }}">
                    <i class="fas fa-user-edit"></i>
                    <span>{{ trans('admin.authors') }}</span>
                </a>
            </li>

            <!-- Nav Item - Categories Menu -->
            <li class="nav-item {{ request()->is('*categories*') ? 'active' : '' }}">
                <a class="nav-link py-1" href="{{ route('categories.index') }}">
                    <i class="fas fa-sitemap"></i>
                    <span>{{ trans('admin.categories') }}</span>
                </a>
            </li>
        @endif

        <!-- Nav Item - News Menu -->
        <li class="nav-item {{ request()->is('*news*') ? 'active' : '' }}">
            <a class="nav-link py-1" href="{{ route('news.index') }}">
                <i class="fas fa-newspaper"></i>
                <span>{{ trans('admin.news') }}</span>
            </a>
        </li>

        @if(App\Helpers\Helper::userIsAdmin())
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ trans('admin.adverts') }}
            </div>

            <!-- Nav Item - Advertisings Menu -->
            <li class="nav-item {{ request()->is('*advertisements*') ? 'active' : '' }}">
                <a class="nav-link py-1" href="{{ route('advertisements.index') }}">
                    <i class="fab fa-adversal"></i>
                    <span>{{ trans('admin.advertisings') }}</span>
                </a>
            </li>

            <!-- Nav Item - Top Banner Menu -->
            <li class="nav-item {{ request()->is('*top-banner*') ? 'active' : '' }}">
                <a class="nav-link py-1" href="{{ route('top-banner.index') }}">
                    <i class="fab fa-adversal"></i>
                    <span>{{ trans('admin.top_banner') }}</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ trans('admin.operational') }}
            </div>

            <!-- Nav Item - Users Menu -->
            <li class="nav-item {{ request()->is('*users*') ? 'active' : '' }}">
                <a class="nav-link py-1" href="{{ route('users.index') }}">
                    <i class="fas fa-users"></i>
                    <span>{{ trans('admin.users') }}</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ trans('admin.integrations') }}
            </div>

            <!-- Nav Item - Google Ads Menu -->
            <li class="nav-item {{ request()->is('*google-ads*') ? 'active' : '' }}">

                <a class="nav-link py-1" href="{{ route('google-ads.index') }}">
                    <i class="fab fa-google"></i>
                    <span>{{ trans('admin.google_ads') }}</span>
                </a>

            </li>

            <!-- Nav Item - Google Analytics Menu -->
            <li class="nav-item {{ request()->is('*google-analytics*') ? 'active' : '' }}">

                <a class="nav-link py-1" href="{{ route('google-analytics.index') }}">
                    <i class="fab fa-google"></i>
                    <span>{{ trans('admin.google_analytics') }}</span>
                </a>

            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ trans('admin.seo') }}
            </div>

            <!-- Nav Item - Google Ads Menu -->
            <li class="nav-item {{ request()->is('*seo*') ? 'active' : '' }}">

                <a class="nav-link py-1" href="{{ route('seo.index') }}">
                    <i class="fas fa-rocket"></i>
                    <span>{{ trans('admin.seo') }}</span>
                </a>

            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ trans('admin.settings') }}
            </div>

            <!-- Nav Item - Settings Menu -->
            <li class="nav-item {{ request()->is('*settings*') ? 'active' : '' }}">
                <a class="nav-link py-1" href="{{ route('settings.index') }}">
                    <i class="fas fa-cogs"></i>
                    <span>{{ trans('admin.settings') }}</span>
                </a>
            </li>
        @endif

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline pt-4">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>

                            @if( ! Auth::user()->avatar)
                                <i class="fas fa-user-circle"></i>
                             @else
                                <img src="/images/avatars/{{ Auth::user()->avatar }}" width="25px" alt="">
                            @endif
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ trans('admin.logout') }}
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">@yield('title-content')</h1>

                    @include('admin.flash-message')
                </div>
                @yield('content')

                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

                @if(isset($lineChart) || isset($barChart))
                    {!! $lineChart->script() !!}
                    {!! $barChart->script() !!}
                @endif
            </div>

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>{{ trans('admin.mit_license') }} - <span id="year"></span> </span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('admin.ready_to_leave') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">{{ trans('admin.logout_message') }}</div>
            <div class="modal-footer">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ trans('admin.cancel') }}</button>
                    <button class="btn btn-primary" type="submit">{{ trans('admin.logout') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("year").innerHTML = new Date().getFullYear();
</script>

<!-- Bootstrap core JavaScript-->
<script src="/js/app.js"></script>

<!-- Core plugin JavaScript-->
<script src="/js/jquery.easing.js"></script>

<!-- Custom scripts for all pages-->
<script src="/js/sb-admin-2.js"></script>

<!-- Functions scripts -->
<script src="/js/functions.js"></script>

</body>

</html>
