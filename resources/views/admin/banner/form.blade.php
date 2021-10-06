@extends('layouts.temp_admin')

@section('css')
<style>
    .jumbotron { padding: 1rem; margin-bottom: 1rem; }
</style>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        @if(empty($data))
            {{
                Form::open([
                    'novalidate',
                    'route' => 'banner.crate',
                    'id'=>'data-form',
                    'method' => 'post',
                    'files' => true
                ])
            }}
        @else
            {{
                Form::model($data, [
                    'novalidate',
                    'route' => ['banner.update',[$data->id]],
                    'id'=>'data-form',
                    'method' => 'put',
                    'files' => true
                ])
            }}
        @endif

            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group has-label text-align-center">
                                <br/>
                                @isset($data->banner_img)
                                    <input type="hidden" class="form-control" id="banner_img_old" name="banner_img_old" value="{{ $data->banner_img }}">
                                    <img id="blah1" src="{{ asset('storage/banner/'.$data->banner_img) }}" alt="" class="full-width" rel="nofollow">
                                @else
                                    <img id="blah1" src="{{ asset('assets/fontend/images/AdsB/ads_661_314.jpg')}}" alt="..." class="full-width" rel="nofollow">
                                @endisset
                            </div>
                            <div class="has-label">
                                <label>รูปภาพ *</label>
                                <input type="file" accept="image/*" class="form-control" id="banner_img" name="banner_img" onchange="readURL1(this);">
                                @error('banner_img')<small class="error-danger-text">{{ $message }}</small>@enderror
                                <p></p><small>ขนาดไฟล์ คือ 661 X 314 PX</small><br/>
                                <small class="error-danger-text">* หากไฟล์ภาพมีขนาดไม่เท่ากับที่กำหนด ไฟล์จะบีบอัดอัตโนมัติเพื่อให้ได้ขนาดที่ต้องการ (อาจทำให้ภาพยืดหรือหดได้)</small>
                                <br/>
                                <br/>
                            </div>
                            <div class="form-group has-label">
                                <label>Link *</label>
                                <input class="form-control no-max-height" id="banner_link" name="banner_link" value="@if(!empty($data->banner_link)){{ $data->banner_link }}@else{{ old('permalink') }}@endif" />
                                @error('banner_link')<small class="error-danger-text">{{ $message }}</small> @enderror
                            </div>
                            @if(!empty($data->updated_by))
                            <div class="line"></div>
                            <div class="form-group has-label">
                                <label>อัพเดตข้อมูลโดย :: {{ $data->updated_by}} :: {{ $data->updated_at}} </label>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="jumbotron">
                                บันทึกแบบร่าง / เผยแพร่
                            </div>
                            <div class="form-group">
                                <input name="banner_show" id="banner_show" class="bootstrap-switch" type="checkbox" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success"
                                @if(!empty($data->banner_show))
                                    @if($data->banner_show == 1) checked @endif
                                @else checked @endif
                                />
                            </div>
                            <hr/>
                            <div class="jumbotron">
                                ลำดับการแสดงผล
                            </div>
                            <div class="form-group">
                                <input class="form-control no-max-height" id="banner_sort" name="banner_sort" placeholder="0" value="@if(!empty($data->banner_sort)){{ $data->banner_sort }}@else{{ old('banner_sort') }}@endif" />
                                <p><small class="error-danger-text">* เรียงลำดับโดยตัวเลขมากที่สุดขึ้นก่อน</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('banner.index')}}">
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
            </div>

        </form>
    </div>
</div>

@endsection

@section('js')


@endsection
