<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

use App\Models\TbBanner;
use App\Models\TbArticle;
use App\Models\TbSetting;
use App\Models\TbCategory;
use App\Models\TbAd;
use App\Models\TbSettingAd;
use App\Models\User;
use App\Models\TbPage;
use App\Models\LogTag;
use App\Models\TbExtension;

class FontendController extends Controller
{

    public function index(){

        $setting                = TbSetting::first();
        $article_lasts          = TbArticle::orderBy('created_at','desc')->where('art_show',1)->limit(6)->get();
        $article_views          = TbArticle::orderBy('art_view','desc')->where('art_show',1)->limit(6)->get();
        $article_recommends     = TbArticle::where('art_recommend',1)->where('art_show',1)->orderBy('updated_at','desc')->limit(6)->get();
        $banners                = TbBanner::where('banner_show',1)->orderBy('banner_sort','desc')->get();
        $ads_head_get           = TbAd::whereIn('ads_display',array(1,4))->where('ads_show',1)->where('ads_position',1)->orderBy('ads_sort','desc')->get();
        $ads_banner_get         = TbAd::whereIn('ads_display',array(1,4))->where('ads_show',1)->where('ads_position',2)->orderBy('ads_sort','desc')->get();
        $ads_right1_get         = TbAd::whereIn('ads_display',array(1,4))->where('ads_show',1)->where('ads_position',3)->orderBy('ads_sort','desc')->get();
        $setting_ads            = TbSettingAd::first();
        $extension              = TbExtension::first();

        if(!empty($setting)){
            $art_thumb              = asset('storage/setting/'.$setting->setting_logoWeb);
            $og_title               = $setting->setting_nameWeb;
            $og_description         = $setting->setting_detail;
            $og_keywords            = $setting->setting_keyword;
            $og_url                 = route('fronend.home');
            $og_site_name           = $setting->setting_nameWeb;
        }else{
            $art_thumb              = asset('storage/setting/'.$setting->setting_logoWeb);
            $og_title               = $setting->setting_nameWeb;
            $og_description         = $setting->setting_detail;
            $og_keywords            = $setting->setting_keyword;
            $og_url                 = route('fronend.home');
            $og_site_name           = $setting->setting_nameWeb;
        }

        return view('fontend.main', [
            'setting'               => $setting,
            'banners'               => $banners,
            'article_lasts'         => $article_lasts,
            'article_views'         => $article_views,
            'article_recommends'    => $article_recommends,
            'ads_head_get'          => $ads_head_get,
            'ads_banner_get'        => $ads_banner_get,
            'ads_right1_get'        => $ads_right1_get,
            'setting_ads'           => $setting_ads,
            'extension'             => $extension,
            'art_thumb'             => $art_thumb,
            'og_title'              => $og_title,
            'og_title'              => $og_title,
            'og_description'        => $og_description,
            'og_keywords'           => $og_keywords,
            'og_url'                => $og_url,
            'og_site_name'          => $og_site_name,
        ]);

    }

