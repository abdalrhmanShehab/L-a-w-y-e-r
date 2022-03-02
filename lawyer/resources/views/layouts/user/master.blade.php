<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lawyer</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/userTemplate/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet"
          type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom styles for this template-->
    <link href="{{asset('assets/userTemplate/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

@include('layouts.user.aside')

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

        @include('layouts.user.navbar')

        <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('content')
            </div>
        @include('layouts.user.footer')
        <!-- Footer -->
            <!-- End of Footer -->
            <!-- Bootstrap core JavaScript-->
{{--            <script src="{{asset('assets/userTemplate/vendor/jquery/jquery.min.js')}}"></script>--}}
            <script src="{{asset('assets/userTemplate/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

            <!-- Core plugin JavaScript-->
            <script src="{{asset('assets/userTemplate/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

            <!-- Custom scripts for all pages-->
            <script src="{{asset('assets/userTemplate/js/sb-admin-2.min.js')}}"></script>

            <!-- Page level plugins -->
            <script src="{{asset('assets/userTemplate/vendor/chart.js/Chart.min.js')}}"></script>

            <!-- Page level custom scripts -->
            <script src="{{asset('assets/userTemplate/js/demo/chart-area-demo.js')}}"></script>
            <script src="{{asset('assets/userTemplate/js/demo/chart-pie-demo.js')}}"></script>

            <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                    crossorigin="anonymous"></script>

            <!-- sweet alert -->
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </div>
    </div>
</div>
</body>

</html>
