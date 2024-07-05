<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    @yield('title')
    <!-- Custom fonts for this template-->
    {{-- <link href="{{ asset('/assets/admin/Content/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"> --}}
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Custom styles for this template-->

    <link href="{{ asset('/assets/admin/Content/css/sb-admin-2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/admin/Content/css/sb-admin-2.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/admin/Content/vendor/fontawesome-free/css/all.css') }}" rel="stylesheet" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('admin.partials.sidebar')
        @include('admin.partials.header')
        @yield('content')
        @include('admin.partials.footer')
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ asset('/assets/admin/Content/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/admin/Content/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/assets/admin/Content/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('/assets/admin/Content/js/sb-admin-2.min.js') }}"></script>
