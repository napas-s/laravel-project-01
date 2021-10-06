<footer id="footer" class="dark">

    <div class="container">

        <div class="footer-widgets-wrap clearfix">

            <div class="col_three_fourth">
                @php
                    $log_tags = App\Models\LogTag::first();
                @endphp
                @if(!empty($log_tags))
                    @php
                        $tags = explode(",",$log_tags->value);
                        asort($tags);
                    @endphp
                    <div class="tagcloud">
                        @foreach ( $tags as $tag )
                            <a href="{{ route('fronend.search.tag',$tag) }}" rel="tag">{{ $tag }}</a>
                        @endforeach
                    </div>
                @endif

            </div>

            <div class="col_one_fourth col_last">
                @php
                    $extension = App\Models\TbExtension::first();
                @endphp
                @if(!empty($extension))
                    <div class="widget clearfix" style="margin-bottom: 10px;">
                        {!! $extension->ext_histats !!}
                    </div>
                @endif

                @php
                    $setting_contact = App\Models\TbSetting::first();
                @endphp
                @if(!empty($setting_contact))
                <div class="widget clearfix" style="margin-bottom: -20px;">

                    @if(!empty($setting_contact->setting_telContact))
                    <a href="tel:{{$setting_contact->setting_telContact}}" class="social-icon si-colored si-call" title="Call">
                        <i class="icon-call"></i>
                        <i class="icon-call"></i>
                    </a>
                    @endif
                    @if(!empty($setting_contact->setting_emailContact))
                    <a href="mailto:{{$setting_contact->setting_emailContact}}" target="_bank" class="social-icon si-colored si-email3" title="Email">
                        <i class="icon-email3"></i>
                        <i class="icon-email3"></i>
                    </a>
                    @endif
                    @if(!empty($setting_contact->setting_faxContact))
                    <a href="fax:{{$setting_contact->setting_faxContact}}" target="_bank" class="social-icon si-colored si-print" title="Print">
                        <i class="icon-print"></i>
                        <i class="icon-print"></i>
                    </a>
                    @endif
                    @if(!empty($setting_contact->setting_idLine))
                    <a href="{{$setting_contact->setting_idLine}}" target="_bank" class="social-icon si-colored si-evernote" title="Line">
                        <i class="icon-comments-alt"></i>
                        <i class="icon-comments-alt"></i>
                    </a>
                    @endif
                    @if(!empty($setting_contact->setting_LinkYoutube))
                    <a href="{{$setting_contact->setting_LinkYoutube}}" target="_bank" class="social-icon si-colored si-youtube" title="Youtube">
                        <i class="icon-youtube"></i>
                        <i class="icon-youtube"></i>
                    </a>
                    @endif
                    @if(!empty($setting_contact->setting_LinkTwitter))
                    <a href="{{$setting_contact->setting_LinkTwitter}}" target="_bank" class="social-icon si-colored si-twitter" title="Twitter">
                        <i class="icon-twitter"></i>
                        <i class="icon-twitter"></i>
                    </a>
                    @endif
                    @if(!empty($setting_contact->setting_LinkInstagram))
                    <a href="{{$setting_contact->setting_LinkInstagram}}" target="_bank" class="social-icon si-colored si-instagram" title="Instagram">
                        <i class="icon-instagram"></i>
                        <i class="icon-instagram"></i>
                    </a>
                    @endif
                    @if(!empty($setting_contact->setting_LinkFacebook))
                    <a href="{{$setting_contact->setting_LinkFacebook}}" target="_bank" class="social-icon si-dark si-colored si-facebook" title="Facebook">
                        <i class="icon-facebook"></i>
                        <i class="icon-facebook"></i>
                    </a>
                    @endif

                </div>
                @endif

            </div>

        </div>

    </div>

    <div id="copyrights">
        <div class="container clearfix">
            <div class="col_half">
                Copyrights &copy; {{ date('Y') }} All Rights Reserved by {{ $_SERVER['SERVER_NAME'] }}.<br>
            </div>
            <div class="col_half col_last tright">
                <div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>
            </div>
        </div>
    </div>
</footer>
