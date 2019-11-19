@extends('layouts.app', ['activePage' => $activePage, 'titlePage' => $titlePage])
@section('content')
<div class="content">
  
  <div class="container-fluid">
    <ul class="nav nav-pills nav-pills-icons" role="tablist">
    <!--
        color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
    -->
<!--     <li class="nav-item">
        <a class="nav-link" href="#dashboard-1" role="tab" data-toggle="tab">
            <i class="material-icons">dashboard</i>
            Dashboard
        </a>
    </li> -->
    <li class="nav-item">
        <a class="nav-link active" href="#tasks-1" role="tab" data-toggle="tab">
            <i class="material-icons">list</i>
            Tất cả
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="#tasks-2" role="tab" data-toggle="tab">
            <i class="material-icons">schedule</i>
            Việc cần làm
        </a>
    </li>
    
  </ul>
  <div class="tab-content tab-space">
      
      
      <div class="tab-pane active" id="tasks-1">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h5 class="card-title ">Tất cả công việc giao cho tôi</h5>
                  <p class="card-category"></p>
                </div>
                <!-- input with datetimepicker -->
                <div class="alert alert-danger">
                  @foreach($errors->all() as $err)
                      {{$err}}<br>
                  @endforeach
              </div>
              @endif
              @if(session('notify'))
                <!-- <div class="alert alert-success" role="alert">
                  {{session('thongbao')}}
                </div> -->
                <script type="text/javascript">

                  alertNotify('top', 'right', 'success', '{{session('notify')}}');
                </script>
              @endif
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 text-right">
                      <?php
                      if($activePage == 'myrequest.list') {
                        ?>
                        <a href="{{route('request.add')}}" class="btn btn-sm btn-primary">{{ __('Thêm yêu cầu') }}</a>
                        <?php
                      }
                      ?>
                    </div>
                  </div>
                 
                  <form action="{{route($activePage, $username)}}" method="get">
                            
                      @csrf
                      <div class="row form-group">
                  <div class="col-md-2" >
                    <label>Số ID: </label>
                  </div>
                  <div class="col-md-4" >
                    <div class="input-group">
                      <input type="text" class="form-control" name="id" placeholder="Số ID" value="{{isset($_GET['id']) ? $_GET['id'] : ''}}" />
                    </div>
                  </div>
                  
                </div>
                <div class="row form-group">
                  
                  <div class="col-md-2" >
                    <label>Tên yêu cầu: </label>
                  </div>
                  <div class="col-md-4" >
                    <div class="input-group">
                      <input type="text" class="form-control" name="title" placeholder="Tên yêu cầu" value="{{isset($_GET['title']) ? $_GET['title'] : ''}}">
                    </div>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-2" >
                    <label style="float: left;">Độ ưu tiên</label>
                  </div>
                  <div class="col-md-4" >
                    <select class="custom-select d-block w-60" name="priority" style="float:right;">
                      <option value="">--Lựa chọn Độ Ưu Tiên --</option>
                      <?php
                      get_prioryties(isset($_GET['priority']) ? $_GET['priority'] : '');
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-2" >
                    <label style="float: left;">Trạng thái</label>
                  </div>
                  <div class="col-md-4">
                    <select class="custom-select d-block w-100" name="status">
                      <option value="">--Lựa chọn Trạng Thái --</option>
                      <?php
                      get_status(isset($_GET['status']) ? $_GET['status'] : '');
                      ?>
                    </select>
                  </div>
                  
                </div>
                <div class="row form-group">
                  <div class="col-md-2">
                     <button class="btn btn-info" type="submit">Lọc</button>
                  </div>
                  <div class="col-md-8">
                  </div>
                  <div class="col-md-2 float-right">
                    <?php
                    if($activePage == 'myrequest.list') {
                      ?>
                      <a href="{{route('request.add')}}" class="btn btn-sm btn-primary">{{ __('Thêm yêu cầu') }}</a>
                      <?php
                    }
                    ?>
                  </div>
                </div>  
                      

                  
                  <div id="tag_container">
                    @include('pages.requests.presult')
                  </div>

                  </form>
                </div>
              </div>
            </div>
            
          </div>
      </div>
      <div class="tab-pane" id="tasks-2">
         <div class="row">
          <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Tiếp nhận công việc mới</h4>
                  <p class="card-category"></p>
                </div>
                <!-- input with datetimepicker -->

                <div class="card-body">
                 
                  <table class="table table-striped table-bordered table-hover table-sm" >
                    <thead class=" text-primary">
                      <td>STT</td>
                      <td>Tên công việc</td>
                      <td>Độ ưu tiên</td>
                      <td>Ngày bắt đầu</td>
                      <td>Deadline</td>
                      <td>Người tạo</td>
                      <td>Hành động</td>
                      
                    </thead>
                    <tbody>
                      @foreach($requestStatus0 as $e)
                      <tr>
                        <td>{{$e->id}}</td>
                        <td>{{$e->title}}</td>
                        <td>
                           {{$e->getPriority->title}}
                        </td>
                        <td>{{$e->created_at}}</td>
                        <td>1/1/2019</td>
                        <td>{{$e->create_by}}</td>
                        <td><a class="btn btn-primary" href="{{route('receive.request', ['username'=>$username, 'requestid' => $e->id])}}" role="button">Nhận việc</a></td>
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
</div>

@endsection