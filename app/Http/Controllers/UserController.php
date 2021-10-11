<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\UsersLevel;
use App\Models\TbLevel;
use App\Models\TbLevelMenu;
use App\Models\TbArticle;
use App\Models\HistoryChangePenname;

class UserController extends Controller
{

    public function index()
    {

        $breadcrumb = [
            ['name' => 'บัญชีผู้ใช้'],
        ];

        return view('admin.user.main', [
            'breadcrumb' => $breadcrumb,
            'data' => '',
        ]);

    }

    public function add(){

        $breadcrumb = [
            ['name' => 'เพิ่มบัญชีผู้ใช้'],
        ];

        $levels = TbLevel::where('status',1)->get();

        return view('admin.user.form', [
            'breadcrumb' => $breadcrumb,
            'data' => '',
            'levels' => $levels,
            'history_penname' => '',
        ]);

    }

    public function crate(Request $request){

        $request->validate(
            [
                'displayname' => 'required|max:255|unique:users',
                'email' => 'required|email|max:255|unique:users',
                'name' => 'required|max:255',
                'penname' => 'required|max:255|unique:users',
                'password' => 'required|max:255|min:8',
            ],
            [
                'displayname.required' => 'กรุณากรอกข้อมูล',
                'displayname.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                'displayname.unique' => 'ชื่อนี้มีการใช้งานอยู่แล้ว กรุณาตรวจสอบข้อมูลอีกครั้ง',
                'email.required' => 'กรุณากรอกข้อมูล',
                'email.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                'email.email' => 'กรุณากรอกข้อมูล รูปแบบอีเมลไม่ถูกต้อง',
                'email.unique' => 'อีเมลนี้มีการใช้งานอยู่แล้ว กรุณาตรวจสอบข้อมูลอีกครั้ง',
                'name.required' => 'กรุณากรอกข้อมูล',
                'name.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                'penname.required' => 'กรุณากรอกข้อมูล',
                'penname.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                'penname.unique' => 'นามปากกานี้มีการใช้งานอยู่แล้ว กรุณาตรวจสอบข้อมูลอีกครั้ง',
                'password.required' => 'กรุณากรอกข้อมูล',
                'password.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                'password.min' => 'รหัสผ่านต้องมากกว่า 8 ตัวอักษร',
            ]
        );

        $data = new User;
        $data->displayname                  = $request->displayname;
        $data->email                        = $request->email;
        $data->password                     = Hash::make($request->password);
        $data->name                         = $request->name;
        $data->penname                      = $request->penname;
        $data->tel                          = $request->tel;
        $data->level                        = $request->level;
        $data->aboutme                      = $request->aboutme;
        $data->update_by                    = Auth::user()->penname;
        $data->updated_at                   = now();

        if (!empty($request->img)) {
            if ($request->hasFile('img')) {
                $newFilename = uniqid() . '.' . $request->img->extension();
                $data->img = $newFilename;
                $file = $request->file('img');
                $file->move('storage/avatar/', $newFilename);
            }

        }

        $data->save();

        $menu = TbLevelMenu::where('id',$data->level)->first();

        $level = new UsersLevel;
        $level->UserId                  = $data->id;
        $level->l_artlicle              = $menu->l_artlicle;
        $level->l_about                 = $menu->l_about;
        $level->l_ads                   = $menu->l_ads;
        $level->l_category              = $menu->l_category;
        $level->l_customcode            = $menu->l_customcode;
        $level->l_setting               = $menu->l_setting;
        $level->l_user                  = $menu->l_user;
        $level->l_banner                = $menu->l_banner;
        $level->l_setting_ads           = $menu->l_setting_ads;
        $level->crate_by                = Auth::user()->penname;
        $level->update_by               = Auth::user()->penname;
        $level->created_at              = now();
        $level->updated_at              = now();
        $level->save();

        return redirect()->route('user.edit',[$data->id])->with('feedback', 'เพิ่มข้อมูลเรียบร้อยแล้ว!');

    }

