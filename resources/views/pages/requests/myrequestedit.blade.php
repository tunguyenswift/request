@extends('layouts.app', ['activePage' => 'myrequest.list', 'titlePage' => __('Sửa yêu cầu')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('request.myrequestedit', $request->id) }}" autocomplete="off" class="form-horizontal">
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
                    <b>{{$request->title}}</b>
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
                  <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <select class="custom-select d-block w-100" name="status">
                      <?php
                      
                      if($request->status == '1')
                      {
                        // ---------- Status == 1 - Chờ --------------
                        $lists = [
                          ['id' => '1', 'name' => 'Chờ'],
                          ['id' => '4', 'name' => 'Hủy']
                        ]; 

                        // foreach ($lists as $list) {
                        //   # code...
                        //   echo ' <option value='.$list['id'].
                        // }
                        ?>
                        @foreach($lists as $list)
                          <option value={{$list['id']}} {{(old('status', $request->status) == $list['id']?'selected':'')}} >{{$list['name']}}</option>
                        @endforeach
                        <?php
                      } 
                      elseif ($request->status == '2') 
                      {
                        // ---------- Status == 2 - Đang thực hiện --------------
                        if($request->finish_at === null) {
                          $lists = [
                            ['id' => '2', 'name' => 'Đang thực hiện'],
                            ['id' => '4', 'name' => 'Hủy']
                          ]; 
                        } else {
                          # code...
                          $lists = [
                            ['id' => '2', 'name' => 'Đang thực hiện'],
                            ['id' => '6', 'name' => 'Kết thúc'],
                            ['id' => '4', 'name' => 'Hủy']
                          ]; 
                        }
                        
                        ?>
                        @foreach($lists as $list)
                          <option value={{$list['id']}} {{(old('status', $request->status) == $list['id']?'selected':'')}} >{{$list['name']}}</option>
                        @endforeach

                        
                        <?php
                      } 
                      elseif ($request->status == '5')
                      {
                      // ---------- Status == 5 - Hoàn thành --------------
                        $lists = [
                          ['id' => '5', 'name' => 'Hoàn thành'],
                          ['id' => '6', 'name' => 'Kết thúc'],
                        ]; 
                        ?>
                        
                        @foreach($lists as $list)
                          <option value={{$list['id']}} {{(old('status', $request->status) == $list['id']?'selected':'')}} >{{$list['name']}}</option>
                        @endforeach
                        <?php

                      } 
                      elseif ($request->status == '3') 
                      {
                        # code...
                        // ---------- Status == 3 - Tạm dừng --------------
                        $lists = [
                          ['id' => '3', 'name' => 'Tạm dừng'],
                          ['id' => '4', 'name' => 'Hủy']
                        ]; 
                        ?>
                        @foreach($lists as $list)
                          <option value={{$list['id']}} {{(old('status', $request->status) == $list['id']?'selected':'')}} >{{$list['name']}}</option>
                        @endforeach
                        <?php
                      } 
                      elseif ($request->status == '6') 
                      {
                        # code...
                        // ---------- Status == 6 - Kết thúc --------------
                         $lists = [
                          ['id' => '2', 'name' => 'Đang thực hiện'],
                          ['id' => '6', 'name' => 'Kết thúc'],
                          ['id' => '4', 'name' => 'Hủy']
                        ]; 
                        ?>
                        @foreach($lists as $list)
                          <option value={{$list['id']}} {{(old('status', $request->status) == $list['id']?'selected':'')}} >{{$list['name']}}</option>
                        @endforeach
                        <?php
                      }
                      elseif ($request->status == '4') 
                      {
                        # code...
                        // ---------- Status == 4 - Hủy --------------
                         $lists = [
                          ['id' => '2', 'name' => 'Đang thực hiện'],
                          ['id' => '6', 'name' => 'Kết thúc'],
                          ['id' => '4', 'name' => 'Hủy']
                        ]; 
                        ?>
                        @foreach($lists as $list)
                          <option value={{$list['id']}} {{(old('status', $request->status) == $list['id']?'selected':'')}} >{{$list['name']}}</option>
                        @endforeach
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
                   <textarea class="w-100 form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="3" name="description" placeholder="Ghi chú...">{{(old('description') != ""?old('description'):$request->description)}}</textarea>
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