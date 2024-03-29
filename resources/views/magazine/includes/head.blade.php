<title>{{ App\Helpers\Helper::getCompanyName() }}</title>

@if (App\Helpers\Helper::faviconExists())
    <link rel="icon" type="image/jpg" href="/images/ico/icon_tab.ico"/>
@endif

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">

<link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:400,600,700" rel="stylesheet">
<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('/css/styles-news-theme.css') }}" rel="stylesheet">
<link href="{{ asset('/fontawesome/css/all.css') }}" rel="stylesheet" type="text/css">

{!! \App\Helpers\Helper::getGoogleAdsScript() !!}
{!! \App\Helpers\Helper::getGoogleAnalyticsScript() !!}

