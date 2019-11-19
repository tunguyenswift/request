@extends('layouts.app', ['activePage' => 'employee.list', 'titlePage' => __('Danh sách Nhân viên')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Danh sách nhân viên</h4>
            <p class="card-category"> </p>
          </div>
          <div class="card-body">
             <div class="row">
                <div class="col-12 text-right">
                  
                </div>
              </div>
              <div class="row">
                <form action="{{route('employee.list')}}" method="get">
                  <div class="input-group mb-3">
                    @csrf
                    <div class="col-sm-12 col-md-6">
                      <div class="dataTables_length" >
                        <label>
                          <select id="sort" name="sort" aria-controls="dataTables-example" class="custom-select custom-select-sm form-control form-control-sm">
                            <?php 
                            $sorts = [
                              '10' => '10',
                              '25' => '25',
                              '50' => '50',
                              '100' => '100'
                            ];
                             foreach ($sorts as $key => $value) {
                               # code...
                              if($sort == $key) {
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
                        </label>
                        <button class="btn btn-info" type="submit">Hiển thị</button>
                      </div>
                    </div>
                    <input type="text" class="form-control" name="search" id="search" value="{{$keyword}}" placeholder="Từ khóa..">
                    <button class="btn btn-info" type="submit" style="margin-top:0px;"><i class="fa fa-search"></i></button>
                  </div>
                </form>
            <div class="table-responsive" id="tag_container">
              @include('pages.employees.presult')
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
@endsection