@extends('vendor_web.layouts.app')

@section('vendor_dash')
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('webvendor.dash') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Location</li>
            </ol>
        </nav>
        <div class="card shadow">
            <h6 class="mt-3 ml-3 font-weight-bold">Map Location</h6>
            <div class="card-body">
                <div class="col-md-12" id="mapid" style="height: 80vh; width: 100%;">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script type="text/javascript">
        const map = L.map('mapid').setView([27.80, 85.33], 13);

        osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        //google street
        googleMap = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
            maxZoom: 30,
            subdomains:['mt0','mt1','mt2','mt3']
        });

        //google satellite map
        googleSatellite = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
            maxZoom: 30,
            subdomains:['mt0','mt1','mt2','mt3']
        });

        // map scale
        L.control.scale().addTo(map);

        {{--var marker1 = L.marker([{{ $vendor->location->long }}, {{ $vendor->location->lat }}]);--}}
        {{--marker1.bindPopup('<b>My Location <br>{{ $vendor->first_name.' '.$vendor->last_name }}</b> <br> {{ $vendor->phone }}');--}}
        {{--marker1.addTo(map);--}}
        {{--marker1.openPopup();--}}


        {{--var marker2 = L.marker([27.76435451585617, 85.3289122606924]);--}}
        {{--marker2.bindPopup('<b>Rider 1</b> <br> 9841232312');--}}
        {{--marker2.addTo(map);--}}

        L.Routing.control({
            waypoints: [
                L.latLng({{ $vendor->location->long }}, {{ $vendor->location->lat }}),
                L.latLng(27.76435451585617, 85.3289122606924)
            ]
        }).addTo(map);

        //layer controller
        var baseMaps = {
            "OSM": osm,
            "Google Street": googleMap,
            "Google Satellite": googleSatellite
        };

        L.control.layers(baseMaps).addTo(map);







    </script>
@endsection