    public function edit($id)
    {
        $breadcrumb = [
            ['name' => 'อัพเดตบัญชีผู้ใช้'],
        ];

        $data               = User::findOrFail($id);
        $levels             = TbLevel::where('status',1)->get();
        $articleCount       = TbArticle::where('created_by',$data->penname)->count();
        $history_penname    = HistoryChangePenname::where('userId',$id)->count();
        return view('admin.user.form', [
            'breadcrumb' => $breadcrumb,
            'data' => $data,
            'levels' => $levels,
            'articleCount' => $articleCount,
            'history_penname' => $history_penname,
        ]);
    }

    public function update(Request $request,$id){

        $request->validate(
            [
                'displayname' => 'required|max:255|unique:users,displayname,'.$id,
                'email' => 'required|email|max:255|unique:users,email,'.$id,
                'name' => 'required|max:255',
                'penname' => 'required|max:255|unique:users,penname,'.$id
            ],
            [
                'displayname.required' => 'กรุณากรอกข้อมูล',
                'displayname.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                'displayname.unique' => 'ชื่อนี้มีการใช้งานอยู่แล้ว กรุณาตรวจสอบข้อมูลอีกครั้ง',
                'email.required' => 'กรุณากรอกข้อมูล',
                'email.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                'email.email' => 'กรุณากรอกข้อมูล รูปแบบอีเมลไม่ถูกต้อง',
                'email.unique' => 'อีเมลนี้มีการใช้งานอยู่แล้ว กรุณาตรวจสอบข้อมูลอีกครั้ง',
                'name.required' => 'กรุณากรอกข้อมูล',
                'name.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                'penname.required' => 'กรุณากรอกข้อมูล',
                'penname.max' => 'กรุณากรอกข้อมูลไม่เกิน 255 ตัวอักษร',
                'penname.unique' => 'นามปากกานี้มีการใช้งานอยู่แล้ว กรุณาตรวจสอบข้อมูลอีกครั้ง',
            ]
        );


        $check_penname = User::where('penname',$request->penname)->where('id',$id)->count();
        if($check_penname == 0){
            $penname = new HistoryChangePenname;
            $penname->userId                        = Auth::user()->id;
            $penname->penname_new                   = $request->penname;
            $penname->penname_old                   = $request->penname_old;
            $penname->updated_by                    = Auth::user()->name;
            $penname->save();
        }

        $data = User::findOrFail($id);

        $data->displayname                  = $request->displayname;
        $data->email                        = $request->email;
        $data->name                         = $request->name;
        $data->penname                      = $request->penname;
        $data->tel                          = $request->tel;
        $data->level                        = $request->level;
        $data->aboutme                      = $request->aboutme;
        $data->update_by                    = Auth::user()->penname;
        $data->updated_at                   = now();

        if (!empty($request->img)) {

            if ($request->hasFile('img')) {
                @unlink(Storage::disk('public')->path('avatar/') . $request->img_old);

                $newFilename = uniqid() . '.' . $request->img->extension();
                $data->img = $newFilename;
                $file = $request->file('img');
                $file->move('storage/avatar/', $newFilename);
            }

        }

        $data->save();



        return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');

    }

    public function status($id){

        $data = User::findOrFail($id);

        if($data->status == 0){
            $status = 1;
        }else if($data->status == 1) {
            $status = 0;
        }

        $data->status               = $status;
        $data->update_by            = Auth::user()->penname;
        $data->updated_at           = now();
        $data->save();

        return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');
    }

    public function delete(Request $request){

        $check = User::findOrFail($request->deleteId);
        if(!empty($check)){
            @unlink(Storage::disk('public')->path('avatar/').$check->img);
        }

        User::where('id', $request->deleteId)->delete();

        return back()->with('feedback', 'ลบข้อมูลเรียบร้อยแล้ว!');
    }

    public function jsondata()
    {

        $data = User::where('email','!=','system@programmer.com')->get();

        return Datatables::of($data)
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('author', function ($data) {
                    return $data->penname;
                })
                ->addColumn('level', function ($data) {

                    $level = TbLevel::where('id',$data->level)->first();
                    return $level->name;
                })
                ->addColumn('lastlogin', function ($data) {
                    return $data->lastlogin;
                })
                ->addColumn('status', function ($data) {
                    return $data->status;
                })
                ->addColumn('actions', function ($data) {
                    $id = $data->id;
                    $name = $data->name;
                    $status = $data->status;
                    return view('admin.user.button', compact('id','status','name'));
                })
                ->escapeColumns([])
                ->addIndexColumn()
                ->make(true);
    }

