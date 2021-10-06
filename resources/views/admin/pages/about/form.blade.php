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
                    'route' => 'page.about.crate',
                    'id'=>'data-form',
                    'method' => 'post',
                    'files' => true
                ])
            }}
        @else
            {{
                Form::model($data, [
                    'novalidate',
                    'route' => ['page.about.update',[$data->id]],
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
                            <div class="form-group" >
                                <textarea id="editor" name="page_detail">@if(!empty($data->page_detail)){{ $data->page_detail }}@else{{ old('page_detail') }}@endif</textarea>
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
                                <input name="page_show" id="page_show" class="bootstrap-switch" type="checkbox" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success"
                                @if(!empty($data->page_show))
                                    @if($data->page_show == 1)
                                        checked
                                    @endif
                                @else
                                    checked
                                @endif
                                 />
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="jumbotron">
                                SEO Description
                            </div>
                            <div class="form-group">
                                <textarea onkeyup="ChkLength();" rows="5" id="remainLength" name="page_seo_detail" rows="4" class="form-control" placeholder="อธิบายเกี่ยวกับบทความไม่เกิน 150 - 170 ตัวอักษร" maxlength="170" >@if(!empty($data->page_seo_detail)){{ $data->page_seo_detail }}@else{{ old('page_seo_detail') }}@endif</textarea>
                                <p id="showNumber_ChkLength" class="error-danger-text"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
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
    <!-- ckeditor 4 -->
    <script src="{{ asset('vendor/ckeditor4/ckeditor.js') }}"></script>

    <script>
        CKEDITOR.replace( 'editor');
    </script>
@endsection
