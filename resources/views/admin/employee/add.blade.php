@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Employee
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="" method="POST">
                    
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" name="txtCateName" placeholder="Please Enter Employee Name" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="txtCateName" placeholder="Please Enter Email" />
                    </div>
                    <div class="form-group">
                        <label>Vider</label>
                        <input class="form-control" name="txtCateName" placeholder="Please Enter Viber" />
                    </div>
                    <div class="form-group">
                        <label>Category Description</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Group</label>
                        <select class="form-control">
                            <option value="0">Please Choose Group</option>
                            <option value="">Tin Tức</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Category Status</label>
                        <label class="radio-inline">
                            <input name="rdoStatus" value="1" checked="" type="radio">Visible
                        </label>
                        <label class="radio-inline">
                            <input name="rdoStatus" value="2" type="radio">Invisible
                        </label>
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
<!-- /#page-wrapper -->
@endsection