    public function jsonpenname($id)
    {

        $data = HistoryChangePenname::where('userId',$id)->get();

        return Datatables::of($data)
                ->addColumn('author_old', function ($data) {
                    return $data->penname_old;
                })
                ->addColumn('count', function ($data) {
                    return number_format(TbArticle::where('created_by',$data->penname_old)->count());
                })
                ->escapeColumns([])
                ->addIndexColumn()
                ->make(true);
    }


    public function profile($id){

        $breadcrumb = [
            ['name' => 'บัญชีผู้ใช้'],
        ];

        $user = User::findOrFail($id);
        $levels = TbLevel::where('status',1)->get();
        $articleCount = TbArticle::where('created_by',$user->penname)->count();

        return view('admin.user.profile', [
            'breadcrumb' => $breadcrumb,
            'data' => $user,
            'levels' => $levels,
            'articleCount' => $articleCount,
        ]);

    }

    public function level($id){
        $breadcrumb = [
            ['name' => 'ตั้งค่าสิทธิ์การใช้งานของผู้ใช้'],
        ];

        $user = User::findOrFail($id); //บัญชีผู้ใช้

        $userLevel = UsersLevel::where('UserId',$id)->first(); //เมนูที่ผู้ใช้สามารถเข้าถึง
        $level = TbLevel::findOrFail($user->level); //default level

        return view('admin.user.level', [
            'breadcrumb' => $breadcrumb,
            'data' => $user,
            'userLevel' => $userLevel,
            'level' => $level,
        ]);
    }

    public function levelupdate(Request $request,$id){

        $level = UsersLevel::where('UserId', $id)->first();
        if($request->l_artlicle == 1){ $l_artlicle = 1; }else{ $l_artlicle = 0; }
        if($request->l_about == 1){ $l_about = 1; }else{ $l_about = 0; }
        if($request->l_ads == 1){ $l_ads = 1; }else{ $l_ads = 0; }
        if($request->l_category == 1){ $l_category = 1; }else{ $l_category = 0; }
        if($request->l_customcode == 1){ $l_customcode = 1; }else{ $l_customcode = 0; }
        if($request->l_setting == 1){ $l_setting = 1; }else{ $l_setting = 0; }
        if($request->l_user == 1){ $l_user = 1; }else{ $l_user = 0; }
        if($request->l_banner == 1){ $l_banner = 1; }else{ $l_banner = 0; }
        if($request->l_setting_ads == 1){ $l_setting_ads = 1; }else{ $l_setting_ads = 0; }

        $level->l_artlicle              = $l_artlicle;
        $level->l_about                 = $l_about;
        $level->l_ads                   = $l_ads;
        $level->l_category              = $l_category;
        $level->l_customcode            = $l_customcode;
        $level->l_setting               = $l_setting;
        $level->l_user                  = $l_user;
        $level->l_banner                = $l_banner;
        $level->l_setting_ads           = $l_setting_ads;
        $level->update_by               = Auth::user()->penname;
        $level->updated_at              = date('Y-m-d H:i:s');
        $level->save();

        return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');

    }

    public function changpassword($id){
        $breadcrumb = [
            ['name' => 'เปลี่ยนรหัสผ่าน'],
        ];

        $user = User::findOrFail($id);

        return view('admin.user.changpassword', [
            'breadcrumb' => $breadcrumb,
            'data' => $user,
        ]);
    }

    public function changpasswordUpdate(Request $request,$id){

        $request->validate(
            [
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password',
            ],
            [

                'password.required' => 'กรุณากรอกรหัสผ่านใหม่',
                'password.min' => 'กรุณากรอกรหัสผ่านอย่างน้อย 8 อักษร',
                'password_confirmation.required' => 'กรุณายืนยันรหัสผ่าน',
                'password_confirmation.same' => 'รหัสผ่านไม่ตรงกัน กรุณาตรวจสอบข้อมูล',
            ]
        );

        $user                     = User::findOrFail($id);
        $user->password           = Hash::make($request->password);
        $user->update_by          = Auth::user()->penname;
        $user->updated_at         = now();
        $user->save();

        return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');

    }
}
