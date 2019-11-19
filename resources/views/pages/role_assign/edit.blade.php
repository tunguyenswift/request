@extends('layouts.app', ['activePage' => 'role_assign.list', 'titlePage' => __('Thêm đầu việc')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('role_assign.edit', $role_assign->id) }}" autocomplete="off" class="form-horizontal">
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
                     <b>
                      {{$role_assign->Role->name}}
                     </b>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Phân công cũ') }}</label>
                  <div class="form-group col-sm-7">
                    <b>
                      
                    </b>
                      
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nhân viên') }}</label>
                  <div class="form-group col-sm-7">
                    <select id="ajax-select" class="selectpicker with-ajax" data-live-search="true"></select>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Index') }}</label>
                  <div class=" col-sm-7" >
                    
                    <b>
                      {{$role_assign->index}}
                     </b>
                  </div>
                </div>
                
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Lưu') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection