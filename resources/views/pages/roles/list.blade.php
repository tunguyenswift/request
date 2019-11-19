@extends('layouts.app', ['activePage' => 'role.list', 'titlePage' => __('Danh sách Đầu Việc')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Danh mục Công việc</h4>
            <p class="card-category"> </p>
          </div>
          <div class="card-body">
             <div class="row">
              <div class="col-12 text-right">
                <a href="add" class="btn btn-sm btn-primary">{{ __('Thêm công việc') }}</a>
              </div>
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
              <script type="text/javascript">

                alertNotify('top', 'right', 'success', '{{session('notify')}}');
              </script>
            @endif
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    STT
                  </th>
                  <th>
                    Tên đầu việc
                  </th>
                  
                  <!-- <th>
                    Phòng ban
                  </th> -->
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
                  <th style="text-align: center; width: 100px;">
                    Hành động
                  </th>
                </thead>
                <tbody>
                  @foreach($roleassigns as $e)
                  <tr>
                    <td>
                     {{ $loop->iteration }}
                    </td>
                    <td>
                      {{$e['role_name']}}
                    </td>
                    
                    <!-- <td>
                      --Phòng ban ---
                    </td> -->
                    <td>
                      
                      <!-- <a rel="tooltip" class="btn btn-success btn-link" href="roleassignedit/{{$e['assign'][0]->id}}" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                      </a> -->
                      {{$e['assign'][0]->username}}
                    </td>
                    <td>
                     
                      <!-- <a rel="tooltip" class="btn btn-success btn-link" href="roleassignedit/{{$e['assign'][1]->id}}" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                      </a> -->
                       {{$e['assign'][1]->username}}
                    </td>
                    <td>
                     
                      <!-- <a rel="tooltip" class="btn btn-success btn-link" href="roleassignedit/{{$e['assign'][2]->id}}" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                      </a> -->
                      {{$e['assign'][2]->username}}
                    </td>
                    <td>
                     
                      <!-- <a rel="tooltip" class="btn btn-success btn-link" href="roleassignedit/{{$e['assign'][3]->id}}" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                      </a> -->
                      {{$e['assign'][3]->username}}
                    </td>
                    <td class="text-primary" style="text-align: center;">
                      <a rel="tooltip" class="btn btn-success btn-link" href="edit/{{$e['role_id']}}" data-original-title="" title="Sửa">
                        <i class="material-icons">edit</i>
                      </a>
                      
                      <a rel="tooltip" class="btn btn-success btn-link" href="delete/{{$e['role_id']}}" data-original-title="" title="Xóa">
                        <i class="material-icons">delete</i>
                      </a>
                    </td>
                  </tr>
                  @endforeach
                  <?php
                  //role_parent_elements($role);
                 ?>
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