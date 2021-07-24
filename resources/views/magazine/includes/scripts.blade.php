<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/scripts-news-theme.js') }}"></script>

<script>
    $(document).ready( function() {

    @if($topBannerSetting->keep_on_top_when_scrolling)
    $(window).scroll( function() {
        if ($(window).scrollTop() > $('#carousel-wrapper').offset().top)
            $('#carousel').addClass('floating');
        else
            $('#carousel').removeClass('floating');
    } );
    @endif

} );
</script>