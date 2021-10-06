<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="robots" content="index, follow" />
        <meta http-equiv="Content-Language" content="th">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="author" content="@if(!empty($setting->setting_nameWeb)){{ $setting->setting_nameWeb }}@endif" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
        @php
            $setting = App\Models\TbSetting::first();
            $extension = App\Models\TbExtension::first();
            $customcode = App\Models\TbCustomcode::count();
        @endphp

        <link rel="icon" href="@if(!empty($setting->setting_iconWeb)){{ asset('storage/setting/'.$setting->setting_iconWeb) }}@endif" type ="image/x-icon">
        <link rel="shortcut icon" href="@if(!empty($setting->setting_iconWeb)){{ asset('storage/setting/'.$setting->setting_iconWeb) }}@endif" type="image/x-icon">
        <title>@yield('title')@if(!empty($setting->setting_nameWeb)){{$setting->setting_nameWeb}}@endif</title>

        <meta property="og:site_name" content="@yield('og_site_name')"/>
        <meta name="keywords" content="@yield('og_keywords')">
        <meta name="description" content="@yield('og_description')">
        <meta name="language" content="TH">
        <meta name="revisit-after" content="1 day" />
        <meta name='copyright' content='{{ $_SERVER['SERVER_NAME'] }}'>

        <meta property="og:locale" content="TH" />
        <meta property="og:site_name" content="@yield('og_site_name')" />
        <meta property="og:type" content="article"/>
        <meta property="og:title" content="@yield('og_title')" />
        <meta property="og:description" content="@yield('og_description')" />
        <meta property="og:url" content="@yield('og_url')" />
        <meta property="og:image" content="@yield('og_image')" />

        <link rel="stylesheet" href="{{ asset('fonts/Kanit/stylesheet.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/fontend/css/fonts.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('assets/fontend/bootstrap.min.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('assets/fontend/style.min.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('assets/fontend/css/swiper.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('assets/fontend/css/dark.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('assets/fontend/css/font-icons.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('assets/fontend/css/animate.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('assets/fontend/css/magnific-popup.css') }}" type="text/css" />

        <link rel="stylesheet" href="{{ asset('assets/fontend/css/responsive.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('assets/fontend/custom.css?v=16') }}" type="text/css" />

        @yield('css')

        @if ($customcode != 0)
            @php
                $get_css = App\Models\TbCustomcode::where('custom_type','css')->where('custom_show',1)->get();
            @endphp
            @foreach ($get_css as $css)
                {!!$css->custom_detail!!}
            @endforeach
        @endif

        @if(!empty($extension->ext_googleWebmaster))
            <meta name="google-site-verification" content="{{ $extension->ext_googleWebmaster }}" />
        @endif
        @if(!empty($extension->ext_googleAnalytics))
            <script async src="https://www.googletagmanager.com/gtag/js?id={{ $extension->ext_googleAnalytics }}"></script>
            <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '{{ $extension->ext_googleAnalytics }}');
            </script>
        @endif
        @if(!empty($extension->ext_googleAdsense))
            {!! $extension->ext_googleAdsense !!}
        @endif

        @if ($customcode != 0)
            @php
                $get_tag = App\Models\TbCustomcode::where('custom_type','tag')->where('custom_show',1)->get();
            @endphp
            @foreach ($get_tag as $tag)
                {!!$tag->custom_detail!!}
            @endforeach
        @endif
    </head>
<body class="stretched">

    <div id="wrapper" class="clearfix">
        @include('layouts.fontend.topbar')
        @include('layouts.fontend.banner-ads.ads-top-header')
        @include('layouts.fontend.header')
        <section id="content">
            @yield('content')
        </section>
        @include('layouts.fontend.footer')
    </div>

	<div id="gotoTop" class="icon-angle-up"></div>

	<script type="text/javascript" src="{{ asset('assets/fontend/js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/fontend/js/plugins.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/fontend/js/functions.js?v=3') }}"></script>

    @yield('js')

    @if ($customcode != 0)
        @php
            $get_js = App\Models\TbCustomcode::where('custom_type','js')->where('custom_show',1)->get();
        @endphp
        @foreach ($get_js as $js)
            {!!$js->custom_detail!!}
        @endforeach
    @endif

</body>
</html>
