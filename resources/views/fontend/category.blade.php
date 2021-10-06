@extends('layouts.temp_user')

@section('og_site_name'){{ $og_site_name }}@endsection
@section('og_keywords'){{ $og_keywords }}@endsection
@section('og_title'){{ $og_title }}@endsection
@section('og_description'){{ $og_description }}@endsection
@section('og_url'){{ $og_url }}@endsection
@section('og_image'){{ $art_thumb }}@endsection

@section('css')
@if(count($banners) == 1)
<style>
    .flex-disabled{
        display: none !important;
    }
</style>
@endif
@endsection

@section('content')

    <!-- Content ============================================= -->
        <div class="content-wrap">
            <div class="container">
                <div class="nav-right-grid-two">
                    <div>
                        @if (!empty($name_category))
                            <h3>{{ $name_category }}</h3>
                            <hr/>
                            @if (!empty($article_get))
                                @foreach ($article_get as $article)
                                    <div class="cata-grid cata-line">
                                        <a href="{{ route('fronend.articles.detail',$article->art_parmalink) }}">
                                            @if(!empty($article->art_thumb))
                                                <img width="310" height="172" class="lazyload" loading="lazy" data-src="{{ asset('storage/article/' . $article->art_thumb) }}" alt="{{ $article->art_name }}">
                                            @else
                                                <img width="310" height="172" class="lazyload" loading="lazy" data-src="{{ asset('assets/fontend/images/noImg/no-01.webp') }}" alt="{{ $article->art_name }}">
                                            @endif
                                        </a>
                                        <div>
                                            <a href="{{ route('fronend.articles.detail',$article->art_parmalink) }}"><h4 class="cata-title">{{ $article->art_name }}</h4></a>
                                            <div class="cata-detail">
                                                {{ $article->art_seo_detail }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="clear"></div>
                                <div class="col_full topmargin">
                                    <div class="nav-link-entry">{!! $article_get->links() !!}</div>
                                </div>
                            @else
                                <div class="topmargin bottommargin center">
                                    <h4 class="">ไม่พบข้อมูล</h4>
                                </div>
                            @endif
                        @else
                            <h3>{{ $parmalink }}</h3>
                            <hr/>
                            <div class="topmargin bottommargin center">
                                <h4 class="">ไม่พบข้อมูล</h4>
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

