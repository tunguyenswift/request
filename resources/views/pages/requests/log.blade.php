<div class="row">
  <table class="table table-striped table-bordered table-hover table-sm">
    <thead class=" text-primary">
      <th>
        STT
      </th>
      <th>
        Quản lý
      </th>
      <th>
        Người thực hiện
      </th>
      <th>
        Người lưu
      </th>
      <th>
       Trạng thái
      </th>
      <th>
        Thời gian
      </th>
      <th>
        Ghi chú
      </th>

    </thead>
    <tbody>
     @foreach($requestLogs as $e)
     <tr>
      <td>
        {{ $loop->iteration }}
      </td>
      <td>{{$e->support_manager}}</td>
      <td>{{$e->support_user}}</td>
      <td>{{$e->owner}}</td>
      <td>
        {{$e->getStatus->title}}
      </td>
      <td>
        {{$e->created_at->format("d/m/Y H:i:s")}}
      </td>
      <td>{{$e->description}}</td>
     </tr>
     @endforeach
    </tbody>
  </table>
</div>