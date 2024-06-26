<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="ecommerce product">
    <meta name="author" content=" ">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin</title>

    <!-- vendor css -->
    <link href="{{ asset('backend/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/rickshaw/rickshaw.min.css') }}" rel="stylesheet">

    <!-- Tags Input CDN CSS -->
    <link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet"/>

    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/starlight.css') }}">
    <link href="{{ asset('backend/lib/summernote/summernote-bs4.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <!-- Datatable -->
    <link href="{{ asset('backend/lib/highlightjs/github.css') }}" rel="stylesheet">
{{--    <link href="{{ asset('backend/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <link href="{{ asset('backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css">
    <style>
        .dataTable {
            white-space: nowrap;
        }

        .admin-user-icon{
            background: #5b8ebe;
            padding: 8px 12px 8px 12px;
            color: white;
            font-size: 14px;
            font-weight: 700;
            border: 3px solid #6f42c1;
        }
    </style>
</head>

<body>

@guest

@else
    <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo"><a href="">Sathixa</a></div>
    <div class="sl-sideleft">

        <div class="sl-sideleft-menu">

            <a href="{{ route('admin.home') }}" class="sl-menu-link @if(Request::path() == 'admin/home') active @endif">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                    <span class="menu-item-label">Dashboard</span>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->

            <a href="#" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon ion-ios-people tx-20"></i>
                    <span class="menu-item-label">Admin Users</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column" @if(in_array(Request::path(), ['admin/adminuser', 'admin/register'])) style="display: block" @endif>
                <li class="nav-item"><a href="{{ route('adminuser.index') }}" class="nav-link  @if( Request::path() == 'admin/adminuser') active @endif">All User</a></li>
                <li class="nav-item"><a href="{{ route('admin.register') }}" class="nav-link @if( Request::path() == 'admin/register') active @endif">Add User</a></li>
            </ul>

            <a href="#" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon ion-ios-people tx-20"></i>
                    <span class="menu-item-label">Riders</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('rider.index') }}" class="nav-link">All Rider</a></li>
                <li class="nav-item"><a href="{{ route('rider.create') }}" class="nav-link">Add Rider</a></li>
            </ul>

            <a href="#" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-person-stalker tx-20"></i>
                    <span class="menu-item-label">Vendors</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('admin_vendor.index') }}" class="nav-link">All Vendor</a></li>
                <li class="nav-item"><a href="{{ route('admin_vendor.create') }}" class="nav-link">Add Vendor</a></li>
            </ul>

            <a href="#" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-filing tx-20"></i>
                    <span class="menu-item-label">Packages</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{ route('admin_package.index') }}" class="nav-link">All Packages</a></li>
                <li class="nav-item"><a href="{{ route('admin_package.create') }}" class="nav-link">Add Package</a></li>
            </ul>

            <a href="#" class="sl-menu-link">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-filing tx-20"></i>
                    <span class="menu-item-label">Ticket</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column" @if(in_array(Request::path(), ['admin/ticket'])) style="display: block" @endif>
                <li class="nav-item"><a href="{{ route('ticket.index') }}" class="nav-link  @if( Request::path() == 'admin/ticket' && request()->type != 'closed') active @endif">Active Ticket</a></li>
                <li class="nav-item"><a href="{{ route('ticket.index', ['type' => 'closed']) }}" class="nav-link  @if( request()->type == 'closed') active @endif">Closed Ticket</a></li>
            </ul>



        </div><!-- sl-sideleft-menu -->

        <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="sl-header">
        <div class="sl-header-left">
            <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
            <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
        </div><!-- sl-header-left -->
        <div class="sl-header-right">
            <nav class="nav">
                <div class="dropdown">
                    <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                        <span class="logged-name"><span class="hidden-md-down">{{ auth()->user()->name }}</span></span>
                        <img src="{{ asset('/backend/img/avatar.jpg') }}" class="wd-32 rounded-circle" alt="">
                    </a>
                    <div class="dropdown-menu dropdown-menu-header wd-200">
                        <ul class="list-unstyled user-profile-nav">
                            <li><a href=""><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
                            <li><a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();
                                "><i class="icon ion-power"></i> Sign Out</a>
                            </li>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </div><!-- dropdown-menu -->
                </div><!-- dropdown -->
            </nav>
            <div class="navicon-right">
                <a id="btnRightMenu" href="" class="pos-relative">
                    <i class="icon ion-ios-bell-outline"></i>
                    <!-- start: if statement -->
                    <span class="square-8 bg-danger"></span>
                    <!-- end: if statement -->
                </a>
            </div><!-- navicon-right -->
        </div><!-- sl-header-right -->
    </div><!-- sl-header -->
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    <div class="sl-sideright">
        <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" role="tab" href="#messages">Messages (2)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" role="tab" href="#notifications">Notifications (8)</a>
            </li>
        </ul><!-- sidebar-tabs -->

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane pos-absolute a-0 mg-t-60 active" id="messages" role="tabpanel">
                <div class="media-list">
                    <!-- loop starts here -->
                    <a href="" class="media-list-link">
                        <div class="media">
                            <img src="{{ asset('/backend/img/img3.jpg') }}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                                <p class="mg-b-0 tx-medium tx-gray-800 tx-13">Donna Seay</p>
                                <span class="d-block tx-11 tx-gray-500">2 minutes ago</span>
                                <p class="tx-13 mg-t-10 mg-b-0">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.</p>
                            </div>
                        </div><!-- media -->
                    </a>
                    <!-- loop ends here -->
                </div><!-- media-list -->
                <div class="pd-15">
                    <a href="" class="btn btn-secondary btn-block bd-0 rounded-0 tx-10 tx-uppercase tx-mont tx-medium tx-spacing-2">View More Messages</a>
                </div>
            </div><!-- #messages -->

            <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="notifications" role="tabpanel">
                <div class="media-list">
                    <!-- loop starts here -->
                    <a href="" class="media-list-link read">
                        <div class="media pd-x-20 pd-y-15">
                            <img src="{{ asset('/backend/img/img8.jpg') }}" class="wd-40 rounded-circle" alt="">
                            <div class="media-body">
                                <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Suzzeth Bungaos</strong> tagged you and 18 others in a post.</p>
                                <span class="tx-12">October 03, 2017 8:45am</span>
                            </div>
                        </div><!-- media -->
                    </a>
                    <!-- loop ends here -->

                </div><!-- media-list -->
            </div><!-- #notifications -->

        </div><!-- tab-content -->
    </div><!-- sl-sideright -->
    <!-- ########## END: RIGHT PANEL ########## --->


@endguest

@yield('admin_content')

<script src="{{ asset('backend/lib/jquery/jquery.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('backend/lib/popper.js/popper.js') }}"></script>
<script src="{{ asset('backend/lib/bootstrap/bootstrap.js') }}"></script>
<script src="{{ asset('backend/lib/jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('backend/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
<!-- Datatable -->
<script src="{{ asset('backend/lib/highlightjs/highlight.pack.js') }}"></script>
{{--<script src="{{ asset('backend/lib/datatables/jquery.dataTables.js') }}"></script>--}}
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('backend/lib/buttons.server-side.js') }}"></script>
<script src="{{ asset('backend/lib/datatables-responsive/dataTables.responsive.js') }}"></script>
<script src="{{ asset('backend/lib/select2/js/select2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


<script src="{{ asset('backend/lib/jquery.sparkline.bower/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('backend/lib/d3/d3.js') }}"></script>
<script src="{{ asset('backend/lib/rickshaw/rickshaw.min.js') }}"></script>
<script src="{{ asset('backend/lib/chart.js/Chart.js') }}"></script>
<script src="{{ asset('backend/lib/Flot/jquery.flot.js') }}"></script>
<script src="{{ asset('backend/lib/Flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('backend/lib/Flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('backend/lib/flot-spline/jquery.flot.spline.js') }}"></script>


<script src="{{ asset('backend/lib/medium-editor/medium-editor.js') }}"></script>
<script src="{{ asset('backend/lib/summernote/summernote-bs4.min.js ') }}"></script>

<script>
    $(function(){
        'use strict';

        // Inline editor
        var editor = new MediumEditor('.editable');

        // Summernote editor
        $('#summernote').summernote({
            height: 150,
            tooltip: false
        })
    });
</script>

<script>
    $(function(){
        'use strict';

        // Inline editor
        var editor = new MediumEditor('.editable');

        // Summernote editor
        $('#summernote1').summernote({
            height: 150,
            tooltip: false
        })
    });
</script>

<script src="{{ asset('backend/js/starlight.js') }}"></script>
<script src="{{ asset('backend/js/ResizeSensor.js') }}"></script>
<script src="{{ asset('backend/js/dashboard.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
<!-- Main js -->

<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

<script>
    if(sessionStorage.getItem('items'))
    {
        var msgArray = JSON.parse(sessionStorage.getItem('items'));
        var type = msgArray[1];
        switch(type)
        {
            case 'info':
                toastr.info(msgArray[0]);
                sessionStorage.removeItem('items');
                break;

            case 'success':
                toastr.success(msgArray[0]);
                sessionStorage.removeItem('items');
                break;

            case 'warning':
                toastr.warning(msgArray[0]);
                sessionStorage.removeItem('items');
                break;

            case 'error':
                toastr.error(msgArray[0]);
                sessionStorage.removeItem('items');
                break;

        }
    }
</script>

<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type)
    {
        case 'info':
            toastr.info(" {{ Session::get('message')}} ");
            break;

        case 'success':
            toastr.success(" {{ Session::get('message')}} ");
            break;

        case 'warning':
            toastr.warning(" {{ Session::get('message')}} ");
            break;

        case 'error':
            toastr.error(" {{ Session::get('message')}} ");
            break;
    }
    @endif
</script>
<script>
    $(document).on("click", "#delete", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
            title: "Are you Want to delete?",
            text: "Once Delete, This will be Permanently Delete!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                } else {
                    swal("Safe Data!");
                }
            });
    });
</script>

@yield('js')
</body>
</html>
