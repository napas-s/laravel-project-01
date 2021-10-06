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
use App\Models\TbSettingDisplay;

class AdsrightController extends Controller
{

    public function index()
    {

        $breadcrumb = [
            ['name' => 'ตั้งค่าโฆษณา (ด้านข้าง)'],
        ];

        return view('admin.ads.right.main', [
            'breadcrumb' => $breadcrumb,
            'data' => '',
        ]);

    }

    public function add(){

        $breadcrumb = [
            ['name' => 'เพิ่มโฆษณา'],
        ];

        $displays = TbSettingDisplay::where('display_show',1)->get();

        return view('admin.ads.right.form', [
            'breadcrumb' => $breadcrumb,
            'data' => '',
            'displays' => $displays,
        ]);

    }

    public function crate(Request $request){

        if($request->ads_set_date_status == 2){
            $request->validate(
                [
                    'ads_img' => 'required',
                    'ads_name' => 'required|max:255',
                    'ads_display' => 'required',
                    'ads_set_date_status' => 'required',
                    'ads_set_date_start' => 'required',
                    'ads_set_date_end' => 'required',
                ],
                [
                    'ads_img.required' => 'กรุณาเลือกรูปภาพ',
                    'ads_name.required' => 'กรุณากรอกข้อมูล',
                    'ads_name.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                    'ads_display.required' => 'กรุณาเลือกข้อมูล',
                    'ads_set_date_status.required' => 'กรุณาเลือกข้อมูล',
                    'ads_set_date_start.required' => 'กรุณาเลือกข้อมูล',
                    'ads_set_date_end.required' => 'กรุณาเลือกข้อมูล',
                ]
            );
        }else{
            $request->validate(
                [
                    'ads_img' => 'required',
                    'ads_name' => 'required|max:255',
                    'ads_display' => 'required',
                    'ads_set_date_status' => 'required',
                ],
                [
                    'ads_img.required' => 'กรุณาเลือกรูปภาพ',
                    'ads_name.required' => 'กรุณากรอกข้อมูล',
                    'ads_name.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                    'ads_display.required' => 'กรุณาเลือกข้อมูล',
                    'ads_display.required' => 'กรุณาเลือกข้อมูล',
                ]
            );
        }

        if($request->ads_show == 'on'){
            $show = 1;
        }else{
            $show = 2;
        }
        if(!empty($request->ads_sort)){
            $sort = $request->ads_sort;
        }else{
            $sort = 0;
        }
        if($request->ads_display != ''){
			$ads_display = implode(",", $request->ads_display);
		} else {
			$ads_display = '';
		}

        $data = new TbAd;
        $data->ads_name                 = $request->ads_name;
        $data->ads_link                 = $request->ads_link;
        $data->ads_display              = $ads_display;
        $data->ads_set_date_status      = $request->ads_set_date_status;
        if($request->ads_set_date_status == 2){
            $data->ads_set_date_start   = date("Y-m-d",strtotime($request->ads_set_date_start));
            $data->ads_set_date_end     = date("Y-m-d",strtotime($request->ads_set_date_end));
        }else{
            $data->ads_set_date_start   = null;
            $data->ads_set_date_end     = null;
        }
        $data->ads_note                 = $request->ads_note;
        $data->ads_show                 = $show;
        $data->ads_sort                 = $sort;
        $data->ads_position             = 3;
        $data->created_by               = Auth::user()->penname;
        $data->updated_by               = Auth::user()->penname;
        $data->created_at               = date('Y-m-d H:i:s');
        $data->updated_at               = date('Y-m-d H:i:s');

        if (!empty($request->ads_img)) {

            if ($request->hasFile('ads_img')) {
                @unlink(Storage::disk('public')->path('ads_im/') . $request->ads_img_old);

                $newFilename = uniqid() . '.' . $request->ads_img->extension();
                $data->ads_img = $newFilename;
                $file = $request->file('ads_img');
                $file->move('storage/ads_im/', $newFilename);
            }

        }

        $data->save();

        return redirect()->route('ads.right.edit',[$data->id])->with('feedback', 'เพิ่มข้อมูลเรียบร้อยแล้ว!');

    }

    public function edit($id)
    {
        $breadcrumb = [
            ['name' => 'อัพเดตโฆษณา'],
        ];

        $data = TbAd::findOrFail($id);
        $displays = TbSettingDisplay::where('display_show',1)->get();

        return view('admin.ads.right.form', [
            'breadcrumb' => $breadcrumb,
            'data' => $data,
            'displays' => $displays,
        ]);
    }

    public function update(Request $request,$id){

        if($request->ads_set_date_status == 2){
            $request->validate(
                [
                    'ads_name' => 'required|max:255',
                    'ads_display' => 'required',
                    'ads_set_date_status' => 'required',
                    'ads_set_date_start' => 'required',
                    'ads_set_date_end' => 'required',
                ],
                [
                    'ads_name.required' => 'กรุณากรอกข้อมูล',
                    'ads_name.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                    'ads_display.required' => 'กรุณาเลือกข้อมูล',
                    'ads_set_date_status.required' => 'กรุณาเลือกข้อมูล',
                    'ads_set_date_start.required' => 'กรุณาเลือกข้อมูล',
                    'ads_set_date_end.required' => 'กรุณาเลือกข้อมูล',
                ]
            );
        }else{
            $request->validate(
                [
                    'ads_name' => 'required|max:255',
                    'ads_display' => 'required',
                    'ads_set_date_status' => 'required',
                ],
                [
                    'ads_name.required' => 'กรุณากรอกข้อมูล',
                    'ads_name.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                    'ads_display.required' => 'กรุณาเลือกข้อมูล',
                    'ads_display.required' => 'กรุณาเลือกข้อมูล',
                ]
            );
        }

        if($request->ads_show == 'on'){
            $show = 1;
        }else{
            $show = 2;
        }
        if(!empty($request->ads_sort)){
            $sort = $request->ads_sort;
        }else{
            $sort = 0;
        }
        if($request->ads_display != ''){
			$ads_display = implode(",", $request->ads_display);
		} else {
			$ads_display = '';
		}

        $data = TbAd::findOrFail($id);
        $data->ads_name                 = $request->ads_name;
        $data->ads_link                 = $request->ads_link;
        $data->ads_display              = $ads_display;
        $data->ads_set_date_status      = $request->ads_set_date_status;
        if($request->ads_set_date_status == 2){
            $data->ads_set_date_start   = date("Y-m-d",strtotime($request->ads_set_date_start));
            $data->ads_set_date_end     = date("Y-m-d",strtotime($request->ads_set_date_end));
        }else{
            $data->ads_set_date_start   = null;
            $data->ads_set_date_end     = null;
        }
        $data->ads_note                 = $request->ads_note;
        $data->ads_show                 = $show;
        $data->ads_sort                 = $sort;
        $data->ads_position             = 3;
        $data->updated_by               = Auth::user()->penname;
        $data->updated_at               = date('Y-m-d H:i:s');

        if (!empty($request->ads_img)) {

            if ($request->hasFile('ads_img')) {
                @unlink(Storage::disk('public')->path('ads_im/') . $request->ads_img_old);

                $newFilename = uniqid() . '.' . $request->ads_img->extension();
                $data->ads_img = $newFilename;
                $file = $request->file('ads_img');
                $file->move('storage/ads_im/', $newFilename);
            }

        }
        $data->save();

        return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');

    }

    public function status($id){

        $data = TbAd::findOrFail($id);

        if($data->ads_show == 2){
            $status = 1;
        }elseif($data->ads_show == 1) {
            $status = 2;
        }

        $data->ads_show                     = $status;
        $data->updated_by                   = Auth::user()->penname;
        $data->updated_at                   = date('Y-m-d');
        $data->save();

        return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');
    }

    public function delete(Request $request){

        $check = TbAd::findOrFail($request->deleteId);
        if(!empty($check)){
            @unlink(Storage::disk('public')->path('ads_im/') . $check->ads_img);
        }
        TbAd::where('id', $request->deleteId)->delete();
        return back()->with('feedback', 'ลบข้อมูลเรียบร้อยแล้ว!');

    }

    public function jsondata()
    {

        $data = TbAd::where('ads_position',3)->get();

        return Datatables::of($data)
                ->addColumn('ads_img', function ($data) {
                    if(!empty($data->ads_img)){
                        return '<img src="'.asset('storage/ads_im/'.$data->ads_img).'" alt="" class="table-width text-align-center" rel="nofollow">';
                    }else{
                        return '<img src="'.asset('assets/fontend/images/AdsB/ads_611_290.jpg').'" alt="..." class="table-width text-align-center" rel="nofollow">';
                    }
                })
                ->addColumn('ads_sort', function ($data) {
                    return $data->ads_sort;
                })
                ->addColumn('ads_show', function ($data) {
                    return $data->ads_show;
                })
                ->addColumn('updated', function ($data) {
                    return $data->updated_by.'<br/>'.$data->updated_at;
                })
                ->addColumn('actions', function ($data) {
                    $id = $data->id;
                    $status = $data->ads_show;
                    $name = $data->ads_img;
                    return view('admin.ads.right.button', compact('id','status','name'));
                })
                ->escapeColumns([])
                ->addIndexColumn()
                ->make(true);
    }

    public function getDisplay(){

        $result = TbSettingDisplay::where('display_show',1)->get();
        return $result;

    }

}
