<h4 class="p-title mt-30"><b>{{ trans('magazine.featured_categories') }}</b></h4>
<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @if (isset($featuredNewsCategories['category_1'][0]))
                <li class="nav-item">
                    <a class="nav-link active font-13" id="category1-tab" data-toggle="tab" href="#category1"
                    role="tab" aria-controls="category1"
                    aria-selected="true">{{ $featuredNewsCategories['category_1'][0]->name }}</a>
                </li>
            @endif
            @if (isset($featuredNewsCategories['category_2'][0]))
                <li class="nav-item">
                    <a class="nav-link font-13" id="category2-tab" data-toggle="tab" href="#category2"
                    role="tab" aria-controls="category2"
                    aria-selected="false">{{ $featuredNewsCategories['category_2'][0]->name }}</a>
                </li>
            @endif
            @if (isset($featuredNewsCategories['category_3'][0]))
                <li class="nav-item">
                    <a class="nav-link font-13" id="category3-tab" data-toggle="tab" href="#category3"
                    role="tab" aria-controls="category3"
                    aria-selected="false">{{ $featuredNewsCategories['category_3'][0]->name }}</a>
                </li>
            @endif
            @if (isset($featuredNewsCategories['category_4'][0]))
                <li class="nav-item">
                    <a class="nav-link font-13" id="category4-tab" data-toggle="tab" href="#category4"
                    role="tab" aria-controls="category4"
                    aria-selected="false">{{ $featuredNewsCategories['category_4'][0]->name }}</a>
                </li>
            @endif
        </ul>
        <div class="tab-content mt-4" id="myTabContent">
            <div class="tab-pane fade show active" id="category1" role="tabpanel" aria-labelledby="category1-tab">
                <div class="col-sm-12">
                    <div class="row">
                        @foreach($featuredNewsCategories['category_1'] as $category_1)
                            <div class="col-sm-6">
                                <a href="{{ route('magazine.show', ['id' => $category_1->id, 'title' => Illuminate\Support\Str::slug($category_1->title)]) }}">
                                    <img src="{{ asset('/images/news/large') . '/' . $category_1->image_link }}"
                                        alt="">
                                    <h4 class="pt-20"><b>{{ $category_1->title }}</b></h4>
                                    <ul class="list-li-mr-20 pt-10 mb-30">
                                        <li class="color-lite-black">{{ trans('magazine.by') }} <b>{{ $category_1->author->name }}</b></a>
                                            {{ App\Helpers\Helper::getWrittenDateLanguage($category_1->created_at)}}
                                        </li>
                                    </ul>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="category2" role="tabpanel" aria-labelledby="category2-tab">
                <div class="tab-pane fade show active" id="home" role="tabpanel"
                        aria-labelledby="category2-tab">
                    <div class="col-sm-12">
                        <div class="row">
                            @foreach($featuredNewsCategories['category_2'] as $category_2)
                                <div class="col-sm-6">
                                    <a href="{{ route('magazine.show', ['id' => $category_2->id, 'title' => Illuminate\Support\Str::slug($category_2->title)]) }}">
                                        <img src="{{ asset('/images/news/large') . '/' . $category_2->image_link }}"
                                            alt="">
                                        <h4 class="pt-20"><b>{{ $category_2->title }}</b>
                                        </h4>
                                        <ul class="list-li-mr-20 pt-10 mb-30">
                                            <li class="color-lite-black">{{ trans('magazine.by') }} <b>{{ $category_2->author->name }}</b>
                                                {{ App\Helpers\Helper::getWrittenDateLanguage($category_2->created_at)}}
                                            </li>
                                        </ul>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="category3" role="tabpanel" aria-labelledby="category3-tab">
                <div class="tab-pane fade show active" id="home" role="tabpanel"
                        aria-labelledby="category3-tab">
                    <div class="col-sm-12">
                        <div class="row">
                            @foreach($featuredNewsCategories['category_3'] as $category_3)
                                <div class="col-sm-6">
                                    <a href="{{ route('magazine.show', ['id' => $category_3->id, 'title' => Illuminate\Support\Str::slug($category_3->title)]) }}">
                                        <img src="{{ asset('/images/news/large') . '/' . $category_3->image_link }}"
                                            alt="">
                                        <h4 class="pt-20"><b>{{ $category_3->title }}</b>
                                        </h4>
                                        <ul class="list-li-mr-20 pt-10 mb-30">
                                            <li class="color-lite-black">{{ trans('magazine.by') }} <b>{{ $category_3->author->name }}</b>
                                                {{ App\Helpers\Helper::getWrittenDateLanguage($category_3->created_at)}}
                                            </li>
                                        </ul>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="category4" role="tabpanel" aria-labelledby="category4-tab">
                <div class="tab-pane fade show active" id="home" role="tabpanel"
                        aria-labelledby="category4-tab">
                    <div class="col-sm-12">
                        <div class="row">
                            @foreach($featuredNewsCategories['category_4'] as $category_4)
                                <div class="col-sm-6">
                                    <a href="{{ route('magazine.show', ['id' => $category_4->id, 'title' => Illuminate\Support\Str::slug($category_4->title)]) }}">
                                        <img src="{{ asset('/images/news/large') . '/' . $category_4->image_link }}"
                                            alt="">
                                        <h4 class="pt-20"><a href="#"><b>{{ $category_4->title }}</b></a>
                                        </h4>
                                        <ul class="list-li-mr-20 pt-10 mb-30">
                                            <li class="color-lite-black">{{ trans('magazine.by') }} <b>{{ $category_4->author->name }}</b>
                                                {{ App\Helpers\Helper::getWrittenDateLanguage($category_4->created_at) }}
                                            </li>
                                        </ul>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
