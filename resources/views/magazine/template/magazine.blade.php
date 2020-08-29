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

<div class="container">
    <div class="h-600x h-sm-auto">
        <div class="h-2-3 h-sm-auto oflow-hidden">
            @if (isset($featuredNews[0]))
                <div class="pb-5 pr-5 pr-sm-0 float-left float-sm-none w-2-3 w-sm-100 h-100 h-sm-300x">
                    <a class="pos-relative h-100 dplay-block" href="{{ route('magazine.show', ['id' => $featuredNews[0]->id, 'title' => Illuminate\Support\Str::slug($featuredNews[0]->title)]) }}">
                        <img class="image-size" src="{{ asset('/images/news/large') . '/' . $featuredNews[0]->image_link }}"
                            alt="">
                        <div class="img-bg bg-1 bg-grad-layer-6"></div>
                        <div class="abs-blr color-white p-20 bg-sm-color-7">
                            <h3 class="mb-15 mb-sm-5 font-sm-13"><b>{{ $featuredNews[0]->title }}</b></h3>
                            <ul class="list-li-mr-20">
                                <li>by <span class="color-primary"><b>{{ $featuredNews[0]->author }}</b></span> Jan 25, 2018
                                </li>
                            </ul>
                        </div>
                    </a>
                </div>
            @endif
            <div class="float-left float-sm-none w-1-3 w-sm-100 h-100 h-sm-600x">
                @if (isset($featuredNews[1]))
                    <div class="pl-5 pb-5 pl-sm-0 ptb-sm-5 pos-relative h-50">
                        <a class="pos-relative h-100 dplay-block" href="#">
                            <img class="image-size"
                                src="{{ asset('/images/news/large') . '/' . $featuredNews[1]->image_link }}" alt="">

                            <div class="img-bg bg-2 bg-grad-layer-6"></div>

                            <div class="abs-blr color-white p-20 bg-sm-color-7">
                                <h4 class="mb-10 mb-sm-5"><b>{{ $featuredNews[1]->title }}</b></h4>
                                <ul class="list-li-mr-20">
                                    <li>Jan 25, 2018</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                @endif
                @if (isset($featuredNews[2]))
                    <div class="pl-5 ptb-5 pl-sm-0 pos-relative h-50">
                        <a class="pos-relative h-100 dplay-block" href="#">
                            <img class="image-size"
                                src="{{ asset('/images/news/large') . '/' . $featuredNews[2]->image_link }}" alt="">

                            <div class="img-bg bg-3 bg-grad-layer-6"></div>

                            <div class="abs-blr color-white p-20 bg-sm-color-7">
                                <h4 class="mb-10 mb-sm-5"><b>{{$featuredNews[2]->title }}</b></h4>
                                <ul class="list-li-mr-20">
                                    <li>Jan 25, 2018</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="h-1-3 oflow-hidden">
            @if (isset($featuredNews[3]))
                <div class="pr-5 pr-sm-0 pt-5 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-300x">
                    <a class="pos-relative h-100 dplay-block" href="#">
                        <img class="image-size" src="{{ asset('/images/news/large') . '/' . $featuredNews[3]->image_link }}"
                            alt="">
                        <div class="img-bg bg-4 bg-grad-layer-6"></div>
                        <div class="abs-blr color-white p-20 bg-sm-color-7">
                            <h4 class="mb-10 mb-sm-5"><b>{{ $featuredNews[3]->title }}</b></h4>
                            <ul class="list-li-mr-20">
                                <li>Jan 25, 2018</li>
                            </ul>
                        </div>
                    </a>
                </div>
            @endif

            @if (isset($featuredNews[4]))
                <div class="plr-5 plr-sm-0 pt-5 pt-sm-10 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-300x">
                    <a class="pos-relative h-100 dplay-block" href="#">
                        <img class="image-size" src="{{ asset('/images/news/large') . '/' . $featuredNews[4]->image_link }}"
                            alt="">
                        <div class="img-bg bg-5 bg-grad-layer-6"></div>
                        <div class="abs-blr color-white p-20 bg-sm-color-7">
                            <h4 class="mb-10 mb-sm-5"><b>{{ $featuredNews[4]->title }}</b></h4>
                            <ul class="list-li-mr-20">
                                <li>Jan 25, 2018</li>
                            </ul>
                        </div>
                    </a>
                </div>
            @endif

            @if (isset($featuredNews[5]))
            <div class="pl-5 pl-sm-0 pt-5 pt-sm-10 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-300x">
                <a class="pos-relative h-100 dplay-block" href="#">
                    <img class="image-size" src="{{ asset('/images/news/large') . '/' . $featuredNews[5]->image_link }}"
                         alt="">
                    <div class="img-bg bg-6 bg-grad-layer-6"></div>
                    <div class="abs-blr color-white p-20 bg-sm-color-7">
                        <h4 class="mb-10 mb-sm-5"><b>{{ $featuredNews[5]->title }}</b></h4>
                        <ul class="list-li-mr-20">
                            <li>Jan 25, 2018</li>
                            <li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>30,190</li>
                            <li><i class="color-primary mr-5 font-12 ion-chatbubbles"></i>30</li>
                        </ul>
                    </div>
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <h4 class="p-title"><b>RECENT NEWS</b></h4>
                <div class="row">
                    <div class="col-sm-6 mb-4">
                        @if (isset($recentNews[0]))                            
                            <img src="{{ asset('/images/news/large') . '/' . $recentNews[0]->image_link }}" alt="">
                            <h4 class="pt-20"><a href="#"><b>{{ $recentNews[0]->title }}</b></a></h4>
                            <ul class="list-li-mr-20 pt-10 pb-20">
                                <li class="color-lite-black">by
                                    <a href="#" class="color-black"><b>{{ $recentNews[0]->author }}, </b></a>
                                    Jan 25, 2018
                                </li>
                            </ul>
                            <p>{{ $recentNews[0]->subtitle }}</p>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        @for($i = 1; $i <= 4; $i++)
                            <a class="oflow-hidden pos-relative mb-20 dplay-block" href="#">
                                <div class="wh-100x abs-tlr"><img
                                            src="{{ asset('/images/news/large') . '/' . $recentNews[$i]->image_link }}"
                                            alt=""></div>
                                <div class="ml-120 min-h-100x">
                                    <h5><b>{{ $recentNews[$i]->title }}</b></h5>
                                    <h6 class="color-lite-black pt-10">by <span
                                                class="color-black"><b>{{ $recentNews[$i]->author }},</b></span> Jan 25,
                                        2018</h6>
                                </div>
                            </a>
                        @endfor
                    </div>
                </div>

                <h4 class="p-title mt-30"><b>Featured Categories</b></h4>
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @if (isset($featuredNewsCategories['category_1'][0]))                            
                                <li class="nav-item">
                                    <a class="nav-link active font-13" id="home-tab" data-toggle="tab" href="#home"
                                    role="tab" aria-controls="home"
                                    aria-selected="true">{{ $featuredNewsCategories['category_1'][0]->name }}</a>
                                </li>
                            @endif
                            @if (isset($featuredNewsCategories['category_2'][0]))    
                                <li class="nav-item">
                                    <a class="nav-link font-13" id="profile-tab" data-toggle="tab" href="#profile"
                                    role="tab" aria-controls="profile"
                                    aria-selected="false">{{ $featuredNewsCategories['category_2'][0]->name }}</a>
                                </li>
                            @endif
                            @if (isset($featuredNewsCategories['category_3'][0]))    
                                <li class="nav-item">
                                    <a class="nav-link font-13" id="contact-tab" data-toggle="tab" href="#contact"
                                    role="tab" aria-controls="contact"
                                    aria-selected="false">{{ $featuredNewsCategories['category_3'][0]->name }}</a>
                                </li>
                            @endif
                            @if (isset($featuredNewsCategories['category_4'][0]))    
                                <li class="nav-item">
                                    <a class="nav-link font-13" id="contact-tab" data-toggle="tab" href="#contact"
                                    role="tab" aria-controls="contact"
                                    aria-selected="false">{{ $featuredNewsCategories['category_4'][0]->name }}</a>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content mt-4" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="col-sm-12">
                                    <div class="row">
                                        @foreach($featuredNewsCategories['category_1'] as $category_1)
                                            <div class="col-sm-6">
                                                <img src="{{ asset('/images/news/large') . '/' . $category_1->image_link }}"
                                                     alt="">
                                                <h4 class="pt-20"><a href="#"><b>{{ $category_1->title }}</b></a></h4>
                                                <ul class="list-li-mr-20 pt-10 mb-30">
                                                    <li class="color-lite-black">by <a href="#" class="color-black">
                                                            <b>{{ $category_1->author }}</b></a>
                                                        Jan 25, 2018
                                                    </li>
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                     aria-labelledby="home-tab">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            @foreach($featuredNewsCategories['category_2'] as $category_2)
                                                <div class="col-sm-6">
                                                    <img src="{{ asset('/images/news/large') . '/' . $category_2->image_link }}"
                                                         alt="">
                                                    <h4 class="pt-20"><a href="#"><b>{{ $category_2->title }}</b></a>
                                                    </h4>
                                                    <ul class="list-li-mr-20 pt-10 mb-30">
                                                        <li class="color-lite-black">by <a href="#" class="color-black">
                                                                <b>{{ $category_2->author }}</b></a>
                                                            Jan 25, 2018
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                     aria-labelledby="home-tab">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            @foreach($featuredNewsCategories['category_3'] as $category_3)
                                                <div class="col-sm-6">
                                                    <img src="{{ asset('/images/news/large') . '/' . $category_3->image_link }}"
                                                         alt="">
                                                    <h4 class="pt-20"><a href="#"><b>{{ $category_3->title }}</b></a>
                                                    </h4>
                                                    <ul class="list-li-mr-20 pt-10 mb-30">
                                                        <li class="color-lite-black">by <a href="#" class="color-black">
                                                                <b>{{ $category_3->author }}</b></a>
                                                            Jan 25, 2018
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                     aria-labelledby="home-tab">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            @foreach($featuredNewsCategories['category_4'] as $category_4)
                                                <div class="col-sm-6">
                                                    <img src="{{ asset('/images/news/large') . '/' . $category_4->image_link }}"
                                                         alt="">
                                                    <h4 class="pt-20"><a href="#"><b>{{ $category_4->title }}</b></a>
                                                    </h4>
                                                    <ul class="list-li-mr-20 pt-10 mb-30">
                                                        <li class="color-lite-black">by <a href="#" class="color-black">
                                                                <b>{{ $category_4->author }}</b></a>
                                                            Jan 25, 2018
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-none d-md-block d-lg-none col-md-3"></div>
            <div class="col-md-6 col-lg-4">
                <div class="pl-20 pl-md-0">
                    <h4 class="p-title"><b>POPULAR POSTS</b></h4>
                    <a class="oflow-hidden pos-relative mb-20 dplay-block" href="#">
                        <div class="wh-100x abs-tlr"><img src="images/polular-1-100x100.jpg" alt=""></div>
                        <div class="ml-120 min-h-100x">
                            <h5><b>Bitcoin Billionares Hidding in Plain Sight</b></h5>
                            <h6 class="color-lite-black pt-10">by <span
                                        class="color-black"><b>Danile Palmer,</b></span> Jan 25, 2018</h6>
                        </div>
                    </a>
                    <a class="oflow-hidden pos-relative mb-20 dplay-block" href="#">
                        <div class="wh-100x abs-tlr"><img src="images/polular-2-100x100.jpg" alt=""></div>
                        <div class="ml-120 min-h-100x">
                            <h5><b>Bitcoin Billionares Hidding in Plain Sight</b></h5>
                            <h6 class="color-lite-black pt-10">by <span
                                        class="color-black"><b>Danile Palmer,</b></span> Jan 25, 2018</h6>
                        </div>
                    </a>
                    <a class="oflow-hidden pos-relative mb-20 dplay-block" href="#">
                        <div class="wh-100x abs-tlr"><img src="images/polular-3-100x100.jpg" alt=""></div>
                        <div class="ml-120 min-h-100x">
                            <h5><b>Bitcoin Billionares Hidding in Plain Sight</b></h5>
                            <h6 class="color-lite-black pt-10">by <span
                                        class="color-black"><b>Danile Palmer,</b></span> Jan 25, 2018</h6>
                        </div>
                    </a>
                    <a class="oflow-hidden pos-relative mb-20 dplay-block" href="#">
                        <div class="wh-100x abs-tlr"><img src="images/polular-4-100x100.jpg" alt=""></div>
                        <div class="ml-120 min-h-100x">
                            <h5><b>Bitcoin Billionares Hidding in Plain Sight</b></h5>
                            <h6 class="color-lite-black pt-10">by <span
                                        class="color-black"><b>Danile Palmer,</b></span> Jan 25, 2018</h6>
                        </div>
                    </a>
                    @foreach($advertising as $adv)
                        <div class="mtb-50 pos-relative">
                            <a href="{{ $adv->destination_link }}" style="display: inline;" target="_blank">
                                <img src="{{ asset('/images/announcements') . '/' . $adv->image_link }}" alt=""/>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
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