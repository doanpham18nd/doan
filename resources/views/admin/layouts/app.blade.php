<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    {{--    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">--}}
    <link href={{ asset("vendor/fontawesome-free/css/all.min.css") }} rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <script type="text/javascript">
        window.Laravel = <?php use Illuminate\Support\Facades\Auth;
        echo json_encode([
            'baseUrl' => url('/'),
            'csrfToken' => csrf_token(),
            'user' => [
                'id' => Auth::check() ? Auth::user()->id : null
            ],
        ]) ?>;
    </script>
    <!-- Custom styles for this template -->
    {{--    <link href={{ asset("css/sb-admin-2.min.css") }} rel="stylesheet">--}}
    <link href={{ asset("css/sb-admin-2.css") }} rel="stylesheet">
    <link rel="stylesheet prefetch" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">

    <!-- Custom styles for this page -->
    <link href={{ asset("vendor/datatables/dataTables.bootstrap4.min.css") }} rel="stylesheet">
</head>
<body id="page-top">
<!-- Bootstrap core JavaScript-->

<div id="wrapper">
    @php
        $path = request()->path();
    @endphp
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Hoa Anh Đào</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{route('dashboard')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item @if(strpos($path, 'schedule')) active menu-open @endif">
            <a class="nav-link @if(!strpos($path, 'schedule')) collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Quản lý lịch trình</span>
            </a>
            <div id="collapseTwo" class="collapse @if(strpos($path, 'schedule')) show @endif "
                 aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item @if($path == 'admin/schedule') active @endif" href="{{route('scheduleList')}}">Danh sách</a>
                    <a class="collapse-item @if($path == 'admin/schedule/add') active @endif" href="{{route('scheduleAdd')}}">Thêm mới</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item @if(strpos($path, 'medicine')) active menu-open @endif">
            <a class="nav-link @if(!strpos($path, 'medicine')) collapsed @endif"  href="#" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Quản lý sản phẩm</span>
            </a>
            <div id="collapseUtilities" class="collapse @if(strpos($path, 'medicine')) show @endif" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item @if($path == 'admin/medicine') active @endif" href="{{route('medicineList')}}">Danh sách</a>
                    <a class="collapse-item @if($path == 'admin/medicine/add') active @endif" href="{{route('medicineAdd')}}">Thêm mới</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item @if(strpos($path, 'article')) active menu-open @endif">
            <a class="nav-link @if(!strpos($path, 'article')) collapsed @endif" href="#" data-toggle="collapse" data-target="#article"
               aria-expanded="true" aria-controls="article">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Quản lý bài viết</span>
            </a>
            <div id="article" class="collapse @if(strpos($path, 'article')) show @endif" aria-labelledby="medicine"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item @if($path == 'admin/article') active @endif" href="{{route('ArticleList')}}">Danh sách</a>
                    <a class="collapse-item @if($path == 'admin/article/add') active @endif" href="{{route('ArticleAdd')}}">Thêm mới</a>
                </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item @if(strpos($path, 'bill')) active menu-open @endif">
            <a class="nav-link @if(!strpos($path, 'bill')) collapsed @endif" href="#" data-toggle="collapse" data-target="#bill"
               aria-expanded="true" aria-controls="bill">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Quản lý đơn hàng</span>
            </a>
            <div id="bill" class="collapse @if(strpos($path, 'bill')) show @endif" aria-labelledby="medicine"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item @if($path == 'admin/bill/waiting-pay') active @endif" href="{{route('waitingPay')}}">Chờ thanh toán</a>
                    <a class="collapse-item @if($path == 'admin/bill/delivering') active @endif" href="{{route('delivering')}}">Đang giao</a>
                    <a class="collapse-item @if($path == 'admin/bill/delivered') active @endif" href="{{route('delivered')}}">Đã giao</a>
                    <a class="collapse-item @if($path == 'admin/bill/cancel') active @endif" href="{{route('cancel')}}">Đã hủy</a>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider">

        <li class="nav-item @if(strpos($path, 'article')) active menu-open @endif">
            <a class="nav-link @if(!strpos($path, 'article')) collapsed @endif" href="#" data-toggle="collapse" data-target="#promotion"
               aria-expanded="true" aria-controls="promotion">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Khuyến mãi</span>
            </a>
            <div id="promotion" class="collapse @if(strpos($path, 'promotion')) show @endif" aria-labelledby="promotion"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item @if($path == 'admin/promotion') active @endif" href="{{route('promotionList')}}">Danh sách</a>
                    <a class="collapse-item @if($path == 'admin/promotion/add') active @endif" href="{{route('promotionAdd')}}">Thêm mới</a>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider">

        <li class="nav-item @if(strpos($path, 'user')) active menu-open @endif">
            <a class="nav-link @if(!strpos($path, 'user')) collapsed @endif" href="#" data-toggle="collapse" data-target="#user"
               aria-expanded="true" aria-controls="user">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Người dùng</span>
            </a>
            <div id="user" class="collapse @if(strpos($path, 'user')) show @endif" aria-labelledby="user"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item @if($path == 'admin/user') active @endif" href="{{route('userIndex')}}">Danh sách</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div id="header">
            </div>
            <div class="container-fluid">
                @yield('content')
            </div>
            <div id="chat">
            </div>
        </div>
    </div>
</div>

<script src= {{ asset("vendor/jquery/jquery.min.js") }}></script>
<script src= {{ asset("vendor/bootstrap/bootstrap.min.js") }}></script>

<!-- Core plugin JavaScript-->
<script src= {{ asset("vendor/jquery-easing/jquery.easing.min.js") }}></script>

<!-- Custom scripts for all pages-->
<script src={{ asset("vendor/sb-admin-2.js") }}></script>

<!-- Page level plugins -->
<script src={{ asset("vendor/datatables/jquery.dataTables.min.js") }}></script>
<script src={{ asset("vendor/datatables/dataTables.bootstrap4.min.js") }}></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/chat.js') }}"></script>
<script src="{{ asset('js/header.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
@yield('script')
<!-- Page level custom scripts -->
{{--<script src={{}}"js/demo/datatables-demo.js"></script>--}}

</body>
</html>
