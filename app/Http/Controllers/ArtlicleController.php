<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Models\TbCategory;
use App\Models\TbArticle;
use App\Models\LogTag;
use App\Models\TbBanner;
use App\Models\TbAd;
use App\Models\TbSettingAd;
use App\Models\TbSetting;
use App\Models\User;

class ArtlicleController extends Controller
{

    public function index()
    {

        $breadcrumb = [
            ['name' => 'บทความ'],
        ];

        $article   = TbArticle::where('art_show',1)->count();

        return view('admin.artlicle.main', [
            'breadcrumb' => $breadcrumb,
            'data' => '',
            'article' => $article,
        ]);

    }

    public function add(){

        $breadcrumb = [
            ['name' => 'เพิ่มบทความ'],
        ];

        $categorys = TbCategory::where('cat_show',1)->get();

        return view('admin.artlicle.form', [
            'breadcrumb' => $breadcrumb,
            'categorys' => $categorys,
            'data' => '',
        ]);

    }

    public function crate(Request $request){

        $request->validate(
            [
                'art_name' => 'required|max:255',
                'art_parmalink' => 'required|max:255|unique:tb_article',
                'art_cat' => 'required',
            ],
            [
                'art_name.required' => 'กรุณากรอกข้อมูล',
                'art_name.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                'art_cat.required' => 'กรุณาเลือกข้อมูล',
                'art_parmalink.required' => 'กรุณากรอกข้อมูล',
                'art_parmalink.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                'art_parmalink.unique' => 'Parmalink นี้มีการใช้งานอยู่แล้ว กรุณาตรวจสอบข้อมูลอีกครั้ง',
            ]
        );

        if($request->art_show == 'on'){
            $show = 1;
        }else{
            $show = 2;
        }

        if($request->art_author == 'on'){
            $author = 1;
        }else{
            $author = 2;
        }

        if($request->art_keyword != ''){
			$art_keyword = implode(",", $request->art_keyword);
		} else {
			$art_keyword = '';
		}

        if($request->art_cat != ''){
			$art_cat = implode(",", $request->art_cat);
		} else {
			$art_cat = '';
		}

        if($request->art_recommend != ''){
			$art_recommend = 1;
		} else {
			$art_recommend = 2;
		}

        $data = new TbArticle;
        $data->art_name                 = $request->art_name;
        $data->art_keyword              = $art_keyword;
        $data->art_detail               = $request->art_detail;
        $data->art_author               = $author;
        $data->art_cat                  = $art_cat;
        $data->art_seo_detail           = $request->art_seo_detail;
        $data->art_parmalink            = $this->rewrite_url($request->art_parmalink);
        $data->art_show                 = $show;
        $data->art_recommend            = $art_recommend;
        $data->created_by               = Auth::user()->penname;
        $data->updated_by               = Auth::user()->penname;
        $data->created_at               = date('Y-m-d H:i:s');
        $data->updated_at               = date('Y-m-d H:i:s');

        if (!empty($request->art_thumb)) {

            if ($request->hasFile('art_thumb')) {
                @unlink(Storage::disk('public')->path('article/') . $request->art_thumb_old);

                $newFilename = uniqid() . '.' . $request->art_thumb->extension();
                $data->art_thumb = $newFilename;
                $file = $request->file('art_thumb');
                $file->move('storage/article/', $newFilename);
            }

        }

        $data->save();

        $log = LogTag::first();
        $articleTags = explode(",",$log->value);
        $TagNew = explode(",",$art_keyword);

        $totalArray	=	array_merge($articleTags,$TagNew);//รวม array
        $setlog	=	array_unique($totalArray);//ลบ array ที่ซ้ำออก เลือกแค่ 1

        $setlogBase = implode(",", $setlog);

        $loh_history        = LogTag::first();
        $loh_history->value = $setlogBase;
        $loh_history->save();

        return redirect()->route('artlicle.edit',[$data->id])->with('feedback', 'เพิ่มข้อมูลเรียบร้อยแล้ว!');

    }

    public function edit($id)
    {
        $breadcrumb = [
            ['name' => 'อัพเดตบทความ'],
        ];

        $data = TbArticle::findOrFail($id);
        $categorys = TbCategory::where('cat_show',1)->get();

        return view('admin.artlicle.form', [
            'breadcrumb' => $breadcrumb,
            'data' => $data,
            'categorys' => $categorys,
        ]);
    }

    public function update(Request $request,$id){

        $request->validate(
            [
                'art_name' => 'required|max:255',
                'art_parmalink' => 'required|max:255|unique:tb_article,art_parmalink,'.$id,
                'art_cat' => 'required',
            ],
            [
                'art_name.required' => 'กรุณากรอกข้อมูล',
                'art_name.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                'art_cat.required' => 'กรุณาเลือกข้อมูล',
                'art_parmalink.required' => 'กรุณากรอกข้อมูล',
                'art_parmalink.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                'art_parmalink.unique' => 'Parmalink นี้มีการใช้งานอยู่แล้ว กรุณาตรวจสอบข้อมูลอีกครั้ง',
            ]
        );

        if($request->art_show == 'on'){
            $show = 1;
        }else{
            $show = 2;
        }

        if($request->art_author == 'on'){
            $author = 1;
        }else{
            $author = 2;
        }

        if($request->art_keyword != ''){
			$art_keyword = implode(",", $request->art_keyword);
		} else {
			$art_keyword = '';
		}

        if($request->art_cat != ''){
			$art_cat = implode(",", $request->art_cat);
		} else {
			$art_cat = '';
		}

        if($request->art_recommend != ''){
			$art_recommend = 1;
		} else {
			$art_recommend = 2;
		}

        $data = TbArticle::findOrfail($id);
        $data->art_name                 = $request->art_name;
        $data->art_keyword              = $art_keyword;
        $data->art_detail               = $request->art_detail;
        $data->art_author               = $author;
        $data->art_cat                  = $art_cat;
        $data->art_seo_detail           = $request->art_seo_detail;
        $data->art_parmalink            = $this->rewrite_url($request->art_parmalink);
        $data->art_show                 = $show;
        $data->art_recommend            = $art_recommend;
        $data->updated_by               = Auth::user()->penname;
        $data->updated_at               = date('Y-m-d');

        if (!empty($request->art_thumb)) {

            if ($request->hasFile('art_thumb')) {
                @unlink(Storage::disk('public')->path('article/') . $request->art_thumb_old);

                $newFilename = uniqid() . '.' . $request->art_thumb->extension();
                $data->art_thumb = $newFilename;
                $file = $request->file('art_thumb');
                $file->move('storage/article/', $newFilename);
            }

        }

        $data->save();

        $log = LogTag::first();
        $articleTags = explode(",",$log->value);
        $TagNew = explode(",",$art_keyword);

        $totalArray	=	array_merge($articleTags,$TagNew);//รวม array
        $setlog	=	array_unique($totalArray);//ลบ array ที่ซ้ำออก เลือกแค่ 1

        $setlogBase = implode(",", $setlog);

        $loh_history        = LogTag::first();
        $loh_history->value = $setlogBase;
        $loh_history->save();

        return back()->with('feedback', 'เพิ่มข้อมูลเรียบร้อยแล้ว!');

    }

    public function jsondata()
    {

        $data = TbArticle::select('id','art_name','art_keyword','art_show','created_at','created_by','updated_at','updated_by','art_parmalink')->get();

        return Datatables::of($data)
                ->addColumn('art_name', function ($data) {
                    return '<a href="'.route('artlicle.preview',$data->art_parmalink).'" target="_bank">'.$data->art_name.'</a>';
                })
                ->addColumn('art_keyword', function ($data) {
                    return $data->art_keyword;
                })
                ->addColumn('art_show', function ($data) {
                    return $data->art_show;
                })
                ->addColumn('crated', function ($data) {
                    return $data->created_at.'<br/><small><i class="fa fa-user"></i> '.$data->created_by.'</small>';
                })
                ->addColumn('updated', function ($data) {
                    return $data->updated_at.'<br/><small><i class="fa fa-user"></i> '.$data->updated_by.'</small>';
                })
                ->addColumn('actions', function ($data) {
                    $id = $data->id;
                    $name = $data->art_name;
                    $status = $data->art_show;
                    return view('admin.artlicle.button', compact('id','status','name'));
                })
                ->escapeColumns([])
                ->addIndexColumn()
                ->make(true);
    }

