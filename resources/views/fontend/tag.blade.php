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
                        @if (!empty($log_tags))
                            <h3>{{ $name_category }}</h3>
                            <hr/>
                            <div class="tagcloud">
                                @foreach ( $log_tags as $tag )
                                    <a href="{{ route('fronend.search.tag',$tag) }}" rel="tag">{{ $tag }}</a>
                                @endforeach
                            </div>

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

