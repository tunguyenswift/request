@extends('layouts.app', ['activePage' => 'group.list', 'titlePage' => __('Danh sách Phòng Ban')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Danh sách phòng ban</h4>
            <p class="card-category"></p>
          </div>
          <div class="card-body">
             <div class="row">
                <div class="col-12 text-right">
                  
                </div>
              </div>
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    STT
                  </th>
                  <th>
                    Tên phòng ban
                  </th>
                  <th>
                    Mô tả
                  </th>
                  <th>
                    Lãnh đạo trung tâm
                  </th>
                  <th>
                    Phó tổng phụ trách
                  </th>
                  <!-- <th style="text-align: center;">
                    Hành động
                  </th> -->
                  
                </thead>
                <tbody>
                  
                 @foreach($group as $e)
                  <tr>
                    <td>
                     {{ $loop->iteration }}
                    </td>
                    <td>
                      {{$e->name}}
                    </td>
                    <td>
                      {{$e->description}}
                    </td>
                    <td>
                      {{$e->lanhdaotrungtam}}
                    </td>
                    <td>
                      {{$e->photongphutrach}}
                    </td>
                    <!-- <td class="text-primary" style="text-align: center;">
                      <a rel="tooltip" class="btn btn-success btn-link" href="#" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                        <div class="ripple-container"></div>
                        <a rel="tooltip" class="btn btn-success btn-link" href="#" data-original-title="" title="">
                        <i class="material-icons">delete</i>
                        <div class="ripple-container"></div>
                      </a>
                      </a>
                    </td> -->
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