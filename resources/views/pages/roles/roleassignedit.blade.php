@extends('layouts.app', ['activePage' => 'role.list', 'titlePage' => __('Thêm đầu việc')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('roleassign.edit', $role_assign->id) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Thay người') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <!-- <a onclick="goBack()" class="btn btn-sm btn-primary">{{ __('Trở lại') }}</a> -->
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
                  <label class="col-sm-2 col-form-label">{{ __('Nhân viên') }}</label>
                  <div class="form-group col-sm-7">
                    <select id="ajax-select" class="selectpicker with-ajax" data-live-search="true" name="username">
                     <option selected="selected" value="{{$employee->username}}">{{$employee->name}}</option>
                     <?php
                        if(old('username') !== null) {
                          $username = $employeeInfo::where('username', old('username'))->first();
                          ?>
                          <option value="{{old('username')}}" selected="selected">
                            <?php
                            echo $username->name.' - '.$username->Unit->name;
                            ?>
                          </option>
                          <?php
                        }else {
                          ?>
                           <option selected="selected" value="{{$employee->username}}">{{$employee->name}} - {{$employee->Unit->name}}</option>
                          <?php
                        }
                        ?>
                    </select>
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