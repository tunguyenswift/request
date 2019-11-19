<div class="table-responsive">
  <table id="dtBasicExample" class="table table-striped table-bordered table-hover table-sm" >
    <thead class=" text-primary">
     
      <th class="th-sm">
        ID
      </th>
      <th class="th-sm">
        Tên đầu việc
      </th>
     <!--  <th>
        Mô tả
      </th> -->
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
        Deadline
      </th>
      <th>
        Trạng thái
      </th> 
      <th>
        
        Người quản lý
      </th>
      <th>
        
        Người thực hiện
      </th>
      
      <th>
        Người tạo
      </th>
      
      <th style="text-align: center;">
        Hành động
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
         {{$e['id']}}
        </td>
        <td>
          {{$e['title']}}
        </td>
        <!-- <td>
          {{$e->content}}
        </td> -->
        <td>
          {{$e->getPriority['title']}}
        </td>
        <td>
          <?php
          $s = $e->created_at;
          $dt = new DateTime($s);
          $date = $dt->format('d/m/Y');
          echo $date;
          ?>
        </td>
        <td>
          <?php
          $s = $e->finish_at;
          if($s === null) {
            $date = "";
          } else {
            $dt = new DateTime($s);
            $date = $dt->format('d/m/Y');
          }
          
          echo $date;
          ?>
        </td>
        <td>
          <?php
          $s = $e->deadline;
          $dt = new DateTime($s);
          $date = $dt->format('d/m/Y');
          echo $date;
          ?>
        </td>
        <td>
          
          {{$e->getStatus['title']}}
        </td>
        <td>
          {{$e->support_manager}}
        </td>
        <td>
          
          {{$e->support_user}}
        </td>
        
        <td>
          {{$e->CreateBy['username']}}
        </td>
        
        
        
        <td class="text-primary" style="text-align: center;">
          <a rel="tooltip" class="btn btn-success btn-link" href="{{route($editPage, array('id'=> $e->id))}}" data-original-title="" title="Sửa">
            <i class="material-icons">edit</i>
            <!-- Sửa -->
            <div class="ripple-container"></div>
            <?php
            if($activePage == 'request.list') {
            ?>
            <a rel="tooltip" class="btn btn-success btn-link" href="delete/{{$e->id}}" data-original-title="" title="Xóa">

            <i class="material-icons">delete</i>
            Xóa
            <div class="ripple-container"></div>
            
            <?php
            } 
            ?>
            
          </a>
          </a>
          
        </td>
        
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
  <div class="row">
    
    <div class="col-md-6">
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
    <div class="col-md-6">
      {!! $request->render() !!}
    </div>
  </div>

