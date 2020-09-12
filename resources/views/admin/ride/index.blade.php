@extends('layouts.app')

@section('driver_nav', 'active')

@section('content')
    <div class="content-header">
        @if(session()->has('alert'))
            <div class="alert alert-{{ session()->get('alert.type') }}">
                {{ session()->get('alert.message') }}
            </div>
        @endif
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">All Rides</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Rides</a></li>
                        <li class="breadcrumb-item active">All Rides</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row ">
                <div class="col-12">
                    <div class="row m-2 " >
                        
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Rides</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                           placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed ">
                                <thead>
                                <tr>
                                    <th>Ride ID</th>
                                    <th>Rider details</th>
                                    <th>Driver details</th>
                                    <th>Booking Details	</th>
                                    <th>Pickup Location</th>
                                    <th>Dropoff Location</th>
                                    <th>Booking Date </th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>371</td>
                                        <td>Iman Tasbih
                                            +6281247391125
                                            laodemuhammad538@gmali.com</td>
                                        <td>Miman Miman
                                            +6281210823322
                                            mhan.dikara.md@gmail.com</td>
                                        <td>Customer didn't come</td>
                                        <td>Thokar Flyover</td>
                                        <td>Kalma Chowk</td>
                                        <td>Thu, Dec 19, 2019 10:20 AM </td>
                                        <td><p class="text-success">Driver Cancel</p></td>
                                    </tr>
                                    <tr>
                                        <td>371</td>
                                        <td>Iman Tasbih
                                            +6281247391125
                                            laodemuhammad538@gmali.com</td>
                                        <td>Miman Miman
                                            +6281210823322
                                            mhan.dikara.md@gmail.com</td>
                                        <td>Inconvenience with driver attitude	</td>
                                        <td>Thokar Flyover</td>
                                        <td>Kalma Chowk</td>
                                        <td>Thu, Dec 19, 2019 10:20 AM </td>
                                        <td><p class="text-success">Customer Cancel</p></td>
                                    </tr>
                                    <tr>
                                        <td>371</td>
                                        <td>Iman Tasbih
                                            +6281247391125
                                            laodemuhammad538@gmali.com</td>
                                        <td>Miman Miman
                                            +6281210823322
                                            mhan.dikara.md@gmail.com</td>
                                        <td>Inconvenience with driver attitude	</td>
                                        <td>Thokar Flyover</td>
                                        <td>Kalma Chowk</td>
                                        <td>Thu, Dec 19, 2019 10:20 AM </td>
                                        <td><p class="text-success">Completed</p></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div>
    </section>
@endsection