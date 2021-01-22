<h4 class="p-title"><b>{{ trans('magazine.advertising') }}</b></h4>
@foreach($advertising as $adv)
    <div class="mtb-50 pos-relative">
        <a href="{{ $adv->destination_link }}" style="display: inline;" target="_blank">
            <img src="{{ asset('/images/announcements') . '/' . $adv->image_link }}" alt=""/>
        </a>
    </div>
@endforeach
