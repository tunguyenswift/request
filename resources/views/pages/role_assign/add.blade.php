@extends('layouts.app', ['activePage' => 'role_assign.list', 'titlePage' => __('Thêm đầu việc')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="add" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Thêm yêu cầu mới') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="list" class="btn btn-sm btn-primary">{{ __('Trở lại') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Đầu việc') }}</label>
                  <div class="form-group col-sm-7">
                      <select class="form-control selectpicker" name="role_id" data-live-search="true">
                            <option value="0">Chọn Đầu việc</option>
                            <?php role_parent($parent);?>
                        </select>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nhân viên') }}</label>
                  <div class="form-group col-sm-7">
                      <select class="form-control selectpicker" name="username" data-live-search="true">
                            <option value="0">Chọn Nhân viên</option>
                            @foreach($employee as $item)
                            <option value="{{$item['username']}}" data-tokens="{{$item['username']}}">{{$item['name']}} - {{$item['username']}}</option>
                            @endforeach
                        </select>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Index') }}</label>
                  <div class=" col-sm-7" >
                    
                    <select class="form-control" name="index">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                  </div>
                </div>
                
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Thêm') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection