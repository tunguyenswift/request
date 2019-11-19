@extends('layouts.app', ['activePage' => $activePage, 'titlePage' => $titlePage])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h5 class="card-title ">{{$titlePage}}</h5>
            <p class="card-category"></p>
          </div>
          <!-- input with datetimepicker -->
          @if(count($errors) > 0)
              <div class="alert alert-danger">
                  @foreach($errors->all() as $err)
                      {{$err}}<br>
                  @endforeach
              </div>
          @endif
          @if(session('notify'))
            <!-- <div class="alert alert-success" role="alert">
              {{session('notify')}}
            </div> -->
            <script type="text/javascript">

              alertNotify('top', 'right', 'success', '{{session('notify')}}');
            </script>
          @endif
          <div class="card-body">
            
            <div class="col-md-6">
              
            </div>
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
                   <button class="btn btn-sm btn-info" type="submit">Lọc</button>
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
                @if($activePage == 'myrequest.list')
                  @include('pages.requests.presultmyrequest')
                @else
                  @include('pages.requests.presult')
                @endif
              </div>
            </form>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

@endsection