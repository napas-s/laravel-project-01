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
                    @if(!empty($article_get))
                        <div class="entry clearfix">

                            <div class="entry-title">
                                <h2>{{$article_get->art_name}}</h2>
                            </div>

                            <div class="entry-meta-dis">
                                <ul class="entry-meta clearfix">
                                    <li><i class="icon-calendar3"></i> {{ date("d-m-Y",strtotime($article_get->updated_at)) }}</li>
                                    <li><a href="#"><i class="icon-user"></i> {{ $article_get->created_by }}</a></li>
                                    <li><a href="#"><i class="icon-eye"></i> {{ number_format($article_get->art_view) }}</a></li>
                                    @if (Route::has('zanagun'))
                                        @auth
                                            <li><a href="{{ route('artlicle.edit',['id' => $article_get->id]) }}" class="co_337ab7"><i class="icon-edit"></i>  แก้ไขบทความ</a></li>
                                        @endauth
                                    @endif
                                </ul>
                                <div class="clearfix">
                                    <div class="float-right">
                                        <a href="http://www.facebook.com/sharer.php?u={{ route('fronend.articles.detail',$article_get->art_parmalink) }}" target="_blank" class="social-icon si-small si-colored si-facebook">
                                            <i class="icon-facebook"></i>
                                            <i class="icon-facebook"></i>
                                        </a>
                                        <a href="http://twitter.com/share?url={{ route('fronend.articles.detail',$article_get->art_parmalink) }}" target="_blank" class="social-icon si-small si-colored si-twitter">
                                            <i class="icon-twitter"></i>
                                            <i class="icon-twitter"></i>
                                        </a>
                                        <a href="https://social-plugins.line.me/lineit/share?url={{ route('fronend.articles.detail',$article_get->art_parmalink) }}" target="_blank" class="social-icon si-small si-colored si-ebay">
                                            <i><img src="{{ asset('assets/fontend/images/icons/social/Line-Icon-b-borderless.png') }}" class="icon-less" alt="Line borderless"></i>
                                            <i><img src="{{ asset('assets/fontend/images/icons/social/Line-Icon-b-borderless.png') }}" class="icon-less" alt="Line borderless"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="entry-image">
                                <img class="lazyload" loading="lazy" data-src="{{ $art_thumb }}" alt="{{ $article_get->art_name }}">
                            </div>

                            <div class="entry-content notopmargin">

                                {!! $article_get->art_detail !!}

                                <div class="bottommargin-sm"></div>

                                @if(!empty($article_get->art_keyword))
                                    @php
                                        $tags = explode(",",$article_get->art_keyword);
                                        asort($tags);
                                    @endphp
                                    <div class="tagcloud clearfix bottommargin">
                                        @foreach ( $tags as $tag )
                                            <a href="{{ route('fronend.search.tag',$tag) }}" rel="tag">{{ $tag }}</a>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="clearfix"></div>

                                <div class="dis-share">
                                    <div>แบ่งปัน:</div>
                                    <div>
                                        <div class="float-right">
                                            <a href="http://www.facebook.com/sharer.php?u={{ route('fronend.articles.detail',$article_get->art_parmalink) }}" target="_blank" class="social-icon si-small si-colored si-facebook">
                                                <i class="icon-facebook"></i>
                                                <i class="icon-facebook"></i>
                                            </a>
                                            <a href="http://twitter.com/share?url={{ route('fronend.articles.detail',$article_get->art_parmalink) }}" target="_blank" class="social-icon si-small si-colored si-twitter">
                                                <i class="icon-twitter"></i>
                                                <i class="icon-twitter"></i>
                                            </a>
                                            <a href="https://social-plugins.line.me/lineit/share?url={{ route('fronend.articles.detail',$article_get->art_parmalink) }}" target="_blank" class="social-icon si-small si-colored si-ebay">
                                                <i><img src="{{ asset('assets/fontend/images/icons/social/Line-Icon-b-borderless.png') }}" class="icon-less" alt="Line borderless"></i>
                                                <i><img src="{{ asset('assets/fontend/images/icons/social/Line-Icon-b-borderless.png') }}" class="icon-less" alt="Line borderless"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @if (!empty($author))
                                    @if($article_get->art_author == 1)
                                    <div class="ling-content"></div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">โพสต์โดย :: {{ $author->penname }}</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="author-image">
                                                @if(!empty($author->img))
                                                    <img src="{{ asset('storage/avatar/' . $author->img) }}" class="img-circle" alt="{{ $author->penname  }}">
                                                @else
                                                    <img src="{{ asset('assets/fontend/images/noImg/no-01.jpg') }}" class="img-circle" alt="{{ $author->penname  }}">
                                                @endif
                                            </div>
                                            {{ $author->aboutme }}
                                        </div>
                                    </div>
                                    @endif
                                @endif
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
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v12.0&appId=1190234624660031&autoLogAppEvents=1" nonce="h8yjg5hD"></script>
<script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
@endsection
