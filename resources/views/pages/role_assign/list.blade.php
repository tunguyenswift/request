@extends('layouts.app', ['activePage' => 'role_assign.list', 'titlePage' => __('Danh sách Phân Công Đầu Việc')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Danh sách Phân Công Công Việc</h4>
            <p class="card-category"></p>
          </div>
          <div class="card-body">
              <!-- <div class="row">
                <div class="col-12 text-right">
                  <a href="add" class="btn btn-sm btn-primary">{{ __('Thêm phân công') }}</a>
                </div>
              </div> -->
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    STT
                  </th>
                  <th>
                    Tên đầu việc
                  </th>
                  <th>
                    Người quản lý
                  </th>
                  <th>
                    Người phụ trách 1
                  </th>
                  <th>
                    Người phụ trách 2
                  </th>
                  <th>
                    Người phụ trách 3
                  </th>
                  <!-- <th style="text-align: center;">
                    Hành động
                  </th> -->
                </thead>
                <tbody>
                  @foreach($roleassigns as $e)
                  <tr>
                    <td>
                     {{ $loop->iteration }}
                    </td>
                    <td>
                      {{$e['role_name']}}
                    <td>
                      
                      <a rel="tooltip" class="btn btn-success btn-link" href="edit/{{$e['assign'][0]->id}}" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                      </a>
                      {{$e['assign'][0]->username}}
                    </td>
                    <td>
                     
                      <a rel="tooltip" class="btn btn-success btn-link" href="edit/{{$e['assign'][1]->id}}" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                      </a>
                       {{$e['assign'][1]->username}}
                    </td>
                    <td>
                     
                      <a rel="tooltip" class="btn btn-success btn-link" href="edit/{{$e['assign'][2]->id}}" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                      </a>
                      {{$e['assign'][2]->username}}
                    </td>
                    <td>
                     
                      <a rel="tooltip" class="btn btn-success btn-link" href="edit/{{$e['assign'][3]->id}}" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                      </a>
                      {{$e['assign'][3]->username}}
                    </td>
                   
                  </tr>
                  @endforeach


                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
@endsection