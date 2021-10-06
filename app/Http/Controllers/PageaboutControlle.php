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

use App\Models\TbPage;

class PageaboutControlle extends Controller
{

    public function index()
    {

        $breadcrumb = [
            ['name' => 'เกี่ยวกับเรา'],
        ];

        $data = TbPage::where('page_parmalink','about')->first();

        return view('admin.pages.about.form', [
            'breadcrumb' => $breadcrumb,
            'data' => $data,
        ]);

    }

    public function crate(Request $request){

        if($request->page_show == 'on'){
            $show = 1;
        }else{
            $show = 2;
        }

        $data = new TbPage;
        $data->page_detail                  = $request->page_detail;
        $data->page_seo_detail              = $request->page_seo_detail;
        $data->page_parmalink               = 'about';
        $data->page_show                    = $show;
        $data->created_by                   = Auth::user()->penname;
        $data->updated_by                   = Auth::user()->penname;
        $data->created_at                   = date('Y-m-d H:i:s');
        $data->updated_at                   = date('Y-m-d H:i:s');
        $data->save();

        return back()->with('feedback', 'เพิ่มข้อมูลเรียบร้อยแล้ว!');
    }


    public function update(Request $request,$id){

        if($request->page_show == 'on'){
            $show = 1;
        }else{
            $show = 2;
        }

        $data = TbPage::findOrfail($id);
        $data->page_detail                  = $request->page_detail;
        $data->page_seo_detail              = $request->page_seo_detail;
        $data->page_parmalink               = 'about';
        $data->page_show                    = $show;
        $data->updated_by                   = Auth::user()->penname;
        $data->updated_at                   = date('Y-m-d');
        $data->save();

        return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');

    }


}
