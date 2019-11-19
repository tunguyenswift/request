<?php
$username = Cookie::get('usernamethm');
?>
<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      <img class="responsive-img" src="{{ asset('material') }}/img/logo.png" style="width: 200px;" />
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <!-- <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('mydashboard') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li> -->

      <li class="nav-item ">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample1" aria-expanded="true">
          <i><img style="width:25px" src="https://material-dashboard-laravel.creative-tim.com/material/img/laravel.svg"></i>
          <p>Yêu cầu của tôi
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample1" style="">
          <ul class="nav">
            <!-- <li class="nav-item{{ $activePage == 'request.add' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('request.add') }}">
                <span class="sidebar-mini"> <i class="material-icons">content_paste</i> </span>
                <span class="sidebar-normal">Tạo yêu cầu</span>
              </a>
            </li> -->
            <li class="nav-item{{ $activePage == 'myrequest.list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('myrequest.list', ['username' => $username]) }}">
                <span class="sidebar-mini"> <i class="material-icons">content_paste</i> </span>
                <span class="sidebar-normal">Yêu cầu đi</span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'myrequested.list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('myrequested.list', ['username' => $username]) }}">
                <span class="sidebar-mini"> <i class="material-icons">content_paste</i> </span>
                <span class="sidebar-normal">Yêu cầu đến</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item ">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample1" aria-expanded="true">
          <i><img style="width:25px" src="https://material-dashboard-laravel.creative-tim.com/material/img/laravel.svg"></i>
          <p>Quản lý
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample1" style="">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'managerrequested.list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('managerrequested.list', ['username' => $username]) }}">
                <span class="sidebar-mini"> <i class="material-icons">content_paste</i> </span>
                <span class="sidebar-normal">Công việc cấp dưới</span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'request.list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('request.list') }}">
                <span class="sidebar-mini"> <i class="material-icons">content_paste</i> </span>
                <span class="sidebar-normal">Admin - Quản lý yêu cầu </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item ">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample2" aria-expanded="true">
          <i><img style="width:25px" src="https://material-dashboard-laravel.creative-tim.com/material/img/laravel.svg"></i>
          <p>Hệ thống
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample2" style="">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'role.list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('role.list') }}">
                <span class="sidebar-mini"> <i class="material-icons">content_paste</i> </span>
                <span class="sidebar-normal">Danh mục công việc</span>
              </a>
            </li>
            <!-- <li class="nav-item{{ $activePage == 'role_assign.list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('role_assign.list') }}">
                <span class="sidebar-mini"> <i class="material-icons">content_paste</i> </span>
                <span class="sidebar-normal">Phân công công việc </span>
              </a>
            </li> -->
            <li class="nav-item{{ $activePage == 'group.list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('group.list') }}">
                <span class="sidebar-mini"> <i class="material-icons">content_paste</i> </span>
                <span class="sidebar-normal">Danh sách phòng ban </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'employee.list' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('employee.list') }}">
                <span class="sidebar-mini"> <i class="material-icons">content_paste</i> </span>
                <span class="sidebar-normal">Danh sách nhân viên </span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item ">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample2" aria-expanded="true">
          <i><img style="width:25px" src="https://material-dashboard-laravel.creative-tim.com/material/img/laravel.svg"></i>
          <p>Báo cáo
            <b class="caret"></b>
          </p>
        </a>
        {{-- <div class="collapse show" id="laravelExample2" style="">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('role.list') }}">
                <span class="sidebar-mini"> <i class="material-icons">content_paste</i> </span>
                <span class="sidebar-normal">Tổng quan</span>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="{{ route('group.list') }}">
                <span class="sidebar-mini"> <i class="material-icons">content_paste</i> </span>
                <span class="sidebar-normal">Báo cáo tuần</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('employee.list') }}">
                <span class="sidebar-mini"> <i class="material-icons">content_paste</i> </span>
                <span class="sidebar-normal">Báo cáo tháng</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('employee.list') }}">
                <span class="sidebar-mini"> <i class="material-icons">content_paste</i> </span>
                <span class="sidebar-normal"></span>
              </a>
            </li>
          </ul>
        </div> --}}
      </li>
      
     
      


 

    </ul>
  </div>
</div>