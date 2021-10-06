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

class BannerController extends Controller
{

    public function index()
    {

        $breadcrumb = [
            ['name' => 'แบรนเนอร์'],
        ];

        return view('admin.banner.main', [
            'breadcrumb' => $breadcrumb,
            'data' => '',
        ]);

    }

    public function add(){

        $breadcrumb = [
            ['name' => 'เพิ่มแบรนเนอร์'],
        ];

        return view('admin.banner.form', [
            'breadcrumb' => $breadcrumb,
            'data' => '',
        ]);

    }

    public function crate(Request $request){

        $request->validate(
            [
                'banner_img' => 'required',
            ],
            [
                'banner_img.required' => 'กรุณาเลือกรูปภาพ',
            ]
        );

        if($request->banner_show == 'on'){
            $show = 1;
        }else{
            $show = 2;
        }
        if(!empty($request->banner_sort)){
            $sort = $request->banner_sort;
        }else{
            $sort = 0;
        }

        $data = new TbBanner;
        $data->banner_link              = $request->banner_link;
        $data->banner_show              = $show;
        $data->banner_sort              = $sort;
        $data->created_by               = Auth::user()->penname;
        $data->updated_by               = Auth::user()->penname;
        $data->created_at               = date('Y-m-d H:i:s');
        $data->updated_at               = date('Y-m-d H:i:s');

        if (!empty($request->banner_img)) {

            if ($request->hasFile('banner_img')) {
                @unlink(Storage::disk('public')->path('banner/') . $request->banner_img_old);

                $newFilename = uniqid() . '.' . $request->banner_img->extension();
                $data->banner_img = $newFilename;
                $file = $request->file('banner_img');
                $file->move('storage/banner/', $newFilename);
            }

        }

        $data->save();

        return redirect()->route('banner.edit',[$data->id])->with('feedback', 'เพิ่มข้อมูลเรียบร้อยแล้ว!');

    }

    public function edit($id)
    {
        $breadcrumb = [
            ['name' => 'อัพเดตแบรนเนอร์'],
        ];

        $data = TbBanner::findOrFail($id);

        return view('admin.banner.form', [
            'breadcrumb' => $breadcrumb,
            'data' => $data,
        ]);
    }

    public function update(Request $request,$id){

        if($request->banner_show == 'on'){
            $show = 1;
        }else{
            $show = 2;
        }
        if(!empty($request->banner_sort)){
            $sort = $request->banner_sort;
        }else{
            $sort = 0;
        }

        $data = TbBanner::findOrFail($id);

        $data->banner_link              = $request->banner_link;
        $data->banner_show              = $show;
        $data->banner_sort              = $sort;
        $data->updated_by               = Auth::user()->penname;
        $data->updated_at               = date('Y-m-d');

        if (!empty($request->banner_img)) {

            if ($request->hasFile('banner_img')) {
                @unlink(Storage::disk('public')->path('banner/') . $request->banner_img_old);

                $newFilename = uniqid() . '.' . $request->banner_img->extension();
                $data->banner_img = $newFilename;
                $file = $request->file('banner_img');
                $file->move('storage/banner/', $newFilename);
            }

        }

        $data->save();

        return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');

    }

    public function status($id){

        $data = TbBanner::findOrFail($id);

        if($data->banner_show == 2){
            $status = 1;
        }elseif($data->banner_show == 1) {
            $status = 2;
        }

        $data->banner_show                  = $status;
        $data->updated_by                   = Auth::user()->penname;
        $data->updated_at                   = date('Y-m-d');
        $data->save();

        return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');
    }

    public function delete(Request $request){

        $check = TbBanner::findOrFail($request->deleteId);
        if(!empty($check)){
            @unlink(Storage::disk('public')->path('banner/') . $check->banner_img);
        }
        TbBanner::where('id', $request->deleteId)->delete();
        return back()->with('feedback', 'ลบข้อมูลเรียบร้อยแล้ว!');

    }

    public function jsondata()
    {

        $data = TbBanner::get();

        return Datatables::of($data)
                ->addColumn('banner_img', function ($data) {
                    if(!empty($data->banner_img)){
                        return '<img src="'.asset('storage/banner/'.$data->banner_img).'" alt="" class="table-width text-align-center" rel="nofollow">';
                    }else{
                        return '<img src="'.asset('assets/fontend/images/AdsB/ads_611_290.jpg').'" alt="..." class="table-width text-align-center" rel="nofollow">';
                    }
                })
                ->addColumn('banner_sort', function ($data) {
                    return $data->banner_sort;
                })
                ->addColumn('banner_show', function ($data) {
                    return $data->banner_show;
                })
                ->addColumn('updated', function ($data) {
                    return $data->updated_by.'<br/>'.$data->updated_at;
                })
                ->addColumn('actions', function ($data) {
                    $id = $data->id;
                    $status = $data->banner_show;
                    $name = $data->banner_img;
                    return view('admin.banner.button', compact('id','status','name'));
                })
                ->escapeColumns([])
                ->addIndexColumn()
                ->make(true);
    }

}