    public function category($parmalink){

        $setting                = TbSetting::first();
        $banners                = TbBanner::where('banner_show',1)->orderBy('banner_sort','desc')->get();
        $ads_head_get           = TbAd::whereIn('ads_display',array(2,4))->where('ads_show',1)->where('ads_position',1)->orderBy('ads_sort','desc')->get();
        $ads_right1_get         = TbAd::whereIn('ads_display',array(2,4))->where('ads_show',1)->where('ads_position',3)->orderBy('ads_sort','desc')->get();
        $setting_ads            = TbSettingAd::first();
        $name_category          = TbCategory::where('cat_parmalink',$parmalink)->where('cat_show',1)->first();
        $extension              = TbExtension::first();

        if(!empty($name_category)){
            $article_get            = TbArticle::whereIn('art_cat',array($name_category->id))->where('art_show',1)->orderBy('updated_at','desc')->paginate(10);
            $art_thumb              = asset('storage/setting/'.$setting->setting_logoWeb);
            $og_title               = $name_category->cat_name;
            $og_description         = $setting->setting_detail;
            $og_keywords            = $setting->setting_keyword;
            $og_url                 = route('fronend.category.index',$parmalink);
            $og_site_name           = $name_category->cat_name;
        }else{
            $article_get            = '';
            $art_thumb              = asset('storage/setting/'.$setting->setting_logoWeb);
            $og_title               = $parmalink;
            $og_description         = $setting->setting_detail;
            $og_keywords            = $setting->setting_keyword;
            $og_url                 = route('fronend.category.index',$parmalink);
            $og_site_name           = $parmalink;
        }

        return view('fontend.category', [
            'setting'               => $setting,
            'banners'               => $banners,
            'ads_head_get'          => $ads_head_get,
            'ads_right1_get'        => $ads_right1_get,
            'setting_ads'           => $setting_ads,
            'article_get'           => $article_get,
            'extension'             => $extension,
            'name_category'         => $og_title,
            'parmalink'             => $parmalink,
            'art_thumb'             => $art_thumb,
            'og_title'              => $og_title,
            'og_title'              => $og_title,
            'og_description'        => $og_description,
            'og_keywords'           => $og_keywords,
            'og_url'                => $og_url,
            'og_site_name'          => $og_site_name,
        ]);

    }

    public function tag(){

        $setting                = TbSetting::first();
        $banners                = TbBanner::where('banner_show',1)->orderBy('banner_sort','desc')->get();
        $ads_head_get           = TbAd::whereIn('ads_display',array(2,4))->where('ads_show',1)->where('ads_position',1)->orderBy('ads_sort','desc')->get();
        $ads_right1_get         = TbAd::whereIn('ads_display',array(2,4))->where('ads_show',1)->where('ads_position',3)->orderBy('ads_sort','desc')->get();
        $setting_ads            = TbSettingAd::first();
        $log_tags               = LogTag::first();
        $extension              = TbExtension::first();

        if(!empty($log_tags)){

            $tags = explode(",",$log_tags->value);
            asort($tags);
            $art_thumb              = asset('storage/setting/'.$setting->setting_logoWeb);
            $og_title               = 'ค้นหาจาก Tag';
            $og_description         = $setting->setting_detail;
            $og_keywords            = $setting->setting_keyword;
            $og_url                 = route('fronend.tag');
            $og_site_name           = 'ค้นหาจาก Tag';
        }else{
            $tags                   = '';
            $art_thumb              = asset('storage/setting/'.$setting->setting_logoWeb);
            $og_title               = 'ค้นหาจาก Tag';
            $og_description         = $setting->setting_detail;
            $og_keywords            = $setting->setting_keyword;
            $og_url                 = route('fronend.tag');
            $og_site_name           = 'ค้นหาจาก Tag';
        }

        return view('fontend.tag', [
            'setting'               => $setting,
            'banners'               => $banners,
            'ads_head_get'          => $ads_head_get,
            'ads_right1_get'        => $ads_right1_get,
            'setting_ads'           => $setting_ads,
            'log_tags'              => $tags,
            'name_category'         => $og_title,
            'parmalink'             => 'fronend.tag',
            'extension'             => $extension,
            'art_thumb'             => $art_thumb,
            'og_title'              => $og_title,
            'og_title'              => $og_title,
            'og_description'        => $og_description,
            'og_keywords'           => $og_keywords,
            'og_url'                => $og_url,
            'og_site_name'          => $og_site_name,
        ]);

    }

