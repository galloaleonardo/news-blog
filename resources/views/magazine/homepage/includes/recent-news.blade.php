<h4 class="p-title"><b>{{ trans('magazine.recent_news') }}</b></h4>
<div class="row">
    <div class="col-sm-6 mb-4">
        @if (isset($recentNews[0]))
            <a href="{{ route('magazine.show', ['id' => $recentNews[0]->id, 'title' => Illuminate\Support\Str::slug($recentNews[0]->title)]) }}">
                <img src="{{ asset('/images/news/large') . '/' . $recentNews[0]->image_link }}" alt="">
            </a>
            <h4 class="pt-20"><a href="{{ route('magazine.show', ['id' => $recentNews[0]->id, 'title' => Illuminate\Support\Str::slug($recentNews[0]->title)]) }}"><b>{{ $recentNews[0]->title }}</b></a></h4>
            <ul class="list-li-mr-20 pt-10 pb-20">
                <li class="color-lite-black">{{ trans('magazine.by') }}
                    <a href="#" class="color-black"><b>{{ $recentNews[0]->author->name }}, </b></a>, 
                    {{ App\Helpers\Helper::getDateFormatLanguage($recentNews[0]->created_at)}}
                </li>
            </ul>
            <p>{{ $recentNews[0]->subtitle }}</p>
        @endif
    </div>
    <div class="col-sm-6">
        @if (isset($recentNews[0]))
            @for($i = 1; $i <= 4; $i++)
                @if (isset($recentNews[$i]))
                    <a class="oflow-hidden pos-relative mb-20 dplay-block" href="{{ route('magazine.show', ['id' => $recentNews[$i]->id, 'title' => Illuminate\Support\Str::slug($recentNews[$i]->title)]) }}">
                        <div class="wh-100x abs-tlr"><img
                                    src="{{ asset('/images/news/large') . '/' . $recentNews[$i]->image_link }}"
                                    alt=""></div>
                        <div class="ml-120 min-h-100x">
                            <h5><b>{{ $recentNews[$i]->title }}</b></h5>
                            <h6 class="color-lite-black pt-10">{{ trans('magazine.by') }} <span
                                        class="color-black"><b>{{ $recentNews[$i]->author->name }},</b></span>, 

                                {{ App\Helpers\Helper::getDateFormatLanguage($recentNews[$i]->created_at)}}
                            </h6>
                        </div>
                    </a>
                @endif
            @endfor
        @endif
    </div>
</div>
