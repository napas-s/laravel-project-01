<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

use App\Models\TbCategory;
use App\Models\TbArticle;

class CategoryController extends Controller
{

    public function index()
    {

        $breadcrumb = [
            ['name' => 'หมวดหมู่บทความ'],
        ];

        return view('admin.category.main', [
            'breadcrumb' => $breadcrumb,
            'data' => '',
        ]);

    }

    public function add(){

        $breadcrumb = [
            ['name' => 'เพิ่มหมวดหมู่บทความ'],
        ];

        return view('admin.category.form', [
            'breadcrumb' => $breadcrumb,
            'data' => '',
        ]);

    }

    public function crate(Request $request){

        $request->validate(
            [
                'cat_name' => 'required|max:255',
                'cat_parmalink' => 'required|max:255|unique:tb_category',
            ],
            [
                'cat_name.required' => 'กรุณากรอกข้อมูล',
                'cat_name.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                'cat_parmalink.required' => 'กรุณากรอกข้อมูล',
                'cat_parmalink.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                'cat_parmalink.unique' => 'Parmalink นี้มีการใช้งานอยู่แล้ว กรุณาตรวจสอบข้อมูลอีกครั้ง',
             ]
        );

        if($request->cat_show == 'on'){
            $show = 1;
        }else{
            $show = 2;
        }

        $data = new TbCategory;
        $data->cat_name                 = $request->cat_name;
        $data->cat_parmalink            = $this->rewrite_url($request->cat_parmalink);
        $data->cat_show                 = $show;
        $data->cat_status               = $request->cat_status;
        $data->created_by               = Auth::user()->penname;
        $data->updated_by               = Auth::user()->penname;
        $data->created_at               = date('Y-m-d H:i:s');
        $data->updated_at               = date('Y-m-d H:i:s');
        $data->save();

        return redirect()->route('category.edit',[$data->id])->with('feedback', 'เพิ่มข้อมูลเรียบร้อยแล้ว!');

    }

    public function edit($id)
    {
        $breadcrumb = [
            ['name' => 'อัพเดตหมวดหมู่บทความ'],
        ];

        $data = TbCategory::findOrFail($id);

        return view('admin.category.form', [
            'breadcrumb' => $breadcrumb,
            'data' => $data,
        ]);
    }

    public function update(Request $request,$id){

        $request->validate(
            [
                'cat_name' => 'required|max:255',
                'cat_parmalink' => 'required|max:255|unique:tb_category,cat_parmalink,'.$id,
            ],
            [
                'cat_name.required' => 'กรุณากรอกข้อมูล',
                'cat_name.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                'cat_parmalink.required' => 'กรุณากรอกข้อมูล',
                'cat_parmalink.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                'cat_parmalink.unique' => 'Parmalink นี้มีการใช้งานอยู่แล้ว กรุณาตรวจสอบข้อมูลอีกครั้ง',
            ]
        );

        if($request->cat_status == 2){
            //เช็คว่า Id นี้ cat_status == 2
            $check = TbCategory::where('cat_status',2)->where('id',$id)->count();

            if($check != 0){
                //มีข้อมูล
                $count = TbCategory::where('cat_status',2)->count();

                if($count == 3){
                    //เช็คก่อนว่า id ที่รับมาเป็น cat_status == 2 ไหม?
                    $list = TbCategory::where('cat_status',2)->where('id',$id)->count();

                    if($list == 1){
                        //count id ที่ได้รับมาแล้วมีค่า
                        $count_nodate = TbCategory::where('cat_status',2)->where('id','!=', $id)->count();

                        if($count_nodate == 2){

                            //ไม่มีข้อมูล
                            if($request->cat_show == 'on'){
                                $show = 1;
                            }else{
                                $show = 2;
                            }

                            $data = TbCategory::findOrFail($id);

                            $data->cat_name                     = $request->cat_name;
                            $data->cat_parmalink                = $this->rewrite_url($request->cat_parmalink);
                            $data->cat_show                     = $show;
                            $data->cat_status                   = $request->cat_status;
                            $data->updated_by                   = Auth::user()->penname;
                            $data->updated_at                   = date('Y-m-d');
                            $data->save();

                            return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');

                        }else{

                            return back()->with('feedback-er', 'อัพเดตข้อมูลไม่สำเร็จ!');
                        }


                    }else{
                        //count ไม่เท่ากับ id ที่ได้รับมา
                        return back()->with('feedback-er', 'อัพเดตข้อมูลไม่สำเร็จ!');
                    }

                }else{

                    //ไม่มีข้อมูล
                    if($request->cat_show == 'on'){
                        $show = 1;
                    }else{
                        $show = 2;
                    }

                    $data = TbCategory::findOrFail($id);

                    $data->cat_name                     = $request->cat_name;
                    $data->cat_parmalink                = $this->rewrite_url($request->cat_parmalink);
                    $data->cat_show                     = $show;
                    $data->cat_status                   = $request->cat_status;
                    $data->updated_by                   = Auth::user()->penname;
                    $data->updated_at                   = date('Y-m-d');
                    $data->save();

                    return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');

                }

            }else{

                $count = TbCategory::where('cat_status',2)->count();
                if($count == 3){
                    return back()->with('feedback-er', 'อัพเดตข้อมูลไม่สำเร็จ!');
                }else{

                    //ไม่มีข้อมูล
                    if($request->cat_show == 'on'){
                        $show = 1;
                    }else{
                        $show = 2;
                    }

                    $data = TbCategory::findOrFail($id);

                    $data->cat_name                     = $request->cat_name;
                    $data->cat_parmalink                = $this->rewrite_url($request->cat_parmalink);
                    $data->cat_show                     = $show;
                    $data->cat_status                   = $request->cat_status;
                    $data->updated_by                   = Auth::user()->penname;
                    $data->updated_at                   = date('Y-m-d');
                    $data->save();

                    return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');

                }
            }
        }else{

            //ไม่มีข้อมูล
            if($request->cat_show == 'on'){
                $show = 1;
            }else{
                $show = 2;
            }

            $data = TbCategory::findOrFail($id);

            $data->cat_name                     = $request->cat_name;
            $data->cat_parmalink                = $this->rewrite_url($request->cat_parmalink);
            $data->cat_show                     = $show;
            $data->cat_status                   = $request->cat_status;
            $data->updated_by                   = Auth::user()->penname;
            $data->updated_at                   = date('Y-m-d');
            $data->save();

            return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');

        }

    }

    public function status($id){

        $data = TbCategory::findOrFail($id);

        if($data->cat_show == 2){
            $status = 1;
        }elseif($data->cat_show == 1) {
            $status = 2;
        }

        $data->cat_show                     = $status;
        $data->updated_by                   = Auth::user()->penname;
        $data->updated_at                   = date('Y-m-d');
        $data->save();

        return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');
    }

    public function delete(Request $request){


        $check = TbArticle::whereIn('art_cat', [$request->deleteId])->count();

        if(!empty($check)){

            return back()->with('feedback-er', 'ลบข้อมูลไม่สำเร็จ!');

        }else{
            TbCategory::where('id', $request->deleteId)->delete();
            return back()->with('feedback', 'ลบข้อมูลเรียบร้อยแล้ว!');
        }

    }

    public function jsondata()
    {

        $data = TbCategory::get();

        return Datatables::of($data)
                ->addColumn('title', function ($data) {
                    return $data->cat_name;
                })
                ->addColumn('permalink', function ($data) {
                    return '<a href="'.route('fronend.category.index',$data->cat_parmalink).'" target="_bank">'.$data->cat_parmalink.'</a>';

                })
                ->addColumn('status', function ($data) {
                    return $data->cat_status;
                })
                ->addColumn('show', function ($data) {
                    return $data->cat_show;
                })
                ->addColumn('actions', function ($data) {
                    $id = $data->id;
                    $name = $data->cat_name;
                    $status = $data->cat_show;
                    return view('admin.category.button', compact('id','status','name'));
                })
                ->escapeColumns([])
                ->addIndexColumn()
                ->make(true);
    }

    private function rewrite_url($url){
        $str_replace = strtolower(str_replace(" ","-",$url));
        $data = preg_replace('/[^a-zA-Z0-9\_\- ]/i', '', $str_replace);
        return $data ;
    }

}
