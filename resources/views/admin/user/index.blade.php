@extends('layouts.app')

@section('user_nav', 'active')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">users</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">

<div class="card" style="margin-top:20px">
    <table class="table table-striped" style="margin-top:10px">
        <thead>
          <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>No of rides</th>
                <th>Member since</th>
                <th>Action</th>

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Dany</td>
            <td>danym@gmail.com</td>
            <td>+92 307 3376910</td>
            <td>20</td>
            <td>Jun 30,2019 8:40:07 pm</td>
            <td>
                <button class="btn btn-danger">Delete</button>
            </td>
             </tr>
             <tr>
                <td>1</td>
                <td>Dany</td>
                <td>danym@gmail.com</td>
                <td>+92 307 3376910</td>
                <td>20</td>
                <td>Jun 30,2019 8:40:07 pm</td>
                <td>
                    <button class="btn btn-danger">Delete</button>
                </td>
                 </tr>
                 <tr>
                    <td>1</td>
                    <td>Dany</td>
                    <td>danym@gmail.com</td>
                    <td>+92 307 3376910</td>
                    <td>20</td>
                    <td>Jun 30,2019 8:40:07 pm</td>
                    <td>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                     </tr>
         </tbody>
      </table>

</div>
@endsection
