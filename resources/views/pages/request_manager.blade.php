@extends('layouts.app', ['activePage' => 'request_manager', 'titlePage' => __('Danh mục đầu việc')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Danh mục đầu việc</h4>
            <p class="card-category"> Here is a subtitle for this table</p>
          </div>

          <div class="card-body">
             <div class="row">
                <div class="col-12 text-right">
                  <a href="#" class="btn btn-sm btn-primary">{{ __('Thêm đầu việc') }}</a>
                </div>
              </div>
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    ID
                  </th>
                  <th>
                    Tên đầu việc
                  </th>
                  <th>
                    Mô tả
                  </th>
                  <th>
                    Độ ưu tiên
                  </th>
                  <th>
                    Ngày bắt đầu
                  </th>
                  <th>
                    Ngày kết thúc
                  </th>
                  <th>
                    Trạng thái
                  </th>
                  <th>
                    Độ ưu tiên
                  </th>
                  <th>
                    Người tạo
                  </th>
                  <th>
                    Người thực hiện
                  </th>
                  <th style="text-align: center;">
                    Hành động
                  </th>
                  
                </thead>
                <tbody>
                  <tr>
                    <td>
                      1
                    </td>
                    <td>
                      Dakota Rice
                    </td>
                    <td>
                      Niger
                    </td>
                    <td>
                      Oud-Turnhout
                    </td>
                    <td class="text-primary" style="text-align: center;">
                      <a rel="tooltip" class="btn btn-success btn-link" href="#" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                        <div class="ripple-container"></div>
                        <a rel="tooltip" class="btn btn-success btn-link" href="#" data-original-title="" title="">
                        <i class="material-icons">delete</i>
                        <div class="ripple-container"></div>
                      </a>
                      </a>
                      
                    </td>
                    
                  </tr>
                
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