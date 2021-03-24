<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('magazine.includes.head')
    {!! \Artesaos\SEOTools\Facades\SEOTools::generate() !!}
</head>
<style>
    .myimage{
        width: 100%;
        height: 100%;
    }
    .imgdiv{
        overflow:hidden;
        height:200px;
    }
</style>
<body>

@include('magazine.includes.navbar')

<div class="container">
    <h4 class="p-title"><b>{{trans('magazine.all_news')}}</b></h4>

    <div class="row">
        @foreach($news as $new)
            <div class="col-sm-6">
                <div class="imgdiv">
                    <a href="{{ route('magazine.show', ['id' => $new->id, 'title' => Illuminate\Support\Str::slug($new->title)]) }}">
                        <img class="myimage img-responsive" src="{{ asset('/images/news/large') . '/' . $new->image_link }}" alt="">
                    </div>
                    <h4 class="pt-20"><b>{{ $new->title }}</b></h4>
                    <ul class="list-li-mr-20 pt-10 mb-30">
                        <li class="color-lite-black">{{ trans('magazine.by') }} <b>{{ $new->author }}</b></a>
                            {{ App\Helpers\Helper::getWrittenDateLanguage($new->created_at)}}
                        </li>
                    </ul>
                </a>

            </div>
        @endforeach
    </div>
</div>


@include('magazine.includes.footer')

@include('magazine.includes.scripts')
</body>
</html>
