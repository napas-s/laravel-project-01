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

@if(empty($data))
            {{
        Form::open([
            'novalidate',
            'route' => 'ads.crate',
            'id'=>'data-form',
            'method' => 'post',
            'files' => true
        ])
    }}
@else
    {{
        Form::model($data, [
            'novalidate',
            'route' => ['ads.update',[$data->id]],
            'id'=>'data-form',
            'method' => 'put',
            'files' => true
        ])
    }}
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <br/>
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-4"><div style="margin-top: 10px">แสดงโฆษณาส่วนหัว</div></div>
                    <div class="col-lg-10 col-md-9 col-sm-8">
                        <div class="form-group" style="margin-top: 10px">
                            <input name="set_head_show" id="set_head_show" class="bootstrap-switch" type="checkbox" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success"
                            @if(!empty($data->set_head_show))
                                @if($data->set_head_show == 1)
                                    checked
                                @endif
                            @endif
                            />
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4"><div style="margin-top: 10px">แสดงโฆษณาส่วนแบรนเนอร์</div></div>
                    <div class="col-lg-10 col-md-9 col-sm-8">
                        <div class="form-group" style="margin-top: 10px">
                            <input name="set_banner_show" id="set_banner_show" class="bootstrap-switch" type="checkbox" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success"
                            @if(!empty($data->set_banner_show))
                                @if($data->set_banner_show == 1)
                                    checked
                                @endif
                            @endif
                            />
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4"><div style="margin-top: 10px">แสดงโฆษณาส่วนขวา</div></div>
                    <div class="col-lg-10 col-md-9 col-sm-8">
                        <div class="form-group" style="margin-top: 10px">
                            <input name="set_right1_show" id="set_right1_show" class="bootstrap-switch" type="checkbox" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success"
                            @if(!empty($data->set_right1_show))
                                @if($data->set_right1_show == 1)
                                    checked
                                @endif
                            @endif
                            />
                        </div>
                    </div>
                    <div class="col-12">
                        @if(!empty($data->updated_by))
                        <div class="line"></div>
                        <div class="form-group has-label">
                            <label>อัพเดตข้อมูลโดย :: {{ $data->updated_by}} :: {{ $data->updated_at}} </label>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
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

@endsection

@section('js')


@endsection
