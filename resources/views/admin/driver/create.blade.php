@extends('layouts.app')

@section('driver_nav', 'active')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Drivers</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item "><a href="#">Drivers</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content" style="padding: 20px; ">
        <div class="container-fluid main-content">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-success ">
                        <div class="card-header text-center">
                            <h3 class="card-title ">Add Driver</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="#"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-row">

                                    <div class="form-group col-md-4">
                                        <div class="qr-el qr-el-3"
                                             style="min-height: auto;  box-shadow: 2px 0px 30px 5px rgba(0, 0, 0, 0.03); padding:25px; margin:0px 20px;">
                                            <label for="upload_file" class="hoviringdell uploadBox"
                                                   id="uploadTrigger"
                                                   style="height: 110px; text-align:center; width:100%; border:dotted 2px #cccccc;">
                                                <img src="" style="width: 180px;" id="profile" alt="image">
                                                <div class="uploadText" style="font-size: 12px;">
                                                    <span style="color:#F69518;">Upload Profile Image</span><br>
                                                    Size 320x220
                                                </div>
                                            </label>
                                            <input type="file" id="upload_file" name="profile" onchange="prof(this);">
                                            @if($errors->has('image'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="qr-el qr-el-3"
                                             style="min-height: auto;  box-shadow: 2px 0px 30px 5px rgba(0, 0, 0, 0.03); padding:25px; margin:0px 20px;">
                                            <label for="upload_file" class="hoviringdell uploadBox"
                                                   id="uploadTrigger"
                                                   style="height: 110px; text-align:center; width:100%; border:dotted 2px #cccccc;">
                                                <img src="" style="width: 180px;" id="front-image" alt="image">
                                                <div class="uploadText" style="font-size: 12px;">
                                                    <span style="color:#F69518;">CNIC Front Picture</span><br>
                                                    Size 320x220
                                                </div>
                                            </label>
                                            <input type="file" id="upload_file" name="front-image" onchange="front_img(this);">
                                            @if($errors->has('image'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="qr-el qr-el-3"
                                             style="min-height: auto;  box-shadow: 2px 0px 30px 5px rgba(0, 0, 0, 0.03); padding:25px; margin:0px 20px;">
                                            <label for="upload_file" class="hoviringdell uploadBox"
                                                   id="uploadTrigger"
                                                   style="height: 110px; text-align:center; width:100%; border:dotted 2px #cccccc;">
                                                <img src="" style="width: 180px;" id="back-image" alt="image">
                                                <div class="uploadText" style="font-size: 12px;">
                                                    <span style="color:#F69518;">CNIC Back Picture</span><br>
                                                    Size 320x220
                                                </div>
                                            </label>
                                            <input type="file" id="upload_file" name="back-image" onchange="back_img(this);">
                                            @if($errors->has('image'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group ">
                                    <h4 style="text-align:center; padding:10px; margin-top:50px;"
                                        class="text-light bg-dark">
                                        Add New Driver And Vehicle
                                    </h4>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" value="{{old('name')}}"
                                               class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                               id="name" placeholder="">
                                        @if($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" value="{{old('email')}}"
                                               class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               id="email" placeholder="">
                                        @if($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="pass">Password</label>
                                        <input type="password" name="password"
                                               class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               id="pass" placeholder="">
                                        @if($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" value="{{old('phone')}}"
                                               class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                               id="phone">
                                        @if($errors->has('phone'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" value="{{old('address')}}"
                                               class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                                               id="address" placeholder="">
                                        @if($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="cnic">No. Of Seats</label>
                                        <input type="text" value="{{old('cnic')}}" name="cnic"
                                               class="form-control {{ $errors->has('cnic') ? ' is-invalid' : '' }}"
                                               id="cnic" placeholder="">
                                        @if($errors->has('cnic'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cnic') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="address">Vehicle Brand</label>
                                        <input type="text" name="address" value="{{old('address')}}"
                                               class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                                               id="address" placeholder="">
                                        @if($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="address">Vehicle Number</label>
                                        <input type="text" name="address" value="{{old('address')}}"
                                               class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                                               id="address" placeholder="">
                                        @if($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="address">Vehicle Model</label>
                                        <input type="text" name="address" value="{{old('address')}}"
                                               class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                                               id="address" placeholder="">
                                        @if($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="address">Vehicle Color</label>
                                        <input type="text" name="address" value="{{old('address')}}"
                                               class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                                               id="address" placeholder="">
                                        @if($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="address">Vehicle Registration No</label>
                                        <input type="text" name="address" value="{{old('address')}}"
                                               class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                                               id="address" placeholder="">
                                        @if($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="address">Licence No</label>
                                        <input type="text" name="address" value="{{old('address')}}"
                                               class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"
                                               id="address" placeholder="">
                                        @if($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-lg float-right" >Submit</button>
                                <button type="reset" class="btn btn-default btn-lg float-right mr-2">Cancel</button>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>

@endsection

@section('script')
<script>
    function prof(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profile')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function front_img(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#front-image')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function back_img(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#back-image')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
