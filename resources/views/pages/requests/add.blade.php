@extends('layouts.app', ['activePage' => $activePage, 'titlePage' => __('Thêm yêu cầu')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('request.add') }}" autocomplete="off" class="form-horizontal">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="card ">
              <div class="card-header card-header-primary">
                <h5 class="card-title">{{$titlePage}}</h5>
                <p class="card-category"></p>
              </div>
              @if(count($errors) > 0)
                  <div class="alert alert-danger">
                      @foreach($errors->all() as $err)
                          {{$err}}<br>
                      @endforeach
                  </div>
              @endif
              @if(session('thongbao'))
                <div class="alert alert-success" role="alert">
                  {{session('thongbao')}}
                </div>
              @endif
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <!-- <a onclick="goBack()" class="btn btn-sm btn-primary">{{ __('Trở lại') }}</a> -->
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Tên yêu cầu') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" id="input-name" type="text" placeholder="{{ __('Tên yêu cầu') }}" value="{{ old('title') }}"  aria-required="true"/>
                      @if ($errors->has('title'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('title') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nội dung') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                     <textarea class="w-100 form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" rows="3" name="content" placeholder="{{ __('Nội dung yêu cầu') }}">{{ old('content') }}</textarea>
                     <br>
                      @if ($errors->has('content'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('content') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Người tạo') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <b>{{$fullname}}</b>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Người yêu cầu') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <select id="ajax-select" class="selectpicker with-ajax" data-live-search="true" name="request_user">
                        <?php
                        if(old('request_user') !== null) {
                          $request_user = $employeeInfo::where('username', old('request_user'))->first();
                          ?>
                          <option value="{{old('request_user')}}" selected="selected">
                            <?php
                            echo $request_user->name.' - '.$request_user->Unit->name;
                            ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>

                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Trạng thái') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <b>Chờ</b>
                      <!-- <select class="custom-select d-block w-100" name="status">
                        <option value="1">Chờ</option>
                      </select> -->
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Deadline') }}</label>
                  <div class="col-sm-7">
                    <div class="input-group">
                      <input type="text" class="form-control {{ $errors->has('deadline') ? ' is-invalid' : '' }} w-50 datepicker" name="deadline"  value="{{ old('deadline') }}">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-calendar"></i>
                        </span>
                      </div>
                      <br>
                      @if ($errors->has('deadline'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('deadline') }}</span>
                      @endif
                    </div>
                    
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Độ ưu tiên') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('priority') ? ' has-danger' : '' }}">
                      <select class="custom-select d-block w-100 form-control{{ $errors->has('priority') ? ' is-invalid' : '' }}" name="priority">
                        <option value="">--Độ ưu tiên--</option>
                        <?php
                        get_prioryties( old('priority', '2') );
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Đầu việc') }}</label>
                  <div class="form-group col-sm-7{{ $errors->has('role_id') ? ' has-danger' : '' }}">
                      <select class="form-control{{ $errors->has('role_id') ? ' is-invalid' : '' }} selectpicker" name="role_id" data-live-search="true">
                          <option value="">--Loại Công Việc--</option>
                          <?php role_parent($roles, 0, '--', old('role_id'));?>
                      </select>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Ghi chú') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                     <textarea class="w-100" rows="3" name="description" placeholder="Ghi chú...">{{old('description')}}</textarea>
                      
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="card-footer ml-auto mr-auto">
                <a onclick="goBack()" class="btn btn-primary"style="color:#fff;margin-right: 25px;" >{{ __('Trở lại') }}</a>
                <button type="submit" class="btn btn-primary">{{ __('Thêm') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection