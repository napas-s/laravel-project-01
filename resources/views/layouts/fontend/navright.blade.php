@php
    $navright = App\Models\TbCategory::where('cat_show',1)->get();
@endphp
@if(count($navright) != 0)
<div class="widget widget_links clearfix">
    <h3>ประวัติศาสตรผี ปีศาจ และอมนุษย์ทั่วโลก</h3>
    <ul>
        @foreach ($navright as $category )
            @php $count_article = App\Models\TbArticle::whereIn('art_cat',array($category->id))->where('art_show',1)->count() @endphp
            <li><a href="{{ route('fronend.category.index',$category->cat_parmalink) }}"><div class="nobottommargin hv-title-art">{{$category->cat_name}} ({{ $count_article }})</div></a></li>
        @endforeach
    </ul>

</div>
@endif
@php
    $log_tags_right = App\Models\LogTag::first();
@endphp
@if(!empty($log_tags_right))
<div class="widget widget_links clearfix widget_tag">
    <a href="{{ route('fronend.tag') }}"><div class="link-tag"><h4 class="nomargin"><i class="icon-tag"></i> ค้นหาจาก Tag ... คลิก! </h4></div></a>
</div>
@endif
@php
    $articleRandoms = App\Models\TbArticle::where('art_show',1)->inRandomOrder()->limit(5)->get();
@endphp
@if(count($articleRandoms) != 0)
    <div class="widget clearfix">

        <div id="oc-portfolio-sidebar" class="owl-carousel carousel-widget" data-items="1" data-margin="10" data-loop="true" data-nav="false" data-autoplay="5000">

            @foreach ($articleRandoms as $article_random)
                <div class="oc-item">
                    <div class="iportfolio">
                        <div class="portfolio-image">
                            <a href="{{ route('fronend.articles.detail',$article_random->art_parmalink ) }}">
                                @if(!empty($article_random->art_thumb))
                                    <img width="324" height="190" class="lazyload" loading="lazy" data-src="{{ asset('storage/article/' . $article_random->art_thumb) }}" alt="{{ $article_random->art_name }}">
                                @else
                                    <img width="324" height="190" class="lazyload" loading="lazy" data-src="{{ asset('assets/fontend/images/noImg/no-01.webp') }}" alt="{{ $article_random->art_name }}">
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
@endif

@if(!empty($extension->ext_histats))
    <div class="widget widget_links center clearfix">
        {!! $extension->ext_histats !!}
    </div>
@endif

@if (!empty($setting_ads))
    @if($setting_ads->set_right1_show == 1)
        <div class="widget widget_links clearfix">
            @if(count($ads_right1_get) != 0)
                @php
                    function compareDate_ads_right1($date1,$date2) {
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
                <div id="oc-portfolio-sidebar" class="owl-carousel carousel-widget" data-items="1" data-margin="10" data-loop="true" data-nav="false" data-autoplay="5000">
                    @foreach ($ads_right1_get as $ads_right1)
                        @if ($ads_right1->ads_set_date_status == 1)
                            <div class="oc-item">
                                <div class="iportfolio">
                                    <div class="portfolio-image">
                                        @if(!empty($ads_right1->ads_link))
                                        <a href="{{$ads_right1->ads_link}}">
                                        @endif
                                            @if(!empty($ads_right1->ads_img))
                                                <img width="324" height="276" class="lazyload" loading="lazy" data-src="{{ asset('storage/ads_im/'.$ads_banner->ads_img) }}" alt="{{$ads_banner->ads_img}}">
                                            @else
                                                <img width="324" height="276" class="lazyload" loading="lazy" data-src="{{ asset('storage/ads_im/'.$ads_banner->ads_img) }}" alt="{{$ads_banner->ads_img}}">
                                            @endif
                                        @if(!empty($ads_right1->ads_link))
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            @php
                                $date_today        = date('Y-m-d');
                                $status_date_start = compareDate_ads_right1($date_today,$ads_right1->ads_set_date_start);
                                $status_date_end   = compareDate_ads_right1($date_today,$ads_right1->ads_set_date_end);
                            @endphp

                            @if($status_date_start != 2)

                                @if($status_date_end != 0)
                                    <div class="oc-item">
                                        <div class="iportfolio">
                                            <div class="portfolio-image">
                                                @if(!empty($ads_right1->ads_link))
                                                <a href="{{$ads_right1->ads_link}}">
                                                @endif
                                                    @if(!empty($article_random->art_thumb))
                                                        <img width="342" height="276" class="lazyload" loading="lazy" data-src="{{ asset('storage/ads_im/'.$ads_right1->ads_img) }}" alt="{{$ads_right1->ads_img}}">
                                                    @else
                                                        <img width="342" height="276" class="lazyload" loading="lazy" data-src="{{ asset('storage/ads_im/'.$ads_right1->ads_img) }}" alt="{{$ads_right1->ads_img}}">
                                                    @endif
                                                @if(!empty($ads_right1->ads_link))
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @endif
                        @endif
                    @endforeach
                </div>
            @else
                <img width="342" height="276" class="lazyload" loading="lazy" data-src="{{ asset('assets/fontend/images/AdsB/ads_342_276.jpg') }}" alt="ads_right">
            @endif
        </div>
    @endif
@endif
