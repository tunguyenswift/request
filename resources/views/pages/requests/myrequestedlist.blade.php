@extends('layouts.app', ['activePage' => $activePage, 'titlePage' => $titlePage])
@section('content')
<div class="content">
  @if(session('notify'))
    <script type="text/javascript">

      alertNotify('top', 'right', 'success', '{{session('notify')}}');
    </script>
  @endif
  <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <!-- <span class="nav-tabs-title">Tasks:</span> -->
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#profile" data-toggle="tab">
                        <i class="material-icons">schedule</i>Việc cần làm
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#messages" data-toggle="tab">
                       <i class="material-icons">list</i>Tất cả
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="profile">
                  <table class="table table-striped table-bordered table-hover table-sm" >
                    <thead class=" text-primary">
                      <th>ID</td>
                      <th>Yêu cầu</td>
                      <th class="d-none d-lg-table-cell">
                        <p style="width: 50px; height: 10px;">Ưu tiên</p>
                      </td>
                      <th class="d-none d-lg-table-cell">
                        <p style="width: 50px; height: 10px;">Bắt đầu</p>
                      </td>
                      <th>Deadline</td>
                      <th class="d-none d-lg-table-cell">
                        <p style="width: 65px; height: 10px;">Người tạo</p>

                      </td>
                      <th class="d-none d-lg-table-cell">Trạng thái</td>
                      <th>Hành động</td>
                    </thead>
                    <tbody>
                      @foreach($requestStatus1 as $e)
                      <tr>
                        <td>{{$e->id}}</td>
                        <td>{{$e->title}}</td>
                        <td class="d-none d-lg-table-cell">
                          {{$e->getPriority->title}}
                        </td>
                        <td class="d-none d-lg-table-cell">
                          {{(new DateTime($e->created_at))->format('d/m/Y')}}
                        </td>
                        <td>
                          {{(new DateTime($e->deadline))->format('d/m/Y')}}
                        </td>
                        <td class="d-none d-lg-table-cell">{{$e->create_by}}</td>
                        <td class="d-none d-lg-table-cell">{{$e->getStatus->title}}</td>
                        <td class="td-actions text-center">
                          <a class="btn btn-sm btn-primary btn-confirm" href="{{route('receive.request', ['username'=>$username, 'requestid' => $e->id, 'status'=>'2'])}}" role="button" title="Tiếp nhận" rel="tooltip" confirm="Bạn có chắc chắn 'Tiếp nhận' yêu cầu số {{$e->id}}"><i class="material-icons">send</i></a>
                        </td>
                      </tr>
                      @endforeach
                      @foreach($requestStatus2 as $e)
                      <tr>
                        <td>{{$e->id}}</td>
                        <td>{{$e->title}}</td>
                        <td class="d-none d-lg-table-cell">{{$e->getPriority->title}}</td>
                        <td class="d-none d-lg-table-cell">
                          {{(new DateTime($e->created_at))->format('d/m/Y')}}
                        </td>
                        <td>
                          {{(new DateTime($e->deadline))->format('d/m/Y')}}
                        </td>
                        <td class="d-none d-lg-table-cell">{{$e->create_by}}</td>
                        <td class="d-none d-lg-table-cell">{{$e->getStatus->title}}</td>
                        <td class="td-actions text-center">
                          <a style="margin-right: 3px;" class="btn btn-sm btn-success btn-confirm" href="{{route('receive.request', ['username'=>$username, 'requestid' => $e->id, 'status'=>'5'])}}" role="button" title="Hoàn thành" rel="tooltip" confirm="Bạn có chắc chắn 'Hoàn thành' yêu cầu số {{$e->id}}."><i class="material-icons">done</i></a>

                          <a id="btn-confirm" class="btn btn-sm btn-danger btn-confirm" href="{{route('receive.request', ['username'=>$username, 'requestid' => $e->id, 'status'=>'3'])}}" role="button" title="Từ chối" rel="tooltip" confirm="Bạn có chắc chắn 'Từ chối' yêu cầu {{$e->id}}."><i class="material-icons">cancel_schedule_send</i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="messages">
                  <form id="search-form" action="{{route($activePage, $username)}}" method="get">
                            
                    @csrf
                    <div class="row form-group">
                      <div class="col-md-2" >
                        <label>Số ID: </label>
                      </div>
                      <div class="col-md-4" >
                        <div class="input-group">
                          <input type="text" id="search-id" class="form-control" name="id" placeholder="Số ID" value="{{isset($_GET['id']) ? $_GET['id'] : ''}}" />
                        </div>
                      </div>
                
                      <div class="col-md-2" >
                        <label>Tên yêu cầu: </label>
                      </div>
                      <div class="col-md-4" >
                        <div class="input-group">
                          <input type="text" id="search-title" class="form-control" name="title" placeholder="Tên yêu cầu" value="{{isset($_GET['title']) ? $_GET['title'] : ''}}">
                        </div>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-md-2" >
                        <label style="float: left;">Độ ưu tiên</label>
                      </div>
                      <div class="col-md-4" >
                        <select id="search-priority" class="custom-select d-block w-60" name="priority" style="float:right;">
                          <option value="">--Lựa chọn Độ Ưu Tiên --</option>
                          <?php
                          get_prioryties(isset($_GET['priority']) ? $_GET['priority'] : '');
                          ?>
                        </select>
                      </div>
                      <div class="col-md-2" >
                        <label style="float: left;">Trạng thái</label>
                      </div>
                      <div class="col-md-4">
                        <select id="search-status" class="custom-select d-block w-100" name="status">
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
                      
                    <div class="row form-group">
                      <div class="col-12 text-right">
                        <div class="dataTables_length" style="text-align: left;">
                          <label>
                            <select id="length" name="length" aria-controls="dataTables-example" class="custom-select custom-select-sm form-control form-control-sm">
                              <?php 
                              $lengths = [
                                
                                '10' => '10 bản ghi',
                                '25' => '25 bản ghi',
                                '50' => '50 bản ghi',
                                '100' => '100 bản ghi'
                              ];
                             foreach ($lengths as $key => $value) {
                               # code...
                              if($length == $key) {
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
                        </div>
                      </div>
                    </div>
                  
                    <div id="tag_container">
                      @include('pages.requests.presultmyrequested')
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
       
      </div>
      
    </div>
  </div>

@endsection