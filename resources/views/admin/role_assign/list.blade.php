@extends('admin.layout.index')

@section('content')
<!-- Page Content -->

<div id="page-wrapper">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách
                    <small>Phân công đầu việc</small>
                    <a href="admin/role_assign/add"><button type="button" class="btn btn-primary">Phân công Mới</button></a>
                </h1>

            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <!-- <th>Đầu việc lớn</th> -->
                        <th>Đầu việc</th>
                        <th>Người phụ trách</th>
                        <!-- <th>Người phụ trách (2)</th>
                        <th>Người phụ trách (3)</th> -->
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roleassign as $e)
                    <tr class="odd gradeX" align="center">
                        <td>{{$e->id}}</td>
                        <!-- <td>Tạo email</td> -->
                        <td>{{$e->Role->name}}</td>
                        <td>{{$e->Employee->name}}</td>
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