    public function tagsearch($parmalink){

        $setting                = TbSetting::first();
        $banners                = TbBanner::where('banner_show',1)->orderBy('banner_sort','desc')->get();
        $ads_head_get           = TbAd::whereIn('ads_display',array(2,4))->where('ads_show',1)->where('ads_position',1)->orderBy('ads_sort','desc')->get();
        $ads_right1_get         = TbAd::whereIn('ads_display',array(2,4))->where('ads_show',1)->where('ads_position',3)->orderBy('ads_sort','desc')->get();
        $setting_ads            = TbSettingAd::first();
        $check                  = TbArticle::orWhere('art_keyword', 'LIKE', '%' . $parmalink . '%')->where('art_show',1)->orderBy('updated_at','desc')->count();
        $extension              = TbExtension::first();

        if($check != 0){
            $article_get            = TbArticle::orWhere('art_keyword', 'LIKE','%'.$parmalink.'%')->where('art_show',1)->orderBy('updated_at','desc')->paginate(10);
            $art_thumb              = asset('storage/setting/'.$setting->setting_logoWeb);
            $og_title               = $parmalink;
            $og_description         = $setting->setting_detail;
            $og_keywords            = $setting->setting_keyword;
            $og_url                 = route('fronend.search.tag',$parmalink);
            $og_site_name           = $parmalink;
        }else{
            $article_get            = '';
            $art_thumb              = asset('storage/setting/'.$setting->setting_logoWeb);
            $og_title               = $parmalink;
            $og_description         = $setting->setting_detail;
            $og_keywords            = $setting->setting_keyword;
            $og_url                 = route('fronend.search.tag',$parmalink);
            $og_site_name           = $parmalink;
        }

        return view('fontend.category', [
            'setting'               => $setting,
            'banners'               => $banners,
            'ads_head_get'          => $ads_head_get,
            'ads_right1_get'        => $ads_right1_get,
            'setting_ads'           => $setting_ads,
            'article_get'           => $article_get,
            'extension'             => $extension,
            'name_category'         => $parmalink,
            'parmalink'             => $parmalink,
            'art_thumb'             => $art_thumb,
            'og_title'              => $og_title,
            'og_title'              => $og_title,
            'og_description'        => $og_description,
            'og_keywords'           => $og_keywords,
            'og_url'                => $og_url,
            'og_site_name'          => $og_site_name,
        ]);

    }

    public function search(Request $request){

        $setting                = TbSetting::first();
        $banners                = TbBanner::where('banner_show',1)->orderBy('banner_sort','desc')->get();
        $ads_head_get           = TbAd::whereIn('ads_display',array(2,4))->where('ads_show',1)->where('ads_position',1)->orderBy('ads_sort','desc')->get();
        $ads_right1_get         = TbAd::whereIn('ads_display',array(2,4))->where('ads_show',1)->where('ads_position',3)->orderBy('ads_sort','desc')->get();
        $setting_ads            = TbSettingAd::first();
        $check                  = TbArticle::orWhere('art_name', 'LIKE', '%' . $request->search . '%')->where('art_show',1)->orderBy('updated_at','desc')->count();
        $extension              = TbExtension::first();

        if($check != 0){
            $article_get            = TbArticle::orWhere('art_name', 'LIKE', '%' . $request->search . '%')->where('art_show',1)->orderBy('updated_at','desc')->paginate(10);
            $art_thumb              = asset('storage/setting/'.$setting->setting_logoWeb);
            $og_title               = $request->search;
            $og_description         = $setting->setting_detail;
            $og_keywords            = $setting->setting_keyword;
            $og_url                 = route('fronend.search',$request->search);
            $og_site_name           = $request->search;
        }else{
            $article_get            = '';
            $art_thumb              = asset('storage/setting/'.$setting->setting_logoWeb);
            $og_title               = $request->search;
            $og_description         = $setting->setting_detail;
            $og_keywords            = $setting->setting_keyword;
            $og_url                 = route('fronend.search',$request->search);
            $og_site_name           = $request->search;
        }

        return view('fontend.category', [
            'setting'               => $setting,
            'banners'               => $banners,
            'ads_head_get'          => $ads_head_get,
            'ads_right1_get'        => $ads_right1_get,
            'setting_ads'           => $setting_ads,
            'article_get'           => $article_get,
            'extension'             => $extension,
            'name_category'         => $request->search,
            'parmalink'             => $request->search,
            'art_thumb'             => $art_thumb,
            'og_title'              => $og_title,
            'og_title'              => $og_title,
            'og_description'        => $og_description,
            'og_keywords'           => $og_keywords,
            'og_url'                => $og_url,
            'og_site_name'          => $og_site_name,
        ]);

    }

    public function articles($parmalink){
        $setting                = TbSetting::first();
        $banners                = TbBanner::where('banner_show',1)->orderBy('banner_sort','desc')->get();
        $ads_head_get           = TbAd::whereIn('ads_display',array(3,4))->where('ads_show',1)->where('ads_position',1)->orderBy('ads_sort','desc')->get();
        $ads_right1_get         = TbAd::whereIn('ads_display',array(3,4))->where('ads_show',1)->where('ads_position',3)->orderBy('ads_sort','desc')->get();
        $setting_ads            = TbSettingAd::first();
        $check                  = TbArticle::where('art_parmalink',$parmalink)->where('art_show',1)->count();
        $extension              = TbExtension::first();

        if($check != 0){

            $this->update_view($parmalink);

            $article_get            = TbArticle::where('art_parmalink',$parmalink)->where('art_show',1)->orderBy('updated_at','desc')->first();
            $author                 = User::where('penname',$article_get->created_by)->where('status',1)->first();
            $art_thumb              = asset('storage/article/' . $article_get->art_thumb);
            $og_title               = $article_get->art_name;
            $og_description         = $article_get->art_seo_detail;
            $og_keywords            = $article_get->art_keyword;
            $og_url                 = route('fronend.articles.detail',$parmalink);
            $og_site_name           = $article_get->art_name;

        }else{
            $article_get            = '';
            $author                 = '';
            $art_thumb              = asset('assets/fontend/images/noImg/no-01.jpg');
            $og_title               = 'ไม่พบข้อมูล';
            $og_description         = 'ไม่พบข้อมูล';
            $og_keywords            = 'ไม่พบข้อมูล';
            $og_url                 = route('fronend.articles.detail',$parmalink);
            $og_site_name           = 'ไม่พบข้อมูล';
        }

        return view('fontend.article', [
            'setting'               => $setting,
            'banners'               => $banners,
            'ads_head_get'          => $ads_head_get,
            'ads_right1_get'        => $ads_right1_get,
            'setting_ads'           => $setting_ads,
            'article_get'           => $article_get,
            'extension'             => $extension,
            'name_category'         => '',
            'parmalink'             => $parmalink,
            'author'                => $author,
            'art_thumb'             => $art_thumb,
            'og_title'              => $og_title,
            'og_title'              => $og_title,
            'og_description'        => $og_description,
            'og_keywords'           => $og_keywords,
            'og_url'                => $og_url,
            'og_site_name'          => $og_site_name,
        ]);
    }

