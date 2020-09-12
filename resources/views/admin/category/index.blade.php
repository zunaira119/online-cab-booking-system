@extends('layouts.app')

@section('category_nav', 'active')

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
                    <h1 class="m-0 text-dark">Ride Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="row m-2 justify-content-end" >
                        <button class="btn btn-success">+ Add Category</button>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Category</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                           placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search text-success"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-striped table-bordered p-0">
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Kashi</td>
                                        <td>
                                            <button class="btn btn-success">Edit</button>
                                            <button class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Kashi</td>
                                        <td>
                                            <button class="btn btn-success">Edit</button>
                                            <button class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                {{-- @foreach($drivers as $index => $driver)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{$driver->name}}</td>
                                        <td>{{$driver->email}}</td>
                                        <td>{{$driver->address}}</td>
                                        <td>{{$driver->phone}}</td>
                                        <td>{{$driver->cnic}}</td>
                                        <td>
                                            <a href="{{ route('admin.change_driver_active_status', $driver->id) }}">
                                                <span
                                                    class="badge badge-{{ $driver->approved ? 'success' : 'danger' }}">{{ $driver->approved ? 'Active' : 'Inactive' }}</span>
                                            </a>
                                        </td>
                                        <td>
                                            <button class="btn btn-default">View</button>
                                            <a href="{{ route('driver.edit', $driver->id) }}"
                                               class="btn btn-outline-info">Edit</a>
                                            <a href="javascript:void(0);" onclick="$(this).find('form').submit();"
                                               class="btn btn-outline-danger">
                                                Delete
                                                <form action="{{ route('driver.destroy', $driver->id) }}"
                                                      method="post"
                                                      onsubmit="return confirm('Do you really want to delete this driver?');">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach --}}
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
