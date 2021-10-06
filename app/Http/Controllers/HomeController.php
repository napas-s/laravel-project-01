<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TbCategory;
use App\Models\TbArticle;
use App\Models\TbAd;
use App\Models\User;
use App\Models\LogTag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $count_article      = TbArticle::count();
        $count_category     = TbCategory::count();
        $count_ads          = TbAd::count();
        $count_user         = User::where('email','!=','system@programmer.com')->count();
        $list_view          = TbArticle::select('art_parmalink','art_view','art_name','updated_by','updated_at')->orderBy('art_view','desc')->limit('10')->get();
        $list_log           = LogTag::first();

        return view('admin.dashboard',[
            'count_article' => $count_article,
            'count_category' => $count_category,
            'count_ads' => $count_ads,
            'count_user' => $count_user,
            'list_view' => $list_view,
            'list_log' => $list_log,
        ]);
    }
}
