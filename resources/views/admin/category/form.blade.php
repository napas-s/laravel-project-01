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
                    'route' => 'category.crate',
                    'id'=>'data-form',
                    'method' => 'post',
                    'files' => true
                ])
            }}
        @else
            {{
                Form::model($data, [
                    'novalidate',
                    'route' => ['category.update',[$data->id]],
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
                            <div class="form-group has-label">
                                <label>หมวดหมู่บทความ *</label>
                               <input class="form-control" id="cat_name" name="cat_name" value="@if(!empty($data->cat_name)){{ $data->cat_name }}@else{{ old('txt_title') }}@endif" />
                                @error('cat_name')<small class="error-danger-text">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group has-label">
                                <label>Permalink *</label>
                                <input class="form-control no-max-height" id="cat_parmalink" name="cat_parmalink" value="@if(!empty($data->cat_parmalink)){{ $data->cat_parmalink }}@else{{ old('permalink') }}@endif" />
                                @if(!empty($data->cat_parmalink))<a href="{{ route('fronend.category.index',$data->cat_parmalink) }}" target="_bank">{{ route('fronend.category.index',$data->cat_parmalink) }}</a><br/>@endif
                                @error('cat_parmalink')<small class="error-danger-text">{{ $message }}</small> @enderror
                            </div>
                            <div class="line"></div>
                            <div class="form-group has-label">
                                <div class="form-check-radio form-radio-line" >
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="cat_status" id="txt_status_show" value="1" @if(!empty($data->cat_status)) @if($data->cat_status == 1) checked @endif @else checked @endif > ไม่แสดงบนแถบเมนู
                                        <span class="form-check-sign"></span>
                                    </label>
                                </div>
                                <div class="form-check-radio form-radio-line">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="cat_status" id="txt_status_hide" value="2" @if(!empty($data->cat_status)) @if($data->cat_status == 2) checked @endif @endif> แสดงบนแถบเมนู
                                        <span class="form-check-sign"></span>
                                    </label>
                                </div>
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
                                <input name="cat_show" id="cat_show" class="bootstrap-switch" type="checkbox" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success"
                                @if(!empty($data->cat_show))
                                    @if($data->cat_show == 1) checked @endif
                                @else checked @endif
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('category.index')}}">
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

@if(session('feedback'))
    <script>

        Swal.fire({
            title: "{{ session('feedback') }}",
            text: '',
            icon: 'success',
            confirmButtonText: 'ปิด',
            timer: 2000
        })

    </script>
@endif

@if(session('feedback-er'))
    <script>

        Swal.fire({
            title: "{{ session('feedback-er') }}",
            text: 'ถึงขีดกำหนดในการตั้งค่าเมนูแล้ว กรุณาตรวจสอบข้อมูล',
            icon: 'error',
            confirmButtonText: 'ปิด',
            timer: 2000
        })

    </script>
@endif

@endsection
