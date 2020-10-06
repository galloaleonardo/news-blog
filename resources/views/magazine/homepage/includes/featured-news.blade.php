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
                                <li>by <span class="color-primary"><b>{{ $featuredNews[0]->author }}</b></span> {{ App\Helpers\Helper::getDateForPost($featuredNews[0]->created_at) }}
                                </li>
                            </ul>
                        </div>
                    </a>
                </div>
            @endif
            <div class="float-left float-sm-none w-1-3 w-sm-100 h-100 h-sm-600x">
                @if (isset($featuredNews[1]))
                    <div class="pl-5 pb-5 pl-sm-0 ptb-sm-5 pos-relative h-50">
                        <a class="pos-relative h-100 dplay-block" href="{{ route('magazine.show', ['id' => $featuredNews[1]->id, 'title' => Illuminate\Support\Str::slug($featuredNews[1]->title)]) }}">
                            <img class="image-size"
                                src="{{ asset('/images/news/large') . '/' . $featuredNews[1]->image_link }}" alt="">

                            <div class="img-bg bg-2 bg-grad-layer-6"></div>

                            <div class="abs-blr color-white p-20 bg-sm-color-7">
                                <h4 class="mb-10 mb-sm-5"><b>{{ $featuredNews[1]->title }}</b></h4>
                                <ul class="list-li-mr-20">
                                    <li>{{ App\Helpers\Helper::getDateForPost($featuredNews[1]->created_at) }}</li>
                                </ul>
                            </div>
                        </a>
                    </div>
                @endif
                @if (isset($featuredNews[2]))
                    <div class="pl-5 ptb-5 pl-sm-0 pos-relative h-50">
                        <a class="pos-relative h-100 dplay-block" href="{{ route('magazine.show', ['id' => $featuredNews[2]->id, 'title' => Illuminate\Support\Str::slug($featuredNews[2]->title)]) }}">
                            <img class="image-size"
                                src="{{ asset('/images/news/large') . '/' . $featuredNews[2]->image_link }}" alt="">

                            <div class="img-bg bg-3 bg-grad-layer-6"></div>

                            <div class="abs-blr color-white p-20 bg-sm-color-7">
                                <h4 class="mb-10 mb-sm-5"><b>{{$featuredNews[2]->title }}</b></h4>
                                <ul class="list-li-mr-20">
                                    <li>{{ App\Helpers\Helper::getDateForPost($featuredNews[2]->created_at) }}</li>
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
                    <a class="pos-relative h-100 dplay-block" href="{{ route('magazine.show', ['id' => $featuredNews[3]->id, 'title' => Illuminate\Support\Str::slug($featuredNews[0]->title)]) }}">
                        <img class="image-size" src="{{ asset('/images/news/large') . '/' . $featuredNews[3]->image_link }}"
                            alt="">
                        <div class="img-bg bg-4 bg-grad-layer-6"></div>
                        <div class="abs-blr color-white p-20 bg-sm-color-7">
                            <h4 class="mb-10 mb-sm-5"><b>{{ $featuredNews[3]->title }}</b></h4>
                            <ul class="list-li-mr-20">
                                <li>{{ App\Helpers\Helper::getDateForPost($featuredNews[3]->created_at) }}</li>
                            </ul>
                        </div>
                    </a>
                </div>
            @endif

            @if (isset($featuredNews[4]))
                <div class="plr-5 plr-sm-0 pt-5 pt-sm-10 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-300x">
                    <a class="pos-relative h-100 dplay-block" href="{{ route('magazine.show', ['id' => $featuredNews[4]->id, 'title' => Illuminate\Support\Str::slug($featuredNews[4]->title)]) }}">
                        <img class="image-size" src="{{ asset('/images/news/large') . '/' . $featuredNews[4]->image_link }}"
                            alt="">
                        <div class="img-bg bg-5 bg-grad-layer-6"></div>
                        <div class="abs-blr color-white p-20 bg-sm-color-7">
                            <h4 class="mb-10 mb-sm-5"><b>{{ $featuredNews[4]->title }}</b></h4>
                            <ul class="list-li-mr-20">
                                <li>{{ App\Helpers\Helper::getDateForPost($featuredNews[4]->created_at) }}</li>
                            </ul>
                        </div>
                    </a>
                </div>
            @endif

            @if (isset($featuredNews[5]))
            <div class="pl-5 pl-sm-0 pt-5 pt-sm-10 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-300x">
                <a class="pos-relative h-100 dplay-block" href="{{ route('magazine.show', ['id' => $featuredNews[5]->id, 'title' => Illuminate\Support\Str::slug($featuredNews[5]->title)]) }}">
                    <img class="image-size" src="{{ asset('/images/news/large') . '/' . $featuredNews[5]->image_link }}"
                         alt="">
                    <div class="img-bg bg-6 bg-grad-layer-6"></div>
                    <div class="abs-blr color-white p-20 bg-sm-color-7">
                        <h4 class="mb-10 mb-sm-5"><b>{{ $featuredNews[5]->title }}</b></h4>
                        <ul class="list-li-mr-20">
                            <li>{{ App\Helpers\Helper::getDateForPost($featuredNews[5]->created_at)}}</li>
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