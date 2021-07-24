<style>
    #carousel.floating {
        position: fixed;
        top: 5px;
        width: 100%;
    }

    #carousel {
        z-index: 999;
    }
</style>

@if ($topBannerSetting->active && !$topBanners->isEmpty())
<div id="carousel-wrapper">
    <div id="carousel">
        <div class="container mb-4">
            <div id="carouselTopBanners" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($topBanners as $topBanner)
                        <div class="{{ $loop->index === 0 ? 'carousel-item active' : 'carousel-item' }}">
                            <a href="{{ $topBanner->destination_link }}" target="__blank">
                                <img class="d-block w-100"
                                    src="{{ asset('/images/top-banners') . '/' . $topBanner->image_link }}"
                                    alt="{{ $topBanner->title }}">
                            </a>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselTopBanners" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselTopBanners" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endif