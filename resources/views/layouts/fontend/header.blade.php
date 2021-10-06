<header id="header" class="dark">

    <div id="header-wrap">

        <div class="container clearfix">

            <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

            @php
                $setting_logo = App\Models\TbSetting::select('setting_logoWeb','setting_nameWeb')->first();
                if(!empty($setting_logo->setting_logoWeb)){
                    $logo = asset('storage/setting/'.$setting_logo->setting_logoWeb);
                }else{
                    $logo = asset('assets/fontend/images/noImg/no-01.jpg');
                }
            @endphp
            <div id="logo">
                <a href="{{ route('fronend.home') }}" class="standard-logo" data-dark-logo="{{ $logo }}"><img src="{{ $logo }}" alt="{{ $setting_logo->setting_nameWeb }}"></a>
                <a href="{{ route('fronend.home') }}" class="retina-logo" data-dark-logo="{{ $logo }}"><img src="{{ $logo }}" alt="{{ $setting_logo->setting_nameWeb }}"></a>
            </div>

            <nav id="primary-menu">
                @php
                    $menus = App\Models\TbCategory::where('cat_show',1)->where('cat_status',2)->get();
                @endphp
                @if(count($menus) != 0)
                    <ul>
                        @foreach ( $menus as $menu)
                        <li class="current"><a href="{{ route('fronend.category.index',$menu->cat_parmalink ) }}"><div>{{ $menu->cat_name }}</div></a></li>
                        @endforeach
                    </ul>
                @endif

                <div id="top-search">
                    <a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
                    {{
                        Form::open([
                            'novalidate',
                            'route' => 'fronend.search',
                            'id'=>'data-form',
                            'method' => 'get',
                            'files' => true
                        ])
                    }}
                        <input type="text" id="search" name="search" class="form-control" value="" placeholder="ค้นหา..">
                    </form>
                </div>

            </nav>

        </div>

    </div>

</header>
