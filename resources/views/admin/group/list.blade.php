@extends('admin.layout.index')

@section('content')
<!-- Page Content -->

<div id="page-wrapper">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Group
                    <small>List</small>
                    <a href="admin/group/add"><button type="button" class="btn btn-primary">Add New Group</button></a>
                </h1>

            </div>
            <!-- /.col-lg-12 -->
            @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
            </div>
            @endif
            @if(session('notify'))
                <div class="alert alert-success">
                    {{session('notify')}}
                </div>
            @endif
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên phòng ban</th>
                        <th>Mô tả</th>
                        <th>Quản lý</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($group as $e)
                    <tr class="odd gradeX" align="center">
                        <td>1</td>
                        <td>{{$e->name}}</td>
                        <td>{{$e->description}}</td>
                        <td>Trường Phòng 1</td>
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
