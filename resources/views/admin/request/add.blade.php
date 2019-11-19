@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thêm
                    <small>Yêu cầu</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
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
                <form action="admin/request/add" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Tên yêu cầu</label>
                        <input class="form-control" name="title" placeholder="Vui lòng điền yêu cầu" />
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" rows="3" name="content"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Người tạo</label>
                        <input class="form-control" name="create_by" value="Nguyễn Thế Tú" placeholder="Nguyễn Thế Tú" />
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select class="form-control">
                            
                            <option>Khởi tạo</option>
                       
                        </select>
                    </div>
                    
                    <div class="form-group">

                        <label>Đầu việc</label>
                        <select class="form-control" name="role_id">
                            @foreach($role as $e)
                            <option value="{{$e->id}}">{{$e->name}}</option>
                            @endforeach
                        </select>
                       
                        
                    </div>
                    <div class="form-group">

                        <label>Độ ưu tiên</label>
                        <select class="form-control" name="priority">
                            @foreach($priority as $e)
                            <option value="{{$e->id}}">{{$e->id}} - {{$e->title}}</option>
                            @endforeach
                        </select>
                       
                        
                    </div>
                    <button type="submit" class="btn btn-default">Category Add</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

@stop

@section('javascript')
<script type="text/javascript">
      console.log(456);
</script>
@stop