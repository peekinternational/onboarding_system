@extends('admin.layouts.master')
@section('content')
<div class="wrapper">
  <div class="main-panel">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
      <div class="container-fluid">
        <div class="navbar-wrapper">
          <div class="navbar-toggle">
            <button type="button" class="navbar-toggler">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
            </button>
          </div>
          <a class="navbar-brand" href="#pablo">User Management</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
          <ul class="navbar-nav">
            <li class="nav-item btn-rotate dropdown">
              <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{Session::get('chat_admin')->name}}
                <p>
                  <span class="d-lg-none d-md-block">Some Actions</span>
                </p>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ url('dashboard/logout') }}">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <!-- <div class="panel-header panel-header-sm">
    </div> -->
    <div class="content">
      <div class="row">
        <div class="col-md-12">
          <form class="form-inline" action="" method="">
            <div class="form-group" style="width: 100%">
              <input type="text" class="form-control" placeholder="Search" style="height: 40px; width: 90%;">
              <input type="button" name="search_btn" class="btn btn-primary" value="Search">
            </div>
          </form>
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"> Users List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                   @if(Session::has('creatuser'))
               <div class="alert alert-success">
                  {{ Session::get('creatuser') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               @endif
                   @if(Session::has('deluser'))
               <div class="alert alert-success">
                  {{ Session::get('deluser') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               @endif
                <table class="table">
                  <thead class=" text-primary">
                    <th>User id</th>
                    <th>Name</th>
                    <th>Company Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    @foreach($alluser as $user)
                    <tr>
                      <td> {{$user->user_id}}</td>
                      <td> {{$user->f_name}}</td>
                      <td> {{$user->company_name}}</td>
                      <td> {{$user->mobile}}</td>
                      <td> {{$user->email}}</td>
                      <td>{{$user->status}}</td>
                      <td>
                        <a href="{{url('dashboard/edit-user/'.$user->user_id)}}"><i class="fa fa-edit"></i></a>
                        <a onclick="return confirm('Do you want to delete this item?')" href="{{url('dashboard/user/delete/'.$user->user_id)}}"><i class="fa fa-trash text-danger"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
@endsection