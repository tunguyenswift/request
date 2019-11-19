@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Phân Công 
                    <small>Công việc</small>
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
            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
            @endif
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/role_assign/add" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Nhân viên</label>
                        <select class="form-control selectpicker" name="username" data-live-search="true" >
                            <option value="0">Chọn nhân viên</option>
                            @foreach($employee as $item)
                            <option value="{{$item['username']}}" data-tokens="{{$item['username']}}">{{$item['name']}} - {{$item['username']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Đầu việc</label>
                        <select class="form-control selectpicker" name="role_id" data-live-search="true">
                            <option value="0">Chọn Đầu việc</option>
                            <?php role_parent($parent);?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Index</label>
                        <select class="form-control" name="index">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-default">Phân công</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
