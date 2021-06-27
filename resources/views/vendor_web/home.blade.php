@extends('vendor_web.layouts.app')

@section('vendor_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Starlight</a>
            <span class="breadcrumb-item active">Dashboard</span>
        </nav>

        <div class="sl-pagebody">

            <h1>Vendor dashboard</h1>
            <h6>{{ auth()->user()->first_name }}</h6>

        </div><!-- sl-mainpanel -->
        <!-- ########## END: MAIN PANEL ########## -->
@endsection

