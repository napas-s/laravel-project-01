@extends('layouts.temp_admin')

@section('css')

 <style>
    .jumbotron {
        padding: 1rem;
        margin-bottom: 1rem;
    }
 </style>

@endsection

@section('content')

{{
    Form::model($data, [
        'novalidate',
        'route' => ['setting.updateSeting',$data->id],
        'id'=>'data-form',
        'method' => 'put',
        'files' => true
    ])
}}

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    @if(!empty($data->setting_logoWeb))
                    <a href="#" class="remove-logo" data-toggle="modal" data-target="#myDeletelogo" onclick="deleteModal(this)" href="#" data-id="{{ $data->id }}" data-name="{{ $data->setting_logoWeb }}">
                        <button class="btn btn-icon btn-round btn-google" type="button">
                            <i class="fa fa-times"></i>
                        </button>
                    </a>
                    @endisset
                    <div class="text-align-center">
                        @isset($data->setting_logoWeb)
                            <input type="hidden" class="form-control" id="setting_logoWeb_old" name="setting_logoWeb_old" value="{{ $data->setting_logoWeb }}">
                            <img id="blah1" src="{{ asset('storage/setting/' . $data->setting_logoWeb) }}" alt="" class="full-width" rel="nofollow">
                        @else
                            <img id="blah1" src="{{ asset('images/default-img/no-img.jpg')}}" alt="..." class="full-width" rel="nofollow">
                        @endisset
                    </div>
                    <br/>
                    <br/>
                    <input type="file" accept="image/*" class="form-control" id="setting_logoWeb" name="setting_logoWeb" onchange="readURL1(this);">
                    <p></p><small>ขนาดไฟล์ Logo คือ 227 X 70 PX</small><br/>
                    <small class="error-danger-text">* เว้นระยะขอบบนและขอบล่างเล็กน้อยเพื่อความสวยงาม</small><br/>
                    <small class="error-danger-text">* หากไฟล์ภาพมีขนาดไม่เท่ากับที่กำหนด ไฟล์จะบีบอัดอัตโนมัติเพื่อให้ได้ขนาดที่ต้องการ (อาจทำให้ภาพยืดหรือหดได้)</small><br/>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @if(!empty($data->setting_iconWeb))
                    <a href="#" class="remove-logo" data-toggle="modal" data-target="#myDeleteicon" onclick="deleteModal2(this)" href="#" data-id="{{ $data->id }}" data-name="{{ $data->setting_iconWeb }}">
                        <button class="btn btn-icon btn-round btn-google" type="button">
                            <i class="fa fa-times"></i>
                        </button>
                    </a>
                    @endisset
                    <div class="text-align-center">
                        @isset($data->setting_iconWeb)
                            <input type="hidden" class="form-control" id="setting_iconWeb_old" name="setting_iconWeb_old" value="{{ $data->setting_iconWeb }}">
                            <img id="blah2" src="{{ asset('storage/setting/' . $data->setting_iconWeb) }}" alt="" class="icon-width" rel="nofollow">
                        @else
                            <img id="blah2" src="{{ asset('images/default-img/no-img.jpg')}}" alt="..." class="icon-width" rel="nofollow">
                        @endisset
                    </div>
                    <br/>
                    <br/>
                    <input type="file" accept="image/*" class="form-control" id="setting_iconWeb" name="setting_iconWeb" onchange="readURL2(this);">
                    <p></p><small>ขนาดไฟล์ icon คือ 60 X 60 PX</small><br/>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="jumbotron">
                        ชื่อเว็บไซต์ <small class="error-danger-text">*</small>
                    </div>
                    <div class="form-group">
                        <input class="form-control" id="setting_nameWeb" name="setting_nameWeb" value="@isset($data->setting_nameWeb){{ $data->setting_nameWeb }}@endisset" />
                        @error('setting_nameWeb')<small class="error-danger-text">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="jumbotron">
                        รายละเอียดเว็บไซต์
                        <br/>
                        (คือ คำอธิบายที่เกี่ยวกับ Website จะไม่แสดงในเว็บไซต์ แต่จะแสดงที่หน้าการแสดงผลการค้นหาของ Google)
                    </div>
                    <div class="form-group">
                        <textarea rows="3" class="form-control" id="setting_detail" name="setting_detail">@isset($data->setting_detail){{ $data->setting_detail }}@endisset</textarea>
                        @error('setting_detail')<small class="error-danger-text">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="jumbotron">
                            คีย์เวิร์ด
                            <br/>
                            (คือ คีย์เวิร์ดที่เกี่ยวข้องเว็บไซต์ สำหรับเพิ่มการค้นหาใน Google ประมาณ 10 คีย์เวิร์ด และใช้เครื่องหมายคอมม่า (,) คั่นระหว่างคีย์เวิร์ดแต่ละคำ โดยไม่ต้องเว้นวรรคข้างหลังคอมม่า)
                        </div>
                        <input class="form-control" id="setting_keyword" name="setting_keyword" value="@isset($data->setting_keyword){{ $data->setting_keyword }}@endisset" />
                        @error('setting_keyword')<small class="error-danger-text">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($data->updated_by))
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <label>อัพเดตข้อมูลโดย :: {{ $data->updated_by}} :: {{ $data->updated_at}} </label>
                </div>
            </div>
        </div>
        @endif
        <div class="col-md-12">
            <div class="card">
                <div class="card-footer">
                    <div class="right">
                        @include('layouts.admin._button.submit')
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>

@include('admin.setting.modal.deleteLogo')
@include('admin.setting.modal.deleteIcon')
@endsection

@section('js')


@endsection