    public function status($id){

        $data = TbArticle::findOrFail($id);

        if($data->art_show == 2){
            $status = 1;
        }elseif($data->art_show == 1) {
            $status = 2;
        }

        $data->art_show                     = $status;
        $data->updated_by                   = Auth::user()->penname;
        $data->updated_at                   = date('Y-m-d');
        $data->save();

        return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');
    }

    public function delete(Request $request){

        $check = TbArticle::findOrFail($request->deleteId);
        if(!empty($check)){
            @unlink(Storage::disk('public')->path('article/') . $check->art_thumb);
        }

        TbArticle::where('id', $request->deleteId)->delete();
        return back()->with('feedback', 'ลบข้อมูลเรียบร้อยแล้ว!');

    }

    public function getCat(){

        $categorys = TbCategory::where('cat_show',1)->get();
        return $categorys;

    }

    public function random(Request $request){

        $TbArticle = TbArticle::select('art_cat','art_name','art_parmalink','art_seo_detail','art_show','art_thumb')
        ->where('art_show',1)
        ->inRandomOrder()
        ->limit(10)
        ->get();

        foreach($TbArticle as $data){

            if(!empty($data->art_thumb)){
                $img = asset('storage/article/'.$data->art_thumb);
            }else{
                $img = asset('images/default-img/no-img.jpg');
            }

            $result[] = array(
                'art_name' => $data->art_name,
                'art_parmalink' => route('fronend.articles.detail',$data->art_parmalink),
                'art_seo_detail' => $data->art_seo_detail,
                'art_thumb' => $img,
            );
        }

        return $result;
    }

    public function preview($parmalink){
        $setting                = TbSetting::first();
        $banners                = TbBanner::where('banner_show',1)->orderBy('banner_sort','desc')->get();
        $ads_head_get           = TbAd::whereIn('ads_display',array(3,4))->where('ads_show',1)->where('ads_position',1)->orderBy('ads_sort','desc')->get();
        $ads_right1_get         = TbAd::whereIn('ads_display',array(3,4))->where('ads_show',1)->where('ads_position',3)->orderBy('ads_sort','desc')->get();
        $setting_ads            = TbSettingAd::first();
        $check                  = TbArticle::where('art_parmalink',$parmalink)->count();

        if($check != 0){

            $article_get            = TbArticle::where('art_parmalink',$parmalink)->orderBy('updated_at','desc')->first();
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
            'extension'             => '',
        ]);
    }

    public function search(Request $request){

        $TbArticle = TbArticle::select('art_name','art_parmalink','art_seo_detail','art_show','art_thumb')
        ->orWhere('art_name', 'LIKE', '%' . $request->keyword . '%')
        ->orWhere('art_parmalink', 'LIKE', '%' . $request->keyword . '%')
        ->where('art_show',1)
        ->inRandomOrder()
        ->limit(10)
        ->get();

        if(count($TbArticle ) != 0){
            foreach($TbArticle as $data){

                if(!empty($data->art_thumb)){
                    $img = asset('storage/article/'.$data->art_thumb);
                }else{
                    $img = asset('images/default-img/no-img.jpg');
                }

                $result[] = array(
                    'art_name' => $data->art_name,
                    'art_parmalink' => route('fronend.articles.detail',$data->art_parmalink),
                    'art_seo_detail' => $data->art_seo_detail,
                    'art_thumb' => $img,
                );
            }

            return $result;
        }else{
            return [];
        }
    }

    private function rewrite_url($url){
        $str_replace = strtolower(str_replace(" ","-",$url));
        $data = preg_replace('/[^a-z0-9\_\- ]/i', '', $str_replace);
        return $data ;
    }

}
