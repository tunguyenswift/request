<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover table-sm" style="border-top: 1px solid #efefef;">
    <thead class=" text-primary">
     

      <th class="th-sm">
        <p style="width: 50px; height: 10px;">ID</p>
      </th>
      <th class="th-sm">
        <p style="width: 50px; height: 10px;">Yêu cầu</p>
      </th>
     <!--  <th>
        Mô tả
      </th> -->
      <th class="d-none d-lg-table-cell" >
        <p style="width: 50px; height: 10px;">Ưu tiên</p>
      </th>
      <th class="d-none d-lg-table-cell">
        <p style="width: 50px; height: 10px;">Bắt đầu</p>
      </th>
      <th class="d-none d-lg-table-cell">
        <p style="width: 75px; height: 10px;">Hoàn thành</p>
      </th>
      <th>
         <p style="width: 75px; height: 10px;">Deadline</p>
      </th>
      <th class="d-none d-lg-table-cell">
        <p style="width: 95px; height: 10px;">Trạng thái</p>
      </th> 
      <th class="{{$activePage == 'managerrequested.list'?'d-none':''}} d-none d-lg-table-cell">
        <p style="width: 50px; height: 10px;">Quản lý</p>
      </th>
      <th class="{{$activePage == 'myrequested.list'?'d-none':''}} d-none d-lg-table-cell">
        <p style="width: 65px; height: 10px;">Thực hiện</p>
      </th>
      <th class="{{$activePage == 'myrequest.list'?'d-none':''}} d-none d-lg-table-cell">
        <p style="width: 65px; height: 10px;">Người tạo</p>
      </th>
      <th style="text-align: center">
        <p style="width: 70px; height: 10px;">Hành động</th>
      </th>
     
    </thead>
    <tbody>
      
      @foreach($request as $e)
      <?php
      if($e->status == 1) {
        $class = "wait";
      } elseif ($e->status == 2) {
        # code...
        $class = "working";
      } elseif ($e->status == 3) {
        # code...
        $class = "delay";
      } elseif ($e->status == 4) {
        # code...
        $class = "cancel";
      } elseif ($e->status == 5) {
        # code...
        $class = "success";
      } elseif ($e->status == 6) {
        # code...
        $class = "success";
      } else {
        $class = "";
      }
      ?>
      <tr class=<?php echo $class;?>>
        <td>
          <?php
          $linkUrl = 'http://'.$_SERVER['HTTP_HOST']."/request/admin/request/myrequestdetail/".$e->id;
          ?>
         <a href="{{$linkUrl}}">{{$e['id']}}</a>
        </td>
        <td>
          <a href="{{$linkUrl}}">
            <?php
            $string = str_split($e['title'], 25);
            $title = strlen($string[0]) > 25 ? $string[0]."...":$string[0];
            ?>
            {{$title}}
          </a>
        </td>
        <!-- <td>
          {{$e->content}}
        </td> -->
        <td class="d-none d-lg-table-cell">
          {{$e->getPriority['title']}}
        </td>
        <td class="d-none d-lg-table-cell">
          {{(new DateTime($e->created_at))->format('d/m/Y')}}
        </td>
        <td class="d-none d-lg-table-cell">
          {{(new DateTime($e->finish_at))->format('d/m/Y')}}
        </td>
        <td>
          {{(new DateTime($e->deadline))->format('d/m/Y')}}
        </td>
        <td class="d-none d-lg-table-cell">
          
          {{$e->getStatus['title']}}
        </td>
        <td class="{{$activePage == 'managerrequested.list'?'d-none':''}} d-none d-lg-table-cell">
          {{$e->support_manager}}
        </td>
        <td class="{{$activePage == 'myrequested.list'?'d-none':''}} d-none d-lg-table-cell">
          
          {{$e->support_user}}
        </td>
        
        <td class="{{$activePage == 'myrequest.list'?'d-none':''}} d-none d-lg-table-cell">
          {{$e->CreateBy['username']}}
        </td>
        <td class="td-actions text-left" style="text-align: center;">
          
            <!-- Sửa -->
            <?php
            if($activePage == 'request.list') {
            ?>
            <a rel="tooltip" class="btn btn-success btn-link" href="delete/{{$e->id}}" data-original-title="" title="Xóa" style="width: 60px;">
            Xóa
            <?php
            } 
            ?>
            @if($e->status == 1 || $e->status == 2 )

              {{-- <button onclick="location.href='{{route('receive.request', ['username'=>$username, 'requestid' => $e->id, 'status'=>'4'])}}'" type="button" rel="tooltip" title="Làm lại" class="btn btn-warning btn-sm">
              <i class="material-icons">restore</i>
          <div class="ripple-container"></div><div class="ripple-container"></div></button>

          <button onclick="location.href='http://localhost/request/admin/request/edit/10186'" type="button" rel="tooltip" title="Kết thúc" class="btn btn-success btn-sm">
            <i class="material-icons">done</i>
          <div class="ripple-container"></div><div class="ripple-container"></div></button>

          <button onclick="location.href='http://localhost/request/admin/request/edit/10186'" type="button" rel="tooltip" title="Hoàn thành" class="btn btn-success btn-sm">
            <i class="material-icons">verified_user</i>
          <div class="ripple-container"></div><div class="ripple-container"></div></button>

          <button onclick="location.href='http://localhost/request/admin/request/edit/10186'" type="button" rel="tooltip" title="Hủy" class="btn btn-danger btn-sm">
            <i class="material-icons">highlight_off</i>
          <div class="ripple-container"></div><div class="ripple-container"></div></button>

          <button onclick="location.href='http://localhost/request/admin/request/edit/10186'" type="button" rel="tooltip" title="Từ chối" class="btn btn-danger btn-sm">
            <i class="material-icons">cancel_schedule_send</i>
          <div class="ripple-container"></div><div class="ripple-container"></div></button>

          <button onclick="location.href='http://localhost/request/admin/request/edit/10186'" type="button" rel="tooltip" title="Tiếp nhận" class="btn btn-primary btn-sm">
            <i class="material-icons">send</i>
          <div class="ripple-container"></div><div class="ripple-container"></div></button> --}}

            <a class="btn btn-sm btn-danger btn-confirm" href="{{route('receive.request', ['username'=>$username, 'requestid' => $e->id, 'status'=>'4'])}}" role="button" rel="tooltip" title="Hủy" confirm="Bạn có chắc chắn 'Hủy' yêu cầu số {{$e->id}}." ><i class="material-icons">highlight_off</i></a>

            @elseif($e->status == 5)
            <a class="btn btn-sm btn-success btn-confirm" href="{{route('receive.request', ['username'=>$username, 'requestid' => $e->id, 'status'=>'6'])}}" role="button" rel="tooltip" title="Kết thúc" confirm="Bạn có chắc chắn 'Hoàn thành' yêu cầu số {{$e->id}}."> <i class="material-icons">verified_user</i></a>
            <a class="btn btn-sm btn-warning btn-confirm" href="{{route('receive.request', ['username'=>$username, 'requestid' => $e->id, 'status'=>'2'])}}" role="button" rel="tooltip" title="Thực hiện lại" confirm="Bạn có chắc chắn 'Thực hiện lại' yêu cầu số {{$e->id}}."><i class="material-icons">restore</i></a>

            @elseif($e->status == 3)
            <a class="btn btn-sm btn-danger btn-confirm" href="{{route('receive.request', ['username'=>$username, 'requestid' => $e->id, 'status'=>'4'])}}" role="button" rel="tooltip" title="Hủy" confirm="Bạn có chắc chắn 'Hủy' yêu cầu số {{$e->id}}."><i class="material-icons">highlight_off</i></a>

            <a class="btn btn-sm btn-warning btn-confirm" href="{{route('receive.request', ['username'=>$username, 'requestid' => $e->id, 'status'=>'2'])}}" role="button" rel="tooltip" title="Thực hiện lại" confirm="Bạn có chắc chắn 'Thực hiện lại' yêu cầu số {{$e->id}}."><i class="material-icons">restore</i></a>
            @elseif($e->status == 4 || $e->status == 6 )
            <a class="btn btn-sm btn-warning btn-confirm" href="{{route('receive.request', ['username'=>$username, 'requestid' => $e->id, 'status'=>'2'])}}" role="button" rel="tooltip" title="Thực hiện lại" confirm="Bạn có chắc chắn 'Thực hiện lại' yêu cầu số {{$e->id}}."><i class="material-icons">restore</i></a>
            @endif



       
          
        </td>
        
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="row">
  <div class="col-md-12" >
    {!! $request->render() !!}
  </div>
</div>
