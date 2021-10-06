@if (!empty($setting_ads))
    @if($setting_ads->set_head_show == 1)
        @php
            function compareDateSale($date1,$date2) {
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
        <div id="fslider-topnav" class="container clearfix">
            <div class="fslider" data-easing="easeInQuad" >
                <div class="flexslider">
                    <div class="slider-wrap">
                        @if (count($ads_head_get) != 0)
                            @foreach ( $ads_head_get as $ads_head)
                                @if ($ads_head->ads_set_date_status == 1)

                                    <div class="slide" data-thumb="{{ asset('storage/ads_im/'.$ads_head->ads_img) }}">
                                        @if(!empty($ads_head->ads_link))
                                            <a href="{{ $ads_head->ads_link }}">
                                        @endif
                                            <img width="1140" height="150" class="ads_head" src="{{ asset('storage/ads_im/'.$ads_head->ads_img) }}" alt="{{ $ads_head->ads_name }}">
                                        @if(!empty($ads_head->ads_link))
                                            </a>
                                        @endif
                                    </div>

                                @else

                                    @php
                                        $date_today        = date('Y-m-d');
                                        $status_date_start = compareDateSale($date_today,$ads_head->ads_set_date_start);
                                        $status_date_end   = compareDateSale($date_today,$ads_head->ads_set_date_end);
                                    @endphp

                                    @if($status_date_start != 2)

                                        @if($status_date_end != 0)
                                            <div class="slide" data-thumb="{{ asset('storage/ads_im/'.$ads_head->ads_img) }}">
                                                @if(!empty($ads_head->ads_link))
                                                    <a href="{{ $ads_head->ads_link }}">
                                                @endif
                                                    <img class="ads_head" src="{{ asset('storage/ads_im/'.$ads_head->ads_img) }}" alt="{{ $ads_head->ads_name }}">
                                                @if(!empty($ads_head->ads_link))
                                                    </a>
                                                @endif
                                            </div>
                                        @endif

                                    @endif


                                @endif

                            @endforeach
                        @else
                            <div class="slide" data-thumb="{{ asset('assets/fontend/images/AdsB/ads-top-header.webp') }}">
                                <img src="{{ asset('assets/fontend/images/AdsB/ads-top-header.webp') }}" alt="Ads">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
