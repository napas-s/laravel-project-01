<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

use App\Models\TbSetting;
use App\Models\TbExtension;
use App\Models\LogTag;

class SettingController extends Controller
{

    public function index()
    {

        $breadcrumb = [
            ['name' => 'ตั้งค่าเว็บไซต์'],
        ];


        $seting = TbSetting::first();

        return view('admin.setting.main', [
            'breadcrumb' => $breadcrumb,
            'data' => $seting,
        ]);
    }

    public function contact()
    {

        $breadcrumb = [
            ['name' => 'ข้อมูลติดต่อเรา'],
        ];

        $contact = TbSetting::first();

        return view('admin.setting.contact', [
            'breadcrumb' => $breadcrumb,
            'data' => $contact,
        ]);
    }

    public function extensions(){

        $breadcrumb = [
            ['name' => 'ตั้งค่าเพิ่มเติม'],
        ];


        $seting = TbExtension::first();

        return view('admin.setting.extensions', [
            'breadcrumb' => $breadcrumb,
            'data' => $seting,
        ]);

    }

    public function updateSeting(Request $request,$id){

        $data = TbSetting::findOrFail($id);

        $data->setting_nameWeb              = $request->setting_nameWeb;
        $data->setting_detail               = $request->setting_detail;
        $data->setting_keyword              = $request->setting_keyword;
        $data->updated_by                   = Auth::user()->displayname;
        $data->updated_at                   = date('Y-m-d H:i:s');

        if (!empty($request->setting_logoWeb)) {

            if ($request->hasFile('setting_logoWeb')) {
                @unlink(Storage::disk('public')->path('setting/') . $request->setting_logoWeb_old);

                $newFilename = uniqid() . '.' . $request->setting_logoWeb->extension();
                $data->setting_logoWeb = $newFilename;
                $file = $request->file('setting_logoWeb');
                $file->move('storage/setting/', $newFilename);
            }

        }

        if (!empty($request->setting_iconWeb)) {

            if ($request->hasFile('setting_iconWeb')) {
                @unlink(Storage::disk('public')->path('setting/') . $request->setting_iconWeb_old);

                $newFilename = uniqid() . '.' . $request->setting_iconWeb->extension();
                $data->setting_iconWeb = $newFilename;
                $file = $request->file('setting_iconWeb');
                $file->move('storage/setting/', $newFilename);
            }

        }

        $data->save();

        return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');

    }

    public function deleteLogo(Request $request){

        $check = TbSetting::first();
        if (!empty($check->setting_logoWeb)) {
            @unlink(Storage::disk('public')->path('setting/').$check->setting_logoWeb);
        }

        $data = TbSetting::first();
        $data->setting_logoWeb              = null;
        $data->save();

        return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');

    }

    public function deleteIcon(Request $request){

        $check = TbSetting::first();
        if (!empty($check->setting_iconWeb)) {
            @unlink(Storage::disk('public')->path('setting/').$check->setting_iconWeb);
        }

        $data = TbSetting::first();
        $data->setting_iconWeb              = null;
        $data->save();

        return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');

    }

    public function updateContact(Request $request,$id){

        $data = TbSetting::findOrFail($id);

        $data->setting_telContact                   = $request->setting_telContact;
        $data->setting_faxContact                   = $request->setting_faxContact;
        $data->setting_emailContact                 = $request->setting_emailContact;
        $data->setting_idLine                       = $request->setting_idLine;
        $data->setting_LinkYoutube                  = $request->setting_LinkYoutube;
        $data->setting_LinkTwitter                  = $request->setting_LinkTwitter;
        $data->setting_LinkInstagram                = $request->setting_LinkInstagram;
        $data->setting_LinkFacebook                 = $request->setting_LinkFacebook;
        $data->updated_by                           = Auth::user()->displayname;
        $data->updated_at                           = date('Y-m-d H:i:s');
        $data->save();

        return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');

    }

    public function crateExtensions(Request $request){

        if($request->ext_captcha_status == 'on'){
            $show = 1;
        }else{
            $show = 2;
        }

        $data = new TbExtension;
        $data->ext_googleWebmaster       = $request->ext_googleWebmaster;
        $data->ext_googleAnalytics       = $request->txt_detail;
        $data->ext_googleAdsense         = $request->ext_googleAdsense_txt;
        $data->ext_histats               = $request->ext_histats;
        $data->ext_captcha_status        = $show;
        $data->ext_captcha               = $request->ext_histats;
        $data->created_by                = Auth::user()->displayname;
        $data->created_at                = date('Y-m-d H:i:s');
        $data->updated_by                = Auth::user()->displayname;
        $data->updated_at                = date('Y-m-d H:i:s');
        $data->save();

        return back()->with('feedback', 'เพิ่มข้อมูลเรียบร้อยแล้ว!');


    }

    public function updateExtensions(Request $request,$id){

        if($request->ext_captcha_status == 'on'){
            $show = 1;
        }else{
            $show = 2;
        }

        $data = TbExtension::findOrFail($id);
        $data->ext_googleWebmaster       = $request->ext_googleWebmaster;
        $data->ext_googleAnalytics       = $request->ext_googleAnalytics;
        $data->ext_googleAdsense         = $request->ext_googleAdsense;
        $data->ext_histats               = $request->ext_histats;
        $data->ext_captcha_status        = $show;
        $data->ext_captcha               = $request->ext_captcha;
        $data->updated_by                = Auth::user()->displayname;
        $data->updated_at                = date('Y-m-d H:i:s');
        $data->save();

        return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');

    }

    public function logtag(){
        $breadcrumb = [
            ['name' => 'Tag Manager'],
        ];

        $logtags = LogTag::first();


        return view('admin.setting.logtag', [
            'breadcrumb' => $breadcrumb,
            'tag' => $logtags->value,
            'logtags' => $logtags,
        ]);
    }

    public function logtagUpdate(Request $request){


        $data = LogTag::findOrFail(1);
        $data->value        = $request->logTag;
        $data->updated_by   = Auth::user()->displayname;
        $data->updated_at   = date('Y-m-d H:i:s');
        $data->save();

        return back()->with('feedback', 'อัพเดตข้อมูลเรียบร้อยแล้ว!');

    }
}
