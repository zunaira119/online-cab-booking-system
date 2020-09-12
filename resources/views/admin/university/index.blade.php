@extends('layouts.app')

@section('driver_nav', 'active')

@section('content')
    <section class="content" >
        <div class="container-fluid">
            <div class="row justify-content-center ">
                <div class="card col-md-9 mt-5">
                    <div class="card-header">
                        <h3>University Of Central Punjab</h3>
                    </div>
                    <div class="card-body">
                        <form role="form">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Latitude</label>
                                    <input type="text" class="form-control" id="lat" name="lat" value="31.446911"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Longitude</label>
                                    <input type="text" class="form-control" id="long" name="long" value="74.268235"/>
                                </div>
                            </div>
                                <div class="form-group  ">
                                    <label>Address</label>
                                    <input type="text" class="form-control" id="address" name="address" />
                                </div>

                            <div class="form-group">
                                <button type="button" {{-- onclick="showLoc(document.getElementById('lat').value,document.getElementById('long').value)" --}} class="btn btn-success float-right">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div id="map" style="height:450px; width:100%; display:none;"></div>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4540.083930877048!2d64.26650735125124!3d21.446413705683756!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3919017432b1835b%3A0xe396992a5b05891c!2sUniversity%20of%20Central%20Punjab!5e1!3m2!1sen!2s!4v1582784052090!5m2!1sen!2s" height="450" frameborder="0" style="border:0; width:100%;" allowfullscreen="" id="imap"></iframe>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
<script>
    function showLoc(lat,long) {
        var latn = parseFloat(lat);
        var longn = parseFloat(long);
        initMap(latn, longn);
        document.getElementById('imap').style.display = "none";
        document.getElementById('map').style.display = "block";
    }
</script>
{{-- <script>
    // Initialize and add the map
    function initMap(lat ,long) {
        // The location of Uluru
        var uluru = { lat: lat, lng: long };
        // The map, centered at Uluru
        var map = new google.maps.Map(
            document.getElementById('map'), { zoom: 15, center: uluru });
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({ position: uluru, map: map });

    }
</script>
--}}
@endsection