    public function recommend(){


        $setting                = TbSetting::first();
        $banners                = TbBanner::where('banner_show',1)->orderBy('banner_sort','desc')->get();
        $ads_head_get           = TbAd::whereIn('ads_display',array(2,4))->where('ads_show',1)->where('ads_position',1)->orderBy('ads_sort','desc')->get();
        $ads_right1_get         = TbAd::whereIn('ads_display',array(2,4))->where('ads_show',1)->where('ads_position',3)->orderBy('ads_sort','desc')->get();
        $setting_ads            = TbSettingAd::first();
        $check                  = TbArticle::where('art_recommend',1)->where('art_show',1)->orderBy('updated_at','desc')->count();
        $extension              = TbExtension::first();

        if($check != 0){
            $article_get            = TbArticle::where('art_recommend',1)->where('art_show',1)->orderBy('updated_at','desc')->paginate(10);
            $art_thumb              = asset('storage/setting/'.$setting->setting_logoWeb);
            $og_title               = 'บทความแนะนำ';
            $og_description         = $setting->setting_detail;
            $og_keywords            = $setting->setting_keyword;
            $og_url                 = route('fronend.articles.recommend');
            $og_site_name           = 'บทความแนะนำ';
        }else{
            $article_get            = '';
            $art_thumb              = asset('storage/setting/'.$setting->setting_logoWeb);
            $og_title               = 'บทความแนะนำ';
            $og_description         = $setting->setting_detail;
            $og_keywords            = $setting->setting_keyword;
            $og_url                 = route('fronend.articles.recommend');
            $og_site_name           = 'บทความแนะนำ';
        }

        return view('fontend.category', [
            'setting'               => $setting,
            'banners'               => $banners,
            'ads_head_get'          => $ads_head_get,
            'ads_right1_get'        => $ads_right1_get,
            'setting_ads'           => $setting_ads,
            'article_get'           => $article_get,
            'extension'             => $extension,
            'name_category'         => 'บทความแนะนำ',
            'parmalink'             => '',
            'art_thumb'             => $art_thumb,
            'og_title'              => $og_title,
            'og_title'              => $og_title,
            'og_description'        => $og_description,
            'og_keywords'           => $og_keywords,
            'og_url'                => $og_url,
            'og_site_name'          => $og_site_name,
        ]);

    }

    public function pages($parmalink){

        $setting                = TbSetting::first();
        $banners                = TbBanner::where('banner_show',1)->orderBy('banner_sort','desc')->get();
        $ads_head_get           = TbAd::whereIn('ads_display',array(3,4))->where('ads_show',1)->where('ads_position',1)->orderBy('ads_sort','desc')->get();
        $ads_right1_get         = TbAd::whereIn('ads_display',array(3,4))->where('ads_show',1)->where('ads_position',3)->orderBy('ads_sort','desc')->get();
        $setting_ads            = TbSettingAd::first();
        $check                  = TbPage::where('page_parmalink',$parmalink)->where('page_show',1)->count();
        $extension              = TbExtension::first();

        if($check != 0){

            $pages                  = TbPage::where('page_parmalink',$parmalink)->where('page_show',1)->orderBy('updated_at','desc')->first();
            $art_thumb              = asset('storage/setting/'.$setting->setting_logoWeb);
            $og_title               = $pages->page_parmalink;
            $og_description         = $setting->page_seo_detail;
            $og_keywords            = $setting->art_keyword;
            $og_url                 = route('fronend.page.detail',$parmalink);
            $og_site_name           = $pages->page_parmalink;

        }else{
            $pages                  = '';
            $art_thumb              = asset('storage/setting/'.$setting->setting_logoWeb);
            $og_title               = $setting->setting_nameWeb;
            $og_description         = $setting->setting_detail;
            $og_keywords            = $setting->setting_keyword;
            $og_url                 = route('fronend.page.detail',$parmalink);
            $og_site_name           = $setting->setting_nameWeb;
        }

        return view('fontend.page', [
            'setting'               => $setting,
            'banners'               => $banners,
            'ads_head_get'          => $ads_head_get,
            'ads_right1_get'        => $ads_right1_get,
            'setting_ads'           => $setting_ads,
            'extension'             => $extension,
            'pages'                 => $pages,
            'name_category'         => '',
            'parmalink'             => $parmalink,
            'art_thumb'             => $art_thumb,
            'og_title'              => $og_title,
            'og_title'              => $og_title,
            'og_description'        => $og_description,
            'og_keywords'           => $og_keywords,
            'og_url'                => $og_url,
            'og_site_name'          => $og_site_name,
        ]);

    }

    private function update_view($parmalink){

        $item                   = TbArticle::where('art_parmalink',$parmalink)->where('art_show',1)->first();

        $data                   = TbArticle::findOrfail($item->id);
        $data->art_view         = $item->art_view+1;
        $data->save();

    }

}
