@extends('layouts.temp_user')

@section('og_site_name'){{ $og_site_name }}@endsection
@section('og_keywords'){{ $og_keywords }}@endsection
@section('og_title'){{ $og_title }}@endsection
@section('og_description'){{ $og_description }}@endsection
@section('og_url'){{ $og_url }}@endsection
@section('og_image'){{ $art_thumb }}@endsection

@section('css')
@if(count($banners) < 2)
<style>
    .flex-direction-nav{
        display: none !important;
    }
</style>
@endif
@endsection

@section('content')

    <!-- Content ============================================= -->
        <div class="content-wrap">
            <div class="container clearfix">
                <div class="@if (!empty($setting_ads)) @if($setting_ads->set_banner_show == 1) fslider-grid-two @endif @endif bottommargin-sm">
                    @if (!empty($setting_ads))
                        @if($setting_ads->set_banner_show == 1)
                            <div>
                                <div class="fslider" data-easing="easeInQuad">
                                    <div class="flexslider">
                                        <div class="slider-wrap">

                                            @if (count($ads_banner_get) != 0)
                                                @php
                                                    function compareDate_ads_banner($date1,$date2) {
                                                        $arrDate1 = explode("-",$date1);
                                                        $arrDate2 = explode("-",$date2);
                                                        $timStmp1 = mktime(0,0,0,$arrDate1[1],$arrDate1[2],$arrDate1[0]);
                                                        $timStmp2 = mktime(0,0,0,$arrDate2[1],$arrDate2[2],$arrDate2[0]);

                                                        if ($timStmp1 == $timStmp2) {
                                                            return 1;
                                                        } else if ($timStmp1 > $timStmp2) {
                                                            return 0;
                                                        } else if ($timStmp1 < $timStmp2) {
                                                            return 2;
                                                        }
                                                    }
                                                @endphp
                                                @foreach ( $ads_banner_get as $ads_banner)
                                                    @if ($ads_banner->ads_set_date_status == 1)

                                                        <div class="slide" data-thumb="{{ asset('storage/ads_im/'.$ads_banner->ads_img) }}">
                                                            @if(!empty($ads_banner->ads_link))
                                                            <a href="{{$ads_banner->ads_link}}">
                                                            @endif
                                                                <img width="661" height="314" src="{{ asset('storage/ads_im/'.$ads_banner->ads_img) }}" alt="{{$ads_banner->ads_img}}">
                                                            @if(!empty($ads_banner->ads_link))
                                                            </a>
                                                            @endif
                                                        </div>

                                                    @else

                                                        @php
                                                            $date_today        = date('Y-m-d');
                                                            $status_date_start = compareDate_ads_banner($date_today,$ads_banner->ads_set_date_start);
                                                            $status_date_end   = compareDate_ads_banner($date_today,$ads_banner->ads_set_date_end);
                                                        @endphp

                                                        @if($status_date_start != 2)

                                                            @if($status_date_end != 0)
                                                                <div class="slide" data-thumb="{{ asset('storage/ads_im/'.$ads_banner->ads_img) }}">
                                                                    @if(!empty($ads_banner->ads_link))
                                                                    <a href="{{$ads_banner->ads_link}}">
                                                                    @endif
                                                                        <img width="661" height="314" src="{{ asset('storage/ads_im/'.$ads_banner->ads_img) }}" alt="{{$ads_banner->ads_img}}">
                                                                    @if(!empty($ads_banner->ads_link))
                                                                    </a>
                                                                    @endif
                                                                </div>
                                                            @endif

                                                        @endif


                                                    @endif

                                                @endforeach
                                            @else
                                                <div class="slide" data-thumb="{{ asset('assets/fontend/images/AdsB/ads_661_314.jpg') }}">
                                                    <img width="661" height="314" src="{{ asset('assets/fontend/images/AdsB/ads_661_314.webp') }}" alt="Slide Ads">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                    <div>
                        <div class="heading-block bottommargin-sm">
                            <h3>{{ $setting->setting_nameWeb }}</h3>
                        </div>
                        <div class=" clearfix">
                            {{ $setting->setting_detail }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="nav-right-grid-two">
                    <div>
                        @if(count($article_lasts) != 0)
                            <div class=" bottommargin-sm clearfix">
                                <div class="fancy-title title-dotted-border">
                                    <h2>บทความล่าสุด</h2>
                                </div>
                                <div class="clearfix"></div>
                                <div class="index-grid-three">
                                    @foreach ($article_lasts as $article_last)
                                        <div class="bx-art">
                                            <a href="{{ route('fronend.articles.detail',$article_last->art_parmalink) }}">
                                                @if(!empty($article_last->art_thumb))
                                                    <img width="242" height="134" class="lazyload" loading="lazy" data-src="{{ asset('storage/article/' . $article_last->art_thumb) }}" alt="{{ $article_last->art_name }}">
                                                @else
                                                    <img width="242" height="134" class="lazyload" loading="lazy" data-src="{{ asset('assets/fontend/images/noImg/no-01.webp') }}" alt="{{ $article_last->art_name }}">
                                                @endif
                                            </a>
                                            <div class="clearfix"></div>
                                            <div class="hart-title topmargin-sm">
                                                <a href="{{ route('fronend.articles.detail',$article_last->art_parmalink) }}"><h4>{{ $article_last->art_name }}</h4></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if(count($article_views) != 0)
                            <div class=" bottommargin-sm clearfix">
                                <div class="fancy-title title-dotted-border">
                                    <h2>บทความที่มีผู้เข้าชมมากที่สุด</h2>
                                </div>
                                <div class="clearfix"></div>
                                <div class="index-grid-three">
                                    @foreach ($article_views as $article_view)
                                        <div class="bx-art">
                                            <a href="{{ route('fronend.articles.detail',$article_view->art_parmalink) }}">
                                                @if(!empty($article_view->art_thumb))
                                                    <img width="242" height="134" class="lazyload" loading="lazy" data-src="{{ asset('storage/article/' . $article_view->art_thumb) }}" alt="{{ $article_view->art_name }}">
                                                @else
                                                    <img width="242" height="134" class="lazyload" loading="lazy" data-src="{{ asset('assets/fontend/images/noImg/no-01.webp') }}" alt="{{ $article_view->art_name }}">
                                                @endif
                                            </a>
                                            <div class="clearfix"></div>
                                            <div class="hart-title topmargin-sm">
                                                <a href="{{ route('fronend.articles.detail',$article_view->art_parmalink) }}"><h4>{{ $article_view->art_name }}</h4></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if(count($article_recommends) != 0)
                            <div class=" bottommargin-sm clearfix">
                                <div class="fancy-title title-dotted-border">
                                    <h2>บทความแนะนำ</h2>
                                </div>
                                <div class="clearfix"></div>
                                <div class="index-grid-three">
                                    @foreach ($article_recommends as $article_recommend)
                                        <div class="bx-art">
                                            <a href="{{ route('fronend.articles.detail',$article_recommend->art_parmalink) }}">
                                                @if(!empty($article_recommend->art_thumb))
                                                    <img width="242" height="134" class="lazyload" loading="lazy" data-src="{{ asset('storage/article/' . $article_recommend->art_thumb) }}" alt="{{ $article_recommend->art_name }}">
                                                @else
                                                    <img width="242" height="134" class="lazyload" loading="lazy" data-src="{{ asset('assets/fontend/images/noImg/no-01.webp') }}" alt="{{ $article_recommend->art_name }}">
                                                @endif
                                            </a>
                                            <div class="clearfix"></div>
                                            <div class="hart-title topmargin-sm">
                                                <a href="{{ route('fronend.articles.detail',$article_recommend->art_parmalink) }}"><h4>{{ $article_recommend->art_name }}</h4></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="clearfix"></div>
                                <div class="tright topmargin-sm">
                                    <a href="{{ route('fronend.articles.recommend') }}" class="button button-rounded button-reveal button-large button-border tright"><i class="icon-angle-right"></i><span>อ่านเพิ่มเติม...</span></a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="sidebar-widgets-wrap">
                        @include('layouts.fontend.navright')
                    </div>
                </div>
            </div>
        </div>
    <!-- #content end -->

@endsection

