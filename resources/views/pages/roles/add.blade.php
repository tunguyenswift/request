@extends('layouts.app', ['activePage' => 'role.list', 'titlePage' => __('Thêm đầu việc')])

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
                <h4 class="card-title">{{ __('Thêm công việc mới') }}</h4>
                <p class="card-category"></p>
              </div>
              @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        {{$err}}<br>
                    @endforeach
                </div>
              @endif
              @if(session('notify'))
                <div class="alert alert-success" role="alert">
                  {{session('notify')}}
                </div>
              @endif
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <!-- <a onclick="goBack()" class="btn btn-sm btn-primary">{{ __('Trở lại') }}</a> -->
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Tên công việc') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Tên công việc') }}" value="{{ old('name') }}" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                 <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Mô tả') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                      <textarea class="form-control" rows="3" name="description">{{ old('description') }}</textarea>
                      @if ($errors->has('description'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('description') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Đầu việc cha') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <select class="selectpicker" name="parent_id" data-live-search="true">
                          <option value="0">Chọn Đầu việc cha</ >
                          <?php //role_parent($data);?>
                          <?php role_parent($data, 0, '--', old('parent_id'));?>
                      </select>

                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Quản lý') }}</label>
                  <div class="form-group col-sm-7">
                    <select id="ajax-select" class="selectpicker with-ajax" data-live-search="true" name="manager_support">
                      <?php
                      if(old('manager_support') !== null) {
                        $manager_support = $employeeInfo::where('username', old('manager_support'))->first();
                        ?>
                        <option value="{{old('manager_support')}}" selected="selected">
                          <?php
                          echo $manager_support->name.' - '.$manager_support->Unit->name;
                          ?>
                        </option>
                        <?php
                      }
                      ?>
                    </select>
                    @if ($errors->has('manager_support'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('manager_support') }}</span>
                    @endif
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nhân viên 1') }}</label>
                  <div class="form-group col-sm-7">
                      <select id="ajax-select" class="selectpicker with-ajax" data-live-search="true" name="support_user_1">
                        <?php
                        if(old('support_user_1') !== null) {
                          $support_user_1 = $employeeInfo::where('username', old('support_user_1'))->first();
                          ?>
                          <option value="{{old('support_user_1')}}" selected="selected">
                            <?php
                            echo $support_user_1->name.' - '.$support_user_1->Unit->name;
                            ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                      @if ($errors->has('support_user_1'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('support_user_1') }}</span>
                      @endif
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nhân viên 2') }}</label>
                  <div class="form-group col-sm-7">
                      <select id="ajax-select" class="selectpicker with-ajax" data-live-search="true" name="support_user_2">
                        <?php
                        if(old('support_user_2') !== null) {
                          $support_user_2 = $employeeInfo::where('username', old('support_user_2'))->first();
                          ?>
                          <option value="{{old('support_user_2')}}" selected="selected">
                            <?php
                            echo $support_user_2->name.' - '.$support_user_2->Unit->name;
                            ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                      @if ($errors->has('support_user_2'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('support_user_2') }}</span>
                      @endif
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nhân viên 3') }}</label>
                  <div class="form-group col-sm-7">
                      <select id="ajax-select" class="selectpicker with-ajax" data-live-search="true" name="support_user_3">
                        <?php
                        if(old('support_user_3') !== null) {
                          $support_user_3 = $employeeInfo::where('username', old('support_user_3'))->first();
                          ?>
                          <option value="{{old('support_user_3')}}" selected="selected">
                            <?php
                            echo $support_user_3->name.' - '.$support_user_3->Unit->name;
                            ?>
                          </option>
                          <?php
                        }
                        ?>
                      </select>
                      @if ($errors->has('support_user_3'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('support_user_3') }}</span>
                      @endif
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