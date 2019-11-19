@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Group
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Group name</label>
                        <input class="form-control" name="name" placeholder="Please Enter Group Name" />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Leader</label>
                        <select class="form-control" name="leader">
                            <option value="0">Please Choose Leader</option>
                            <option value="Trưởng phòng 1">Trưởng phòng 1</option>
                            <option value="Trưởng phòng 2">Trưởng phòng 2</option>
                            <option value="Trưởng phòng 3">Trưởng phòng 3</option>
                            <option value="Trưởng phòng 4">Trưởng phòng 4</option>
                            <option value="Trưởng phòng 5">Trưởng phòng 5</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">Group Add</button>
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
