<div id="top-bar" class="dark">

			<div class="container clearfix">

				<div class="col_half nobottommargin">

                    @php
                        $page_about = App\Models\TbPage::where('page_parmalink','about')->where('page_show',1)->first();
                        $page_ads   = App\Models\TbPage::where('page_parmalink','ads')->where('page_show',1)->first();
                    @endphp
					<div class="top-links">
						<ul class="sf-js-enabled clearfix" style="touch-action: pan-y;">
                            @if(!empty($page_about))
							    <li><a href="{{ route('fronend.page.detail',$page_about->page_parmalink) }}">เกี่ยวกับเรา</a></li>
                            @endif
                            @if(!empty($page_ads))
							    <li><a href="{{ route('fronend.page.detail',$page_ads->page_parmalink) }}">ลงโฆษณากับเรา</a></li>
                            @endif
						</ul>
					</div>

				</div>

                @php
                    $setting_contact_topnav = App\Models\TbSetting::first();
                @endphp
                @if (!empty($setting_contact_topnav ))
                    <div class="col_half fright col_last nobottommargin">
                        <div id="top-social">
                            <ul>
                                @if(!empty($setting_contact_topnav->setting_telContact))
                                <li><a href="tel:{{$setting_contact_topnav->setting_telContact}}" target="_bank" class="si-call" data-hover-width="109" style="width: 40px;"><span class="ts-icon"><i class="icon-call"></i></span><span class="ts-text">{{$setting_contact_topnav->setting_telContact}}</span></a></li>
                                @endif
                                @if(!empty($setting_contact_topnav->setting_emailContact))
                                <li><a href="mailto:{{$setting_contact_topnav->setting_emailContact}}" class="si-email3" data-hover-width="153" style="width: 40px;"><span class="ts-icon"><i class="icon-email3"></i></span><span class="ts-text">{{$setting_contact_topnav->setting_emailContact}}</span></a></li>
                                @endif
                                @if(!empty($setting_contact_topnav->setting_faxContact))
                                <li><a href="fax:{{$setting_contact_topnav->setting_faxContact}}" target="_bank" class="si-print" data-hover-width="109" style="width: 40px;"><span class="ts-icon"><i class="icon-print"></i></span><span class="ts-text">{{$setting_contact_topnav->setting_faxContact}}</span></a></li>
                                @endif
                                @if(!empty($setting_contact_topnav->setting_idLine))
                                <li><a href="{{$setting_contact_topnav->setting_idLine}}" target="_bank" class="si-evernote" data-hover-width="109" style="width: 40px;"><span class="ts-icon"><i class="icon-comments-alt"></i></span><span class="ts-text">{{$setting_contact_topnav->setting_idLine}}</span></a></li>
                                @endif
                                @if(!empty($setting_contact_topnav->setting_LinkYoutube))
                                <li><a href="{{$setting_contact_topnav->setting_LinkYoutube}}" target="_bank" class="si-youtube" data-hover-width="109" style="width: 40px;"><span class="ts-icon"><i class="icon-youtube"></i></span><span class="ts-text">Youtube</span></a></li>
                                @endif
                                @if(!empty($setting_contact_topnav->setting_LinkTwitter))
                                <li><a href="{{$setting_contact_topnav->setting_LinkTwitter}}" target="_bank" class="si-twitter" data-hover-width="109" style="width: 40px;"><span class="ts-icon"><i class="icon-twitter"></i></span><span class="ts-text">Twitter</span></a></li>
                                @endif
                                @if(!empty($setting_contact_topnav->setting_LinkInstagram))
                                <li><a href="{{$setting_contact_topnav->setting_LinkInstagram}}" target="_bank" class="si-instagram" data-hover-width="109" style="width: 40px;"><span class="ts-icon"><i class="icon-instagram"></i></span><span class="ts-text">Instagram</span></a></li>
                                @endif
                                @if(!empty($setting_contact_topnav->setting_LinkFacebook))
                                <li><a href="{{$setting_contact_topnav->setting_LinkFacebook}}" target="_bank" class="si-facebook" data-hover-width="109" style="width: 40px;"><span class="ts-icon"><i class="icon-facebook"></i></span><span class="ts-text">Facebook</span></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endif


			</div>

		</div>
