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

    <div class="content-wrap">
        <div class="container">
            <div class="nav-right-grid-two">
                <div>
                    @if(!empty($pages))
                        <div class="entry clearfix">

                            <div class="entry-content notopmargin">

                                {!! $pages->page_detail !!}

                                <div class="bottommargin-sm"></div>
                                <ul class="entry-meta clearfix">
                                    <li><i class="icon-calendar3"></i> {{ date("d-m-Y",strtotime($pages->updated_at)) }}</li>
                                    <li><a href="#"><i class="icon-user"></i> {{ $pages->created_by }}</a></li>
                                </ul>
                                <div class="clearfix"></div>

                                <div class="si-share noborder clearfix">
                                    <span>แบ่งปัน:</span>
                                    <div>
                                        <a href="http://www.facebook.com/sharer.php?u={{ route('fronend.page.detail',$pages->page_parmalink) }}" target="_blank" class="social-icon si-borderless si-facebook">
                                            <i class="icon-facebook"></i>
                                            <i class="icon-facebook"></i>
                                        </a>
                                        <a href="http://twitter.com/share?url={{ route('fronend.page.detail',$pages->page_parmalink) }}" target="_blank" class="social-icon si-borderless si-twitter">
                                            <i class="icon-twitter"></i>
                                            <i class="icon-twitter"></i>
                                        </a>
                                        <a href="https://social-plugins.line.me/lineit/share?url={{ route('fronend.page.detail',$pages->page_parmalink) }}" target="_blank" class="social-icon si-borderless si-ebay">
                                            <i><img src="{{ asset('assets/fontend/images/icons/social/Line-Icon-b-borderless.png') }}" class="icon-less" alt="Line borderless"></i>
                                            <i><img src="{{ asset('assets/fontend/images/icons/social/Line-Icon-b-borderless.png') }}" class="icon-less" alt="Line borderless"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="topmargin-lg bottommargin-lg center">
                            <h3>ไม่พบข้อมูล</h3>
                        </div>
                    @endif
                </div>
                <div class="sidebar-widgets-wrap">
                    @include('layouts.fontend.navright')
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v7.0"></script>
<script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
@endsection
