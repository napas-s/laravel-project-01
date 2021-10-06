@extends('layouts.temp_admin')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-body ">
              <div class="row">
                <div class="col-5 col-md-4">
                  <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-single-copy-04 text-warning"></i>
                  </div>
                </div>
                <div class="col-7 col-md-8">
                  <div class="numbers">
                    <p class="card-category">บทความทั้งหมด</p>
                    <p class="card-title">{{ number_format($count_article) }}
                      <p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer ">
              <hr>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-body ">
              <div class="row">
                <div class="col-5 col-md-4">
                  <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-tile-56 text-success"></i>
                  </div>
                </div>
                <div class="col-7 col-md-8">
                  <div class="numbers">
                    <p class="card-category">หมวดหมู่ทั้งหมด</p>
                    <p class="card-title">{{ number_format($count_category)}}
                      <p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer ">
              <hr>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-body ">
              <div class="row">
                <div class="col-5 col-md-4">
                  <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-money-coins text-danger"></i>
                  </div>
                </div>
                <div class="col-7 col-md-8">
                  <div class="numbers">
                    <p class="card-category">โฆษณา</p>
                    <p class="card-title">{{ number_format($count_ads) }}
                      <p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer ">
              <hr>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-body ">
              <div class="row">
                <div class="col-5 col-md-4">
                  <div class="icon-big text-center icon-warning">
                    <i class="nc-icon nc-single-02 text-primary"></i>
                  </div>
                </div>
                <div class="col-7 col-md-8">
                  <div class="numbers">
                    <p class="card-category">ผู้ใช้</p>
                    <p class="card-title">{{ number_format($count_user) }}
                      <p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer ">
              <hr>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card  card-tasks">
            <div class="card-header ">
                <h4 class="card-title">บทความที่มีการเข้าชมมากที่สุด 10 อันดับ</h4>
            </div>
            <div class="card-body ">
                @if (count($list_view) != 0)
                    <div class="table-full-width table-responsive">
                    <table class="table">
                        <tbody>
                            @foreach ($list_view as $view)
                            <tr>
                                <td><a href="{{ route('artlicle.preview',$view->art_parmalink) }}" target="_bank">{{ $view->art_name}}</a></td>
                                <td>{{ number_format($view->art_view) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                @else
                    <hr/>
                    <div class="text-center">
                        <h4>ไม่พบข้อมูล</h4>
                    </div>
                @endif

            </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card ">
          <div class="card-body ">
            @if (!empty($list_log))
                @php
                    $tags = explode(",",$list_log->value);
                    asort($tags);
                @endphp
                @foreach ( $tags as $tag )
                    <span class="badge badge-pill badge-eee">{{ $tag }}</span>
                @endforeach
            @else
                <hr/>
                <div class="text-center">
                    <h4>ไม่พบข้อมูล</h4>
                </div>
            @endif
          </div>
          <div class="card-footer ">
            <hr>
            <div class="stats">
                <a href="{{ route('setting.logtag')}}"><i class="fa fa-edit"></i> อัพเดตข้อมูล</a> 
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
