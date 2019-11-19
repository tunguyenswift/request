<p>
	<b>Mô tả:</b>{{$request->title}}
</p>
<p>
	<b>Mô tả:</b>{{$request->content}}
</p>

<p>
 	<b>Người tạo:</b>{{$request->create_by}}
</p>

<p>
 	<b>Trạng thái:</b>{{$request->getStatus->title}}
</p>

<p>
 	<b>Độ ưu tiên:</b>{{$request->getPriority->title}}
</p>
<p>
 	<b>Deadline:</b>{{(new DateTime($request->deadline))->format('d/m/Y')}}
</p>
<p>
 	<b>Ngày tạo:</b>{{(new DateTime($request->created_at))->format('d/m/Y')}}
</p>
<p>
 	<b>Ngày hoàn thành:</b>{{(new DateTime($request->finish_at))->format('d/m/Y')}}
</p>
<p>
 	<b>Quản lý:</b>{{$request->support_manager}}
</p>
<p>
 	<b>Thực hiện:</b>{{$request->support_user}}
</p>