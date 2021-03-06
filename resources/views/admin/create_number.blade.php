@extends('admin.layouts.master')
@section('content')
<link href="{{asset('/frontend-assets/js/ckeditor/css/samples.css')}}" rel="stylesheet" />
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
                        <a class="navbar-brand" href="#pablo">Add New Number</a>
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
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Add New Number</h4>
                            </div>

                            <div class="row" style="margin: 0;">
                            	<div class="col-md-12">
                                <form  style="padding-top: 20px;" method="post" action="{{url('dashboard/numbers/save')}}" enctype="multipart/form-data">
                                  {{csrf_field()}}
                            			
                            			 <div class="form-group">
                            				<div class="row">
                            					<div class="col-md-12">
                            						<label>Number</label>
                                        <input type="text" name="number" id="Enter Number" class="form-control" placeholder="Enter Number">
                                      </div>
                            				</div>
                            			</div> 
                            			
                                  <div class="form-group">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <label>Number Status</label>
                                       
                                       <select name="status" id="" class="form-control" required="required">
                                           <option value="0">Available</option>
                                           <option value="1">Booked</option>
                                           <option value="2">Reserved</option>
                                           <option value="3">Unavailable</option>
                                       </select>
                                       
                                      </div>
                                    </div>
                                  </div>
                            			<div class="form-group">
                            				<button type="submit" class="btn btn-success">Add </button>
                            			</div>
                            		</form>
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
<script src="{{asset('/frontend-assets/js/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('/frontend-assets/js/ckeditor/js/sample.js')}}"></script>
<script src="{{asset('/frontend-assets/js/ckeditor/js/sf.js')}}"></script>
@endsection
