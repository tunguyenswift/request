@extends('admin.layout.index')

@section('content')
<!-- Page Content -->

<div id="page-wrapper">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Yêu cầu
                    <small>Của tôi</small>
                    <a href="admin/request/add"><button type="button" class="btn btn-primary">Thêm yêu cầu mới</button></a>
                </h1>

            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên đầu việc</th>
                        <th>Mô tả</th>
                        
                        
                        <th>Độ ưu tiên</th>

                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>

                        <th>Trạng thái</th>
                        
                        <th>Người tạo</th>
                        <th>Người thực hiện</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($request as $e)
                    <tr class="odd gradeX" align="center">
                        <td>{{$e->id}}</td>
                        <td>{{$e->title}}</td>
                        <td>{{$e->content}}</td>
                        <td>{{$e->priority}}</td>
                        <td>{{$e->created_at}}</td>
                        <td>{{$e->created_at}}</td>
                        <td>Success</td>
                        <td>Loantt</td>
                        <td>Tunt</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#"> Xóa</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Sửa</a></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
