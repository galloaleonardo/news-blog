<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('magazine.includes.head')
    {!! \Artesaos\SEOTools\Facades\SEOTools::generate() !!}
</head>
<body>

@include('magazine.includes.navbar')
@include('magazine.includes.carousel-advertising')

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <img src="{{ asset('/images/news/large') . '/' . $news->image_link }}" alt="">
                <h3 class="mt-30"><b>{{ $news->title }}</b></h3>
                <ul class="list-li-mr-20 mtb-15">
                    <li>{{ trans('magazine.by') }} <a href="#"><b>{{ $news->author }}</b>, </a> {{ App\Helpers\Helper::getWrittenDateLanguage($news->created_at, false) }}
                        | {{ trans('magazine.updated_in') }} {{ App\Helpers\Helper::getDateFormatLanguage($news->updated_at) }} {{ trans('magazine.at') }} {{ date_format($news->updated_at, 'H:i:s') }}</li>
                </ul>
                <div class="mt-40 mt-sm-20">
                    <ul class="mb-30 list-a-bg-grey list-a-hw-radial-35 list-a-hvr-primary list-li-ml-5">
                        <li class="mr-10 ml-0">{{trans('magazine.share')}}</li>
                        <li class="text-center align-middle"><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="text-center align-middle"><a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $news->title }}"><i class="fab fa-twitter"></i></a></li>
                        <li class="text-center align-middle"><a href="https://wa.me/?text={{ urlencode(url()->current()) }}"><i class="fab fa-whatsapp"></i></a></li>
                    </ul>
                </div>

                {!! $news->content !!}

                <div class="brdr-ash-1 opacty-5 mt-50"></div>

                <h4 class="p-title mt-50"><b>{{ trans('magazine.you_may_also_like') }}</b></h4>
                <div class="row">
                    @foreach($suggestedNews as $news)
                    <div class="col-sm-6">
                        <a href="{{ route('magazine.show', ['id' => $news->id, 'title' => Illuminate\Support\Str::slug($news->title)]) }}">
                            <img src="{{ asset('/images/news/large') . '/' . $news->image_link }}" alt="">
                            <h4 class="pt-20"><b>{{ $news->title }}</b></h4>
                            <ul class="list-li-mr-20 pt-10 mb-30">
                                <li class="color-lite-black">
                                    {{ trans('magazine.by') }} <a href="#" class="color-black"><b>&nbsp;{{ $news->author }}</b></a>
                                    {{ App\Helpers\Helper::getWrittenDateLanguage($news->created_at) }}
                                </li>
                            </ul>
                        </a>
                    </div><!-- col-sm-6 -->
                    @endforeach
                </div><!-- row -->
            </div><!-- col-md-9 -->

            <div class="d-none d-md-block d-lg-none col-md-3"></div>
            <div class="col-md-6 col-lg-4">
                    <div class="mb-50">
                        <h4 class="p-title"><b>{{ trans('magazine.popular_posts') }}</b></h4>
                        @for($i = 0; $i <= (count($popularNews) - 1) ; $i++)
                        <a class="oflow-hidden pos-relative mb-20 dplay-block" href="{{ route('magazine.show', ['id' => $popularNews[$i]->id, 'title' => Illuminate\Support\Str::slug($popularNews[$i]->title)]) }}">
                            <div class="wh-100x abs-tlr">
                                <img src="{{ asset('/images/news/large') . '/' . $popularNews[$i]->image_link }}" alt=""></div>
                            <div class="ml-120 min-h-100x">
                                <h5><b>{{ $popularNews[$i]->title }}</b></h5>
                                <h6 class="color-lite-black pt-10">{{ trans('magazine.by') }} <span
                                            class="color-black"><b>{{ $popularNews[$i]->author }}</b></span> {{ App\Helpers\Helper::getWrittenDateLanguage($popularNews[$i]->created_at) }}</h6>
                            </div>
                        </a>
                        @endfor
                    </div><!-- mtb-50 -->

                </div><!--  pl-20 -->
            </div><!-- col-md-3 -->

        </div><!-- row -->

    </div><!-- container -->
</section>

@include('magazine.includes.footer')
@include('magazine.includes.scripts')
</body>
</html>
