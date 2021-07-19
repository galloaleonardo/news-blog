<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('magazine.includes.head')
    {!! \Artesaos\SEOTools\Facades\SEOTools::generate() !!}
</head>
<body>

@include('magazine.includes.navbar')
@include('magazine.includes.carousel-advertising')
@include('magazine.homepage.includes.featured-news')

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                @include('magazine.homepage.includes.recent-news')
                @include('magazine.homepage.includes.featured-categories')
            </div>

            <div class="d-none d-md-block d-lg-none col-md-3"></div>
            <div class="col-md-6 col-lg-4">
                <div class="pl-20 pl-md-0">
                    @include('magazine.homepage.includes.popular-news')
                    @include('magazine.homepage.includes.advertising')
                </div>
            </div>
        </div>
    </div>
</section>

@include('magazine.includes.footer')

@include('magazine.includes.scripts')
</body>
</html>
