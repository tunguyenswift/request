@extends('layouts.app', ['activePage' => $activePage, 'titlePage' => $titlePage])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('request.myrequestededit', $request->id) }}" autocomplete="off" class="form-horizontal">
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
                  <div class="form-group">
                    <b>
                      {{$request->title}}
                    </b>
                    
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Mô tả') }}</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <p>
                      {{$request->content}}
                    </p>
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
                  <div class="form-group">
                    <select class="custom-select d-block w-100" name="status">
                      
                      <?php
                      if ($request->status == '2') 
                      {
                        // ---------- Status == 2 - Đang thực hiện --------------
                        $lists = [
                          ['id' => '2', 'name' => 'Đang thực hiện'],
                          ['id' => '5', 'name' => 'Hoàn thành'],
                          ['id' => '3', 'name' => 'Từ Chối']
                        ]; 
                        ?>
                        @foreach($lists as $list)
                          <option value={{$list['id']}} {{(old('status') == $list['id']?'selected':'')}} >{{$list['name']}}</option>
                        @endforeach
                        <?php
                      } 
                      elseif ($request->status == '5')
                      {
                      // ---------- Status == 5 - Hoàn thành --------------
                        ?>
                        <option value="5" selected>Hoàn thành</option>
                        <?php

                      } 
                      elseif ($request->status == '3') 
                      {
                        # code...
                        // ---------- Status == 3 - Từ Chối --------------
                        $lists = [
                          ['id' => '2', 'name' => 'Đang thực hiện'],
                          ['id' => '3', 'name' => 'Từ Chối']
                        ]; 
                        ?>
                         @foreach($lists as $list)
                          <option value={{$list['id']}} {{(old('status') == $list['id']?'selected':'')}} >{{$list['name']}}</option>
                        @endforeach
                        <?php
                      } 
                      elseif ($request->status == '6') 
                      {
                        # code...
                        // ---------- Status == 6 - Kết thúc --------------
                        ?>
                        <option value="6" selected>Kết thúc</option>
                        <?php
                      }
                      elseif ($request->status == '4') 
                      {
                        # code...
                        // ---------- Status == 4 - Hủy --------------
                        ?>
                        <option value="4" selected>Hủy</option>
                        <?php
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
                      <b>
                      {{$request->getPriority->title}}
                    </b>
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Deadline') }}</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <b>
                      {{(new DateTime($request->deadline))->format('d/m/Y')}}
                    </b>
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
                  <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                   <textarea class="w-100 form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="3" name="description" placeholder="Ghi chú..."></textarea>
                    @if ($errors->has('description'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('description') }}</span>
                      @endif
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