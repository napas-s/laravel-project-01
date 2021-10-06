@extends('layouts.temp_admin')

@section('css')
 <!-- select2 -->
 <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" />
 <!-- select2-bootstrap4-theme -->
 <link href="{{ asset('vendor/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css') }}" rel="stylesheet">

 <link href="{{ asset('assets/backend/css/paper-dashboard.css') }}" rel="stylesheet" />

 <style>
    .card-user .image { height: 80px; }
 </style>
@endsection

@section('js')

@endsection
@section('content')

<div class="row">
    <div class="col-md-12">

            {{
                Form::model($data, [
                    'novalidate',
                    'route' => ['user.levelupdate',[$data->id]],
                    'id'=>'data-form',
                    'method' => 'put',
                    'files' => true
                ])
            }}


            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <div class="card card-user card-wizard active">
                        <div class="image"></div>
                        <div class="card-body">
                            <div class="author">
                                <div class="picture-container">
                                    <div class="picture">
                                        @isset($data->img)
                                            <img class="picture-src" src="{{ asset('storage/avatar/'.$data->img) }}" alt="..." id="wizardPicturePreview"  />
                                        @else
                                            <img class="picture-src" src="{{ asset('images/default-img/default-avatar.png') }}" alt="..." id="wizardPicturePreview"  />
                                        @endisset
                                    </div>
                                </div>
                                <a href="#" style="text-decoration: none">
                                    <h5 class="title">
                                        @if(!empty($data->penname)){{ $data->penname }} @else นามปากกา @endif
                                    </h5>
                                </a>
                            </div>
                            <p class="description text-center">
                                @if(!empty($data->aboutme)){{ $data->aboutme }} @else About Me @endif
                            </p>
                        </div>
                        <div class="card-footer">
                          <hr>
                            <div class="button-container">
                                <div class="row">
                                    <div class="col-lg-12 ml-auto">
                                        {{ $data->email }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">สิทธิ์การใช้งาน : {{ $level->name}}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 checkbox-radios">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input value="1" class="form-check-input" type="checkbox" name="l_artlicle" id="l_artlicle" @if($userLevel->l_artlicle == 1)checked @endif>
                                            <span class="form-check-sign"></span>
                                            บทความ
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input value="1" class="form-check-input" type="checkbox" name="l_about" id="l_about" @if($userLevel->l_about == 1)checked @endif>
                                            <span class="form-check-sign"></span>
                                            เกี่ยวกับเรา
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input value="1" class="form-check-input" type="checkbox" name="l_ads" id="l_ads" @if($userLevel->l_ads == 1)checked @endif>
                                            <span class="form-check-sign"></span>
                                            ติดต่อลงโฆษณา
                                        </label>
                                    </div>
                                    {{-- <div class="form-check">
                                        <label class="form-check-label">
                                            <input value="1" class="form-check-input" type="checkbox" name="l_banner" id="l_banner" @if($userLevel->l_banner == 1)checked @endif >
                                            <span class="form-check-sign"></span>
                                            แบรนเนอร์
                                        </label>
                                    </div> --}}
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input value="1" class="form-check-input" type="checkbox" name="l_category" id="l_category" @if($userLevel->l_category == 1)checked @endif >
                                            <span class="form-check-sign"></span>
                                            หมวดหมู่บทความ
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input value="1" class="form-check-input" type="checkbox" name="l_customcode" id="l_customcode" @if($userLevel->l_customcode == 1)checked @endif>
                                            <span class="form-check-sign"></span>
                                            CUSTOM CODE
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input value="1"  class="form-check-input" type="checkbox" name="l_setting" id="l_setting" @if($userLevel->l_setting == 1)checked @endif>
                                            <span class="form-check-sign"></span>
                                            ตั้งค่าเว็บไซต์
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input value="1"  class="form-check-input" type="checkbox" name="l_setting_ads" id="l_setting_ads" @if($userLevel->l_setting_ads == 1)checked @endif>
                                            <span class="form-check-sign"></span>
                                            ตั้งค่าโฆษณา
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input  value="1"  class="form-check-input" type="checkbox" name="l_user" id="l_user" @if($userLevel->l_user == 1)checked @endif>
                                            <span class="form-check-sign"></span>
                                            บัญชีผู้ใช้
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('user.edit',['id' => $data->id]) }}">
                                        @include('layouts.admin._button.back')
                                    </a>
                                </div>
                                <div class="col-6 right">
                                    @include('layouts.admin._button.submit')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

        </form>
    </div>
</div>

@endsection

@section('js')


@endsection
