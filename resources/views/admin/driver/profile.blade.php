@extends('layouts.app')

@section('user_nav', 'active')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Drivername</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card col-12">
                <div class="card-header text-center">
                    <h3>Driver Profile</h3>
                </div>
            </div>
                <div class="row">
                        <div class="col-md-3">
                            <!-- Profile Image -->
                            <div class="card card-success card-outline">
                              <div class="card-body box-profile">
                                <div class="text-center">
                                  <img class="profile-user-img img-fluid img-circle"
                                       src="../../dist/img/user4-128x128.jpg"
                                       alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">Kashif</h3>

                                <p class="text-muted text-center">Driver</p>


                                <a><button class="btn btn-outline-success btn-block">Active</button></a>
                              </div>
                              <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- About Me Box -->
                            <div class="card card-success">
                              <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">
                                <strong><i class="fas fa-phone mr-1"></i> Phone</strong>

                                <p class="text-muted">
                                  +92 307 3376910
                                </p>
                                <hr>
                                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                                <p class="text-muted">
                                  driver@gmail.com
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

                                <p class="text-muted">Faucibus ornare suspendisse sed nisi lacus sed. Pellentesque sit amet porttitor eget dolor morbi non arcu. Eu scelerisque felis imperdiet proin fermentum leo vel orci porta</p>

                                <hr>

                               </div>
                              <!-- /.card-body -->
                            </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="info-box">
                                          <span class="info-box-icon bg-success"><i class="fas fa-car"></i></span>

                                          <div class="info-box-content">
                                            <span class="info-box-text">No of Trips</span>
                                            <span class="info-box-number">410</span>
                                          </div>
                                          <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-warning"><i class="fas fa-taxi"></i></span>

                                            <div class="info-box-content">
                                              <span class="info-box-text">Reserved Seats</span>
                                              <span class="info-box-number">1</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                          </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="info-box">
                                          <span class="info-box-icon bg-primary"><i class="fas fa-user-friends"></i></span>

                                          <div class="info-box-content">
                                            <span class="info-box-text">Available Seats</span>
                                            <span class="info-box-number">3</span>
                                          </div>
                                          <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card-title col-12 text-center m-2"><h3>Vehicle Details</h3></div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="info-box">
                                          <span class="info-box-icon bg-info"><i class="fas fa-copyright"></i></span>

                                          <div class="info-box-content">
                                            <span class="info-box-text">Brand</span>
                                            <span class="info-box-number">Honda</span>
                                          </div>
                                          <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                                            <div class="info-box-content">
                                              <span class="info-box-text">Model</span>
                                              <span class="info-box-number">Civic 2020</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                          </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="info-box">
                                          <span class="info-box-icon bg-warning"><i class="far fa-registered"></i></span>

                                          <div class="info-box-content">
                                            <span class="info-box-text">Registration No.</span>
                                            <span class="info-box-number">Les 9797</span>
                                          </div>
                                          <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="info-box">
                                          <span class="info-box-icon bg-danger"><i class="fas fa-paint-brush"></i></span>

                                          <div class="info-box-content">
                                            <span class="info-box-text">Color</span>
                                            <span class="info-box-number">Red</span>
                                          </div>
                                          <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="info-box">
                                          <span class="info-box-icon bg-success"><i class="fas fa-car"></i></span>

                                          <div class="info-box-content">
                                            <span class="info-box-text">No. of Seats</span>
                                            <span class="info-box-number">4</span>
                                          </div>
                                          <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col mx-2">
                                <button type="button" class="btn bg-gradient-danger btn-lg float-right">Remove</button>
                                <button type="button" class="btn bg-gradient-success btn-lg float-right mx-2">Approve</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section>
@endsection
