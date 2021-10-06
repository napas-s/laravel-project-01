@extends('layouts.temp_admin')

@section('css')
 <!-- select2 -->
 <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" />
 <!-- select2-bootstrap4-theme -->
 <link href="{{ asset('vendor/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css') }}" rel="stylesheet">

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
                    'route' => 'ads.head.crate',
                    'id'=>'data-form',
                    'method' => 'post',
                    'files' => true
                ])
            }}
        @else
            {{
                Form::model($data, [
                    'novalidate',
                    'route' => ['ads.head.update',[$data->id]],
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
                                @if(!empty($data->ads_img))
                                    <img id="blah1" src="{{ asset('storage/ads_im/'.$data->ads_img) }}" alt="" class="full-width" rel="nofollow">
                                    <input type="hidden" class="form-control" id="ads_img_old" name="ads_img_old" value="{{ $data->ads_img }}">
                                @else
                                    <img id="blah1" src="{{ asset('assets/fontend/images/AdsB/ads-top-header.jpg') }}" alt="..." class="full-width" rel="nofollow">
                                @endisset
                            </div>
                            <div class="has-label">
                                <label>รูปภาพ *</label>
                                <input type="file" accept="image/*" class="form-control" id="ads_img" name="ads_img" onchange="readURL1(this);">
                                @error('ads_img')<small class="error-danger-text">{{ $message }}</small>@enderror
                                <p></p><small>ขนาดไฟล์ คือ 1140 X 150 PX</small><br/>
                                <small class="error-danger-text">* หากไฟล์ภาพมีขนาดไม่เท่ากับที่กำหนด ไฟล์จะบีบอัดอัตโนมัติเพื่อให้ได้ขนาดที่ต้องการ (อาจทำให้ภาพยืดหรือหดได้)</small>
                                <br/>
                                <br/>
                            </div>
                            <div class="form-group has-label">
                                <label>ชื่อโฆษณา *</label>
                                <input class="form-control no-max-height" id="ads_name" name="ads_name" value="@if(!empty($data->ads_name)){{ $data->ads_name }}@else{{ old('ads_name') }}@endif" />
                                @error('ads_name')<small class="error-danger-text">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group has-label">
                                <label>Link</label>
                                <input class="form-control no-max-height" id="ads_link" name="ads_link" value="@if(!empty($data->ads_link)){{ $data->ads_link }}@else{{ old('ads_link') }}@endif" />
                            </div>
                            <div class="form-group has-label">
                                <label>ตั้งค่าการแสดงผล *</label>
                                <select id="ads_display" name="ads_display[]" class="form-control select-multiple" multiple="multiple">
                                    @foreach ($displays as $display)
                                        <option value="{{$display->id}}" @if(!empty($data->ads_display)) @if($display->id == $data->ads_display) selected @endif @endif>{{$display->display_name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="old_ads_display" name="old_ads_display" value="@if(!empty($data->ads_display)){{ $data->ads_display }}@else{{ old('ads_display') }}@endif" />
                                @error('ads_display')<small class="error-danger-text">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group has-label">
                                <div class="row">
                                    <div class="col-md-6" style="margin-top: 10px">
                                        <select id="ads_set_date_status" name="ads_set_date_status" class="form-control" onchange="setDate(this.value)">
                                            <option value="1" @if(!empty(old('ads_set_date_status'))) @if(old('ads_set_date_status') == 1) selected @endif @else @if(!empty($data->ads_set_date_status)) @if($data->ads_set_date_status == 1) selected @endif @endif @endif>ไม่กำหนดเวลาการแสดงผล</option>
                                            <option value="2" @if(!empty(old('ads_set_date_status'))) @if(old('ads_set_date_status') == 2) selected @endif @else @if(!empty($data->ads_set_date_status)) @if($data->ads_set_date_status == 2) selected @endif @endif @endif>กำหนดเวลาการแสดงผล</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="setDate" class="form-group has-label
                                @if(!empty(old('ads_set_date_status')))
                                    @if(old('ads_set_date_status') == 1) hidden @endif
                                @else
                                    @if(!empty($data->ads_set_date_status))
                                        @if($data->ads_set_date_status == 1) hidden @endif
                                    @else
                                        hidden
                                    @endif
                                @endif ">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>วันที่เริ่มโฆษณา *</label>
                                        <input id="ads_set_date_start" name="ads_set_date_start" type="text" class="form-control datepicker" placeholder="{{ date('d-m-Y') }}" value="@if(!empty($data->ads_set_date_start)){{ date("d-m-Y",strtotime($data->ads_set_date_start)) }}@else{{ old('ads_set_date_start') }}@endif">
                                        @error('ads_set_date_start')<small class="error-danger-text">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label>วันที่หมดอายุการโฆษณา *</label>
                                        <input id="ads_set_date_end" name="ads_set_date_end" type="text" class="form-control datepicker" placeholder="{{ date('d-m-Y') }}" value="@if(!empty($data->ads_set_date_end)){{ date("d-m-Y",strtotime($data->ads_set_date_end))  }}@else{{ old('ads_set_date_end') }}@endif">
                                        @error('ads_set_date_end')<small class="error-danger-text">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-label">
                                <label>หมายเหตุ</label>
                                <textarea class="form-control no-max-height" id="ads_note" name="ads_note" >@if(!empty($data->ads_note)){{ $data->ads_note }}@else{{ old('ads_note') }}@endif</textarea>
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
                                <input name="ads_show" id="ads_show" class="bootstrap-switch" type="checkbox" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success"
                                @if(!empty($data->ads_show))
                                    @if($data->ads_show == 1) checked @endif
                                @else checked @endif
                                />
                            </div>
                            <hr/>
                            <div class="jumbotron">
                                ลำดับการแสดงผล
                            </div>
                            <div class="form-group">
                                <input class="form-control no-max-height" id="ads_sort" name="ads_sort" placeholder="0" value="@if(!empty($data->ads_sort)){{ $data->ads_sort }}@else{{ old('ads_sort') }}@endif" />
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
                                    <a href="{{ route('ads.head.index')}}">
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
<!-- select2 -->
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<!-- select2-bootstrap4-theme -->
<script src="{{ asset('vendor/select2-bootstrap4-theme/docs/script.js') }}"></script>

@if(!empty($data->ads_display))
    <script>
        var old_ads_display = $('#old_ads_display').val();
        $.ajax({
            type: "GET",
            url: '{!! route('ads.head.getDisplay') !!}',
            cache: false,
            beforeSend: function () { },
            success: function (response) {

                if(response.length != 0){
                    $("#ads_display").html('');
                    var addTag = [];
                    var selected = '';
                    $.each(response, function (index, item) {

                        if(old_ads_display.indexOf(item.id) != -1){
                            selected = 'selected';
                        }else{
                            selected = '';
                        }

                        addTag +='<option value="' + item.id + '" '+selected+' >' + item.display_name + "</option>"

                    });

                    $("#ads_display").append(addTag);

                }else{
                    $("#ads_display").html('');
                }

            },
            failure: function (errMsg) {
                alert(errMsg);
            }
        });
    </script>
@endif

@endsection
