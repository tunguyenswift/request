@extends('admin.layout.index')

@section('content')
<!-- Page Content -->

<div id="page-wrapper">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách
                    <small>Nhân viên</small>
                    <a href="admin/employee/add"><button type="button" class="btn btn-primary"></button></a>
                </h1>

            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên nhân viên</th>
                        <th>Chức danh</th>
                        <th>Email</th>
                        <th>Phone</th>
                        
                        <th>Mô tả</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $e)
                    <tr class="odd gradeX" align="center">
                        <td>1</td>
                        <td>{{$e->name}}</td>
                        <td>{{$e->chucdanh}}</td>
                        <td>{{$e->email}}</td>
                        <td>{{$e->mobile}}</td>
                        <td>{{$e->description}}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/group/delete"> Delete</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/group/edit/{{$e->id}}">Edit</a></td>
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
