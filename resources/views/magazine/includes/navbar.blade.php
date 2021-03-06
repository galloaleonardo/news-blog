<header class="shadow mb-4" style="background-color: #F8F9FC">
    <div class="container">
        <a class="logo" href="{{ route('magazine.index') }}">
            @if(App\Helpers\Helper::useLogoByDefault())
                <img src="{{ asset('/images/logo/logo.png') }}" alt="Logo">
            @else
                <div class="h5 mx-3">{{ App\Helpers\Helper::getCompanyName() }} <strong><i
                            class="fas fa-feather-alt"></i></strong></div>
            @endif
        </a>
        <a class="right-area src-btn" href="#">
            <i class="active src-icn ion-search"></i>
            <i class="close-icn ion-close"></i>
        </a>
        <div class="src-form">
            <form>
                <input type="text" placeholder="Search here">
                <button type="submit"><i class="ion-search"></i></button>
            </form>
        </div>

        <a class="menu-nav-icon" data-menu="#main-menu" href="#"><i class="ion-navicon"></i></a>

        <ul class="main-menu" id="main-menu">
            <li>
                <a href="{{ route('magazine.index') }}">
                    {{ strtoupper(trans('magazine.home')) }}
                </a>
            </li>
            <li class="drop-down">
                <a href="#">
                    {{ strtoupper(trans('magazine.categories')) }}
                    <i class="ion-arrow-down-b"></i>
                </a>
                <ul class="drop-down-menu drop-down-inner">
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('magazine.all', ['category' => $category->name]) }}">{{ strtoupper($category->name) }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="{{ route('magazine.all') }}">
                    {{ strtoupper(trans('magazine.all_news')) }}
                </a>
            </li>
            <li>
                <form method="GET" action="{{ route('magazine.all') }}">
                    <div class="input-group mb-3 ml-4">
                        <input type="text" name="search" class="form-control form-control-sm"
                               placeholder="{{ trans('magazine.search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-secondary btn-sm">
                                {{ trans('magazine.go') }}
                            </button>
                        </div>
                    </div>
                </form>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</header>
