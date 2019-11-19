@extends('layouts.app', ['activePage' => $activePage, 'titlePage' => $titlePage])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('request.edit', $request->id) }}" autocomplete="off" class="form-horizontal">
          <input type="hidden" name="_token" value="{{csrf_token()}}">

          <div class="card ">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{$titlePage}}</h4>
              <p class="card-category"></p>
            </div>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        {{$err}}<br>
                    @endforeach
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
                  <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <input class="form-control" name="title" id="input-name" type="text" value="{{$request->title}}" required="true" aria-required="true"/>
                    @if ($errors->has('name'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Mô tả') }}</label>
                <div class="col-sm-7">
                  <div class="form-group">
                   <textarea class="w-100" rows="3" name="content">{{$request->content}}</textarea>
                    @if ($errors->has('email'))
                      <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
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
                <label class="col-sm-2 col-form-label">{{ __('Trạng thái') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <select class="custom-select d-block w-100" name="status">
                      <!-- <option value="1">Khởi tạo</option>
                      <option value="2">Đang thực hiện</option>
                      <option value="3">Tạm dừng</option>
                      <option value="4">Hoàn Thành</option> -->
                      <?php 
                      $status = [
                        '1' => 'Chờ',
                        '2' => 'Đang thực hiện',
                        '3' => 'Hoàn thành',
                        '4' => 'Tạm dừng',
                        '5' => 'Kết thúc',
                        '6' => 'Hủy'
                      ];
                       foreach ($status as $key => $value) {
                         # code...
                        if($request->status == $key) {
                          ?>
                          <option value="{{$key}}" selected="">{{$value}}</option>
                          <?php
                        } else {
                          ?>
                          <option value="{{$key}}">{{$value}}</option>
                          <?php
                        }
                       }
                       ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Độ ưu tiên') }}</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <select class="custom-select d-block w-100" name="priority">
                      <?php 
                      get_prioryties($request->priority);
                      ?>
                      <!-- <option value="1">Thực hiện trong ngày</option>
                      <option value="2">Thực hiện trong 4h</option>
                      <option value="3">Thực hiện trong 2h</option>
                      <option value="4">Thực hiện trong 1h</option>
                      <option value="5">Thực hiện ngay lập tức</option> -->
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label" >{{ __(' Đầu việc') }}</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <b>{{$request->Role->name}}</b>
                   
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Ghi chú') }}</label>
                <div class="col-sm-7">
                  <div class="form-group">
                   <textarea class="w-100" rows="3" name="description" placeholder="Ghi chú..."></textarea>
                    
                  </div>
                </div>
              </div>
              <div class="row">
              <label class="col-sm-2 col-form-label">{{ __('Người thực hiện') }}</label>
              <div class="col-sm-7">
                <div class="form-group">
                 <!--  <?php
                  
                  ?> -->
                  <select class="custom-select d-block w-100" name="support_user">
                    <?php
                    $support_users = array();
                    $support_users[] = $request->RoleAssignSupportUser01->username;
                    $support_users[] = $request->RoleAssignSupportUser02->username;
                    $support_users[] = $request->RoleAssignSupportUser03->username;
                    foreach ($support_users as $support_user) {
                      # code...
                      if ($request->support_user == $support_user) {
                        # code...
                        ?>
                         <option value="{{$support_user}}" selected="selected">{{$support_user}}</option>
                        <?php
                      } else{
                        ?>
                        <option value="{{$support_user}}">{{$support_user}}</option>
                        <?php
                      }

                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            </div>
            
            <div class="card-footer ml-auto mr-auto">
              <a onclick="goBack()" class="btn btn-primary"style="color:#fff;margin-right: 25px;" >{{ __('Trở lại') }}</a>
              <button type="submit" class="btn btn-primary">{{ __('Lưu') }}</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    @include('pages.requests.log')
  </div>
</div>
@endsection