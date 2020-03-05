<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>News Blog</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">

    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:400,600,700" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/styles-news-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('/fontawesome/css/all.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<header class="shadow mb-4" style="background-color: #F8F9FC">
    <div class="container">
        <a class="logo" href="/">
            <div class="h5 mx-3">News Blog <strong><i class="fab fa-neos"></i></strong></div>
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
            <li><a href="02_archive-page.html">NEWS</a></li>
            <li class="drop-down"><a href="03_single-post.html">CATEGORIES<i class="ion-arrow-down-b"></i></a>
                <ul class="drop-down-menu drop-down-inner">
                    <li><a href="#">CATEGORY 1</a></li>
                    <li><a href="#">CATEGORY 2</a></li>
                </ul>
            </li>
            <li><a href="06_contact-us.html">ALL NEWS</a></li>
            <li><a href="06_contact-us.html">CONTACT US</a></li>
            <li>
                <div class="input-group mb-3 ml-4">
                    <input type="text" class="form-control form-control-sm" placeholder="Search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn-sm">
                            Go
                        </button>
                    </div>
                </div>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</header>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <img src="{{ asset('/images/news/large') . '/' . $news->image_link }}" alt="">
                <h3 class="mt-30"><b>{{ $news->title }}</b></h3>
                <ul class="list-li-mr-20 mtb-15">
                    <li>by <a href="#"><b>{{ $news->author }}</b>, </a> {{ date_format($news->created_at, 'j F Y') }}
                        | updated in {{ date_format($news->updated_at, 'd/m/Y') }} at {{ date_format($news->updated_at, 'H:i:s') }}</li>
                </ul>
                <div class="mt-40 mt-sm-20">
                    <ul class="mb-30 list-a-bg-grey list-a-hw-radial-35 list-a-hvr-primary list-li-ml-5">
                        <li class="mr-10 ml-0">Share</li>
                        <li class="text-center align-middle"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="text-center align-middle"><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li class="text-center align-middle"><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                    </ul>
                </div>

                {!! $news->content !!}

                <div class="brdr-ash-1 opacty-5 mt-50"></div>

                <h4 class="p-title mt-50"><b>YOU MAY ALSO LIKE</b></h4>
                <div class="row">

                    <div class="col-sm-6">
                        <img src="images/crypto-news-2-600x450.jpg" alt="">
                        <h4 class="pt-20"><a href="#"><b>2017 Market Performance: <br>Crypto vs.Stock</b></a></h4>
                        <ul class="list-li-mr-20 pt-10 mb-30">
                            <li class="color-lite-black">by <a href="#" class="color-black"><b>Olivia Capzallo,</b></a>
                                Jan 25, 2018</li>
                            <li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>30,190</li>
                            <li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>47</li>
                        </ul>
                    </div><!-- col-sm-6 -->

                    <div class="col-sm-6">
                        <img src="images/crypto-news-1-600x450.jpg" alt="">
                        <h4 class="pt-20"><a href="#"><b>2017 Market Performance: Crypto vs.Stock</b></a></h4>
                        <ul class="list-li-mr-20 pt-10 mb-30">
                            <li class="color-lite-black">by <a href="#" class="color-black"><b>Olivia Capzallo,</b></a>
                                Jan 25, 2018</li>
                            <li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>30,190</li>
                            <li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>47</li>
                        </ul>
                    </div><!-- col-sm-6 -->

                </div><!-- row -->
            </div><!-- col-md-9 -->

            <div class="d-none d-md-block d-lg-none col-md-3"></div>
            <div class="col-md-6 col-lg-4">
                    <div class="mb-50">
                        <h4 class="p-title"><b>POPULAR POSTS</b></h4>
                        <a class="oflow-hidden pos-relative mb-20 dplay-block" href="#">
                            <div class="wh-100x abs-tlr"><img src="images/polular-1-100x100.jpg" alt=""></div>
                            <div class="ml-120 min-h-100x">
                                <h5><b>Bitcoin Billionares Hidding in Plain Sight</b></h5>
                                <h6 class="color-lite-black pt-10">by <span class="color-black"><b>Danile Palmer,</b></span> Jan 25, 2018</h6>
                            </div>
                        </a><!-- oflow-hidden -->

                        <a class="oflow-hidden pos-relative mb-20 dplay-block" href="#">
                            <div class="wh-100x abs-tlr"><img src="images/polular-2-100x100.jpg" alt=""></div>
                            <div class="ml-120 min-h-100x">
                                <h5><b>Bitcoin Billionares Hidding in Plain Sight</b></h5>
                                <h6 class="color-lite-black pt-10">by <span class="color-black"><b>Danile Palmer,</b></span> Jan 25, 2018</h6>
                            </div>
                        </a><!-- oflow-hidden -->

                        <a class="oflow-hidden pos-relative mb-20 dplay-block" href="#">
                            <div class="wh-100x abs-tlr"><img src="images/polular-3-100x100.jpg" alt=""></div>
                            <div class="ml-120 min-h-100x">
                                <h5><b>Bitcoin Billionares Hidding in Plain Sight</b></h5>
                                <h6 class="color-lite-black pt-10">by <span class="color-black"><b>Danile Palmer,</b></span> Jan 25, 2018</h6>
                            </div>
                        </a><!-- oflow-hidden -->

                        <a class="oflow-hidden pos-relative mb-20 dplay-block" href="#">
                            <div class="wh-100x abs-tlr"><img src="images/polular-4-100x100.jpg" alt=""></div>
                            <div class="ml-120 min-h-100x">
                                <h5><b>Bitcoin Billionares Hidding in Plain Sight</b></h5>
                                <h6 class="color-lite-black pt-10">by <span class="color-black"><b>Danile Palmer,</b></span> Jan 25, 2018</h6>
                            </div>
                        </a><!-- oflow-hidden -->

                    </div><!-- mtb-50 -->

                    <div class="mtb-50 pos-relative">
                        <img src="images/banner-1-600x450.jpg" alt="">
                        <div class="abs-tblr bg-layer-7 text-center color-white">
                            <div class="dplay-tbl">
                                <div class="dplay-tbl-cell">
                                    <h4><b>Available for mobile &amp; desktop</b></h4>
                                    <a class="mt-15 color-primary link-brdr-btm-primary" href="#"><b>Download for free</b></a>
                                </div><!-- dplay-tbl-cell -->
                            </div><!-- dplay-tbl -->
                        </div><!-- abs-tblr -->
                    </div><!-- mtb-50 -->

                    <div class="mtb-50 mb-md-0">
                        <h4 class="p-title"><b>NEWSLETTER</b></h4>
                        <p class="mb-20">Subscribe to our newsletter to get notification about new updates,
                            information, discount, etc..</p>
                        <form class="nwsltr-primary-1">
                            <input type="text" placeholder="Your email">
                            <button type="submit"><i class="ion-ios-paperplane"></i></button>
                        </form>
                    </div><!-- mtb-50 -->

                </div><!--  pl-20 -->
            </div><!-- col-md-3 -->

        </div><!-- row -->

    </div><!-- container -->
</section>

<footer class="bg-191 color-ccc">
    <div class="container">
        <div class="pt-50 pb-20 pos-relative">
            <div class="abs-tblr pt-50 z--1 text-center">
                <div class="h-80 pos-relative"></div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="mb-30">
                        <div class="h5">News Blog <strong><i class="fab fa-neos"></i></strong></div>
                        <p class="mtb-20 color-ccc">
                            A open-source project developed in Laravel with the aim of contributing to the community,
                            delivering a magazine site ready for use.
                        </p>
                        <p class="color-ash">
                            Developed by Leonardo Gallo
                            <br>
                            This template is made with <i class="fas fa-heart" aria-hidden="true"></i>
                            by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/scripts-news-theme.js') }}"></script>
</body>
</html>