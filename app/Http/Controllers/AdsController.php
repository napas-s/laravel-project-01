<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

use App\Models\TbAd;
use App\Models\TbSettingAd;

class AdsController extends Controller
{

    public function index()
    {

        $breadcrumb = [
            ['name' => 'ตั้งค่าโฆษณา'],
        ];

        $data = TbSettingAd::first();

        return view('admin.ads.setting', [
            'breadcrumb' => $breadcrumb,
            'data' => $data,
        ]);

    }

    public function crate(Request $request){

        if($request->set_head_show == 'on'){
            $show_head = 1;
        }else{
            $show_head = 2;
        }
        if($request->set_banner_show == 'on'){
            $show_banner = 1;
        }else{
            $show_banner = 2;
        }
        if($request->set_right1_show == 'on'){
            $show_right1 = 1;
        }else{
            $show_right1 = 2;
        }

        $data = new TbSettingAd;
        $data->set_head_show            = $show_head;
        $data->set_banner_show          = $show_banner;
        $data->set_right1_show          = $show_right1;
        $data->created_by               = Auth::user()->penname;
        $data->updated_by               = Auth::user()->penname;
        $data->created_at               = date('Y-m-d H:i:s');
        $data->updated_at               = date('Y-m-d H:i:s');
        $data->save();

        return back()->with('feedback', 'เพิ่มข้อมูลเรียบร้อยแล้ว!');

    }

    public function update(Request $request,$id){

        if($request->set_head_show == 'on'){
            $show_head = 1;
        }else{
            $show_head = 2;
        }
        if($request->set_banner_show == 'on'){
            $show_banner = 1;
        }else{
            $show_banner = 2;
        }
        if($request->set_right1_show == 'on'){
            $show_right1 = 1;
        }else{
            $show_right1 = 2;
        }

        $data = TbSettingAd::findOrFail($id);
        $data->set_head_show            = $show_head;
        $data->set_banner_show          = $show_banner;
        $data->set_right1_show          = $show_right1;
        $data->updated_by               = Auth::user()->penname;
        $data->updated_at               = date('Y-m-d H:i:s');
        $data->save();

        return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');

    }

}
