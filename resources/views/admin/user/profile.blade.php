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
    <!-- select2 -->
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <!-- select2-bootstrap4-theme -->
    <script src="{{ asset('vendor/select2-bootstrap4-theme/docs/script.js') }}"></script>

    <script>
        function generateCodeCoupon(length = 8) {
            var result           = [];
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
            result.push(characters.charAt(Math.floor(Math.random() * charactersLength)));
            }

            $("#password").val(result.join(''));

        }
    </script>
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        @if(empty($data))
            {{
                Form::open([
                    'novalidate',
                    'route' => 'user.crate',
                    'id'=>'data-form',
                    'method' => 'post',
                    'files' => true
                ])
            }}
        @else
            {{
                Form::model($data, [
                    'novalidate',
                    'route' => ['user.update',[$data->id]],
                    'id'=>'data-form',
                    'method' => 'put',
                    'files' => true
                ])
            }}
        @endif


            <div class="row">
              <div class="col-md-4">
                <div class="card card-user card-wizard active">
                  <div class="image"></div>
                  <div class="card-body">
                    <div class="author">
                        <div class="picture-container">
                            <div class="picture">
                                @isset($data->img)
                                    <input type="hidden" class="form-control" id="img_old" name="img_old" value="{{ $data->img }}">
                                    <img class="picture-src" src="{{ asset('storage/avatar/'.$data->img) }}" alt="..." id="wizardPicturePreview"  />
                                @else
                                    <img class="picture-src" src="{{ asset('images/default-img/default-avatar.png') }}" alt="..." id="wizardPicturePreview"  />
                                @endisset
                                <input accept="image/*" type="file" name="img" id="wizard-picture" value=""  />
                            </div>
                        </div>
                        <a href="#" style="text-decoration: none">
                            <h5 class="title">
                                @if(!empty($data->penname)){{ $data->penname }} @else นามปากกา @endif
                            </h5>
                        </a>
                    </div>
                    <p class="description">
                        @if(!empty($data->aboutme)){{ $data->aboutme }} @endif
                    </p>
                  </div>
                  <div class="card-footer">
                    <hr>
                    <div class="button-container">
                      <div class="row">
                        <div class="col-lg-6 ml-auto">
                          <h5>{{ number_format($articleCount) }}
                            <br>
                            <small>บทความ</small>
                          </h5>
                        </div>
                        @if(!empty($data))
                            <div class="col-lg-6 ml-auto">
                                <h5>
                                    <i class="nc-icon nc-lock-circle-open"></i>
                                    <br>
                                    <a href="{{ route('user.changpassword', ['id' => $data->id]) }}" style="text-decoration: none">
                                        <small>รหัสผ่าน</small>
                                    </a>
                                </h5>
                            </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">ข้อมูลผู้ใช้</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ชื่อที่จะแสดง</label>
                                    <input id="displayname" name="displayname" type="text" class="form-control" placeholder="" value="@if(!empty($data->displayname)){{ $data->displayname }}@else{{ old('displayname') }}@endif">
                                    @error('displayname')<small class="error-danger-text">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>email</label>
                                    <input id="email" name="email" type="email" class="form-control" placeholder="email@yourname.com" value="@if(!empty($data->email)){{ $data->email }}@else{{ old('email') }}@endif">
                                    @error('email')<small class="error-danger-text">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>
                        @if(empty($data))
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>รหัสผ่าน</label>
                                        <input id="password" name="password" type="text" class="form-control" placeholder="" value="{{ old('password') }}">
                                        @error('password')<small class="error-danger-text">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>สุ่มรหัสผ่าน</label>
                                        <input onclick="generateCodeCoupon()" type="button" class="btn btn-primary input-btn"  value="Gen password">
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ชื่อ - นามสกุล</label>
                                    <input id="name" name="name" type="text" class="form-control" placeholder="" value="@if(!empty($data->name)){{ $data->name }}@else{{ old('name') }}@endif">
                                    @error('name')<small class="error-danger-text">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>เบอร์โทรศัพท์</label>
                                    <input id="tel" name="tel" type="text" class="form-control" placeholder="" value="@if(!empty($data->tel)){{ $data->tel }}@else{{ old('tel') }}@endif">
                                    @error('tel')<small class="error-danger-text">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>นามปากกา</label>
                                    <input id="penname" name="penname" type="text" class="form-control" placeholder="" value="@if(!empty($data->penname)){{ $data->penname }}@else{{ old('penname') }}@endif">
                                    <input id="penname_old" name="penname_old" type="hidden" class="form-control" placeholder="" value="@if(!empty($data->penname)){{ $data->penname }}@else{{ old('penname') }}@endif">
                                    @error('penname')<small class="error-danger-text">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>สิทธิ์การใช้งาน</label>
                                    <select type="text" class="form-control" disabled>
                                        @foreach ( $levels as $level)
                                            <option value="{{ $level->id }}" @if(!empty($data->level)) @if($data->level == $level->id ) selected @endif @else @if(old('level') == $level->id ) selected @endif @endif>{{ $level->name  }}</option>
                                        @endforeach
                                    </select>
                                    <input id="level" name="level" type="hidden" value="@if(!empty($data->level)){{ $data->level }}@else{{ old('level') }}@endif">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>เกี่ยวกับฉัน</label>
                                    <textarea id="aboutme" name="aboutme" rows="4" cols="80" class="form-control textarea">@if(!empty($data->aboutme)){{ $data->aboutme }}@else{{ old('aboutme') }}@endif</textarea>
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->lastlogin !="")
                            <label>เข้าใช้งานล่าสุด :: {{ Auth::user()->lastlogin }}</label>
                        @endif
                        @if(!empty($data->update_by))
                            <div class="form-group has-label">
                                <label>อัพเดตข้อมูลโดย :: {{ $data->update_by}} :: {{ $data->updated_at}} </label>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6"></div>
                            <div class="col-6 right">
                                @include('layouts.admin._button.submit')
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>

        </form>
    </div>
</div>

@endsection

@section('js')


@endsection
