<div class="table-responsive">
  <style type="text/css">
   
  </style>
  <table class="table table-striped table-bordered table-hover table-sm" style="border-top: 1px solid #efefef;">
    <thead class=" text-primary">
     

      <th >
        <p style="width: 50px; height: 10px;">ID</p>
      </th>
      <th >
        <p style="width: 50px; height: 10px;">Yêu cầu</p>
      </th>
     <!--  <th>
        Mô tả
      </th> -->
      <th class="d-none d-lg-table-cell">
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
        <p style="width: 70px; height: 10px;">Hành động</p>
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
        $class = "delay";
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
          $linkUrl = 'http://'.$_SERVER['HTTP_HOST']."/request/admin/request/requestdetail/".$e->id;
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
        
        <td class="d-none d-lg-table-cell">
          {{$e->getPriority['title']}}
        </td>
        <td class="d-none d-lg-table-cell">
          {{(new DateTime($e->created_at))->format('d/m/Y')}}
        </td>
        <td class="d-none d-lg-table-cell">
          {{(new DateTime($e->finish_at))->format('d/m/Y')}}
        </td>
        <td >
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
        <td class="td-actions text-right" style="text-align: center;">
          <button onclick="location.href='{{route($editPage, array('id'=> $e->id))}}'" type="button" rel="tooltip" title="Sửa" class="btn btn-primary btn-sm">
            <i class="material-icons">edit</i>
          <div class="ripple-container"></div></button>
            <!-- Sửa -->
            <?php
            if($activePage == 'request.list') {
            ?>
            
            <button onclick="location.href='delete/{{$e->id}}'" type="button" rel="tooltip" title="Xóa" class="btn btn-danger btn-sm">
              <i class="material-icons">close</i>
            </button>
            <?php
            } 
            ?> 
          
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
