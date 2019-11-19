@extends('layouts.app', ['activePage' => $activePage, 'titlePage' => __('Sửa yêu cầu')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form method="post" action="{{ route('request.myrequestedit', $request->id) }}" autocomplete="off" class="form-horizontal">
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
                  <div class="form-group">
                    <b>
                      {{$request->getStatus->title}}
                    </b>
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
                <label class="col-sm-2 col-form-label">{{ __('Ngày bắt đầu') }}</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <b>
                      {{(new DateTime($request->created_at))->format('d/m/Y')}}
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
                <label class="col-sm-2 col-form-label" >{{ __(' Quản lý') }}</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <b>{{$request->support_manager}}</b>
                   
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label" >{{ __(' 
                Thực hiện') }}</label>
                <div class="col-sm-7">
                  <div class="form-group">
                    <b>{{$request->support_user}}</b>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="card-footer ml-auto mr-auto">
               <a onclick="goBack()" class="btn btn-sm btn-primary"style="color:#fff;margin-right: 25px;" >{{ __('Trở lại') }}</a>
               <a class="btn btn-sm btn-primary" href="{{route($editPage, array('id'=> $request->id))}}" >{{ __('Sửa') }}</a>
            </div>
          </div>
        </form>
      </div>
    </div>
    @include('pages.requests.log')
  </div>
</div>
@endsection