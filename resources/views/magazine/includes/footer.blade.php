<footer class="bg-191 color-ccc">
    <div class="container">
        <div class="pt-50 pb-20 pos-relative">
            <div class="abs-tblr pt-50 z--1 text-center">
                <div class="h-80 pos-relative"></div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="mb-30">
                        <div class="h5">{{ App\Helpers\Helper::getCompanyName() }} <strong><i
                                    class="fas fa-feather-alt"></i></strong></div>
                        <p class="mtb-20 color-ccc">

                            @if( env('APP_ENV') !== 'production' )
                                {{ trans('magazine.description') }}
                            @endif
                        </p>
                        <p class="color-ash">
                            {{ trans('magazine.developed_by', ['name' => 'Leonardo Gallo']) }}
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
