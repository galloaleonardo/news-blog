<h4 class="p-title"><b>{{ trans('magazine.popular_posts') }}</b></h4>
@for($i = 0; $i <= (count($popularNews) - 1) ; $i++)
<a class="oflow-hidden pos-relative mb-20 dplay-block" href="{{ route('magazine.show', ['id' => $popularNews[$i]->id, 'title' => Illuminate\Support\Str::slug($popularNews[$i]->title)]) }}">
    <div class="wh-100x abs-tlr">
        <img src="{{ asset('/images/news/large') . '/' . $popularNews[$i]->image_link }}" alt=""></div>
    <div class="ml-120 min-h-100x">
        <h5><b>{{ $popularNews[$i]->title }}</b></h5>
        <h6 class="color-lite-black pt-10">{{ trans('magazine.by') }} <span
                    class="color-black"><b>&nbsp;{{ $popularNews[$i]->author }}</b></span> {{ App\Helpers\Helper::getWrittenDateLanguage($popularNews[$i]->created_at) }}</h6>
    </div>
</a>
@endfor
