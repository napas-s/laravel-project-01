@php
    $UserLevel = App\Models\UsersLevel::where('UserId',Auth::user()->id)->first();
    $user_sidebar = App\Models\User::where('id',Auth::user()->id)->first();
@endphp
<div class="sidebar" data-color="brown" data-active-color="danger">
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                @if(!empty($user_sidebar->img))
                    <input type="hidden" class="form-control" id="img_old" name="img_old" value="{{ $user_sidebar->img }}">
                    <img class="picture-src" src="{{ asset('storage/avatar/'.$user_sidebar->img) }}" alt="..."/>
                @else
                    <img class="picture-src" src="{{ asset('images/default-img/default-avatar.png') }}" alt="..."  />
                @endif
            </div>
            <div class="info">
            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                <span>
                    {{ Auth::user()->displayname }}
                    <b class="caret"></b>
                </span>
            </a>
            <div class="clearfix"></div>
            <div class="collapse" id="collapseExample">
                <ul class="nav">
                    <li>
                        <a href="{{ route('user.profile', ['id' => Auth::user()->id]) }}">
                            <span class="sidebar-mini-icon">MP</span>
                            <span class="sidebar-normal">บัญชีผู้ใช้</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}">
                            <span class="sidebar-mini-icon">LG</span>
                            <span class="sidebar-normal">ออกจากระบบ</span>
                        </a>
                    </li>
                </ul>
            </div>
            </div>
        </div>
        <ul class="nav">
            <li id="dashboard" class="mainMenu active">
                <a href="{{ route('home') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li id="artlicle" class="mainMenu">
                <a data-toggle="collapse" href="#pagesArtlicle" >
                    <i class="nc-icon nc-book-bookmark"></i>
                    <p> จัดการบทความ <b class="caret"></b> </p>
                </a>
                <div class="collapse" id="pagesArtlicle">
                    <ul class="nav">
                        @if($UserLevel->l_artlicle == 1)
                            <li class="subMenu">
                                <a href="{{ route('artlicle.index') }}">
                                    <span class="sidebar-mini-icon">AC</span>
                                    <span class="sidebar-normal"> บทความ </span>
                                </a>
                            </li>
                        @endif
                        @if($UserLevel->l_category == 1)
                            <li class="subMenu">
                                <a href="{{ route('category.index') }}">
                                    <span class="sidebar-mini-icon">CA</span>
                                    <span class="sidebar-normal"> หมวดหมู่บทความ </span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
            <li id="page" class="mainMenu">
                <a data-toggle="collapse" href="#pages" >
                    <i class="nc-icon nc-align-left-2"></i>
                    <p> จัดการหน้าเพจ <b class="caret"></b> </p>
                </a>
                <div class="collapse" id="pages">
                    <ul class="nav">
                        @if($UserLevel->l_about == 1)
                            <li class="subMenu">
                                <a href="{{ route('page.about.index') }}">
                                    <span class="sidebar-mini-icon">AB</span>
                                    <span class="sidebar-normal"> เกี่ยวกับเรา </span>
                                </a>
                            </li>
                        @endif
                        @if($UserLevel->l_ads == 1)
                            <li class="subMenu">
                                <a href="{{ route('page.contactads.index') }}">
                                    <span class="sidebar-mini-icon">AD</span>
                                    <span class="sidebar-normal"> ลงโฆษณากับเรา </span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
            {{-- @if($UserLevel->l_banner == 1)
                <li id="banner" class="mainMenu">
                    <a href="{{ route('banner.index') }}">
                        <i class="nc-icon nc-single-copy-04"></i>
                        <p>แบรนเนอร์</p>
                    </a>
                </li>
            @endif --}}
            @if($UserLevel->l_user == 1)
                <li id="user" class="mainMenu">
                    <a href="{{ route('user.index') }}">
                        <i class="nc-icon nc-circle-10"></i>
                        <p> บัญชีผู้ใช้ </p>
                    </a>
                </li>
            @endif
            @if($UserLevel->l_setting == 1)
                <li id="settingMain" class="mainMenu" >
                    <a data-toggle="collapse" href="#Setting">
                        <i class="nc-icon nc-layout-11"></i>
                        <p>
                        ตั้งค่าเว็บไซต์
                        <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="Setting">
                        <ul class="nav">
                            <li class="subMenu">
                                <a href="{{ route('setting.index') }}">
                                    <span class="sidebar-mini-icon">SW</span>
                                    <span class="sidebar-normal"> ข้อมูลเกี่ยวกับเว็บไซต์ </span>
                                </a>
                            </li>
                            <li class="subMenu">
                                <a href="{{ route('setting.contact') }}">
                                    <span class="sidebar-mini-icon">SC</span>
                                    <span class="sidebar-normal"> ข้อมูลติดต่อเรา </span>
                                </a>
                            </li>
                            <li class="subMenu">
                                <a href="{{ route('setting.extensions') }}">
                                <span class="sidebar-mini-icon">SE</span>
                                <span class="sidebar-normal"> ตั้งค่าเพิ่มเติม </span>
                                </a>
                            </li>
                            <li class="subMenu">
                                <a href="{{ route('setting.logtag') }}">
                                <span class="sidebar-mini-icon">TM</span>
                                <span class="sidebar-normal"> Tag Manager </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            @if($UserLevel->l_setting_ads == 1)
                <li id="setting_ads" class="mainMenu" >
                    <a data-toggle="collapse" href="#settingAds">
                        <i class="nc-icon nc-money-coins"></i>
                        <p>
                        ตั้งค่าโฆษณา
                        <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse " id="settingAds">
                        <ul class="nav">
                            <li class="subMenu">
                                <a href="{{ route('ads.index') }}">
                                    <span class="sidebar-mini-icon">SA</span>
                                    <span class="sidebar-normal"> ตั้งค่าโฆษณา </span>
                                </a>
                            </li>
                            <li class="subMenu">
                                <a href="{{ route('ads.head.index') }}">
                                    <span class="sidebar-mini-icon">AH</span>
                                    <span class="sidebar-normal"> โฆษณา (ส่วนหัว) </span>
                                </a>
                            </li>
                            <li class="subMenu">
                                <a href="{{ route('ads.banner.index') }}">
                                    <span class="sidebar-mini-icon">AB</span>
                                    <span class="sidebar-normal"> โฆษณา (แบรนเนอร์) </span>
                                </a>
                            </li>
                            <li class="subMenu">
                                <a href="{{ route('ads.right.index') }}">
                                    <span class="sidebar-mini-icon">AR</span>
                                    <span class="sidebar-normal"> โฆษณา (ด้านข้าง) </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
            @if($UserLevel->l_customcode == 1)
                <li id="customcode" class="mainMenu" >
                    <a data-toggle="collapse" href="#customCode">
                        <i class="nc-icon nc-ruler-pencil"></i>
                        <p>
                        Custom Code
                        <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse " id="customCode">
                        <ul class="nav">
                            <li class="subMenu">
                                <a href="{{ route('custom.index',['code' => 'css']) }}">
                                    <span class="sidebar-mini-icon">CC</span>
                                    <span class="sidebar-normal"> Custom Code Css </span>
                                </a>
                            </li>
                            <li class="subMenu">
                                <a href="{{ route('custom.index',['code' => 'js']) }}">
                                    <span class="sidebar-mini-icon">CJ</span>
                                    <span class="sidebar-normal"> Custom Code JS </span>
                                </a>
                            </li>
                            <li class="subMenu">
                                <a href="{{ route('custom.index',['code' => 'tag']) }}">
                                    <span class="sidebar-mini-icon">CT</span>
                                    <span class="sidebar-normal"> Custom Code Tag </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</div>
