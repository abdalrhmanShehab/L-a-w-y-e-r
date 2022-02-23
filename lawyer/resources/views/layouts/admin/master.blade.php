<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Starter</title>

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css?v=3.2.0')}}">
    <script nonce="ad7b7cda-75c1-4b2c-b216-879bb94e224b">(function (w, d) {
            !function (a, e, t, r, z) {
                a.zarazData = a.zarazData || {}, a.zarazData.executed = [], a.zarazData.tracks = [], a.zaraz = {deferred: []};
                var s = e.getElementsByTagName("title")[0];
                s && (a.zarazData.t = e.getElementsByTagName("title")[0].text), a.zarazData.w = a.screen.width, a.zarazData.h = a.screen.height, a.zarazData.j = a.innerHeight, a.zarazData.e = a.innerWidth, a.zarazData.l = a.location.href, a.zarazData.r = e.referrer, a.zarazData.k = a.screen.colorDepth, a.zarazData.n = e.characterSet, a.zarazData.o = (new Date).getTimezoneOffset(), a.dataLayer = a.dataLayer || [], a.zaraz.track = (e, t) => {
                    for (key in a.zarazData.tracks.push(e), t) a.zarazData["z_" + key] = t[key]
                }, a.zaraz._preSet = [], a.zaraz.set = (e, t, r) => {
                    a.zarazData["z_" + e] = t, a.zaraz._preSet.push([e, t, r])
                }, a.dataLayer.push({"zaraz.start": (new Date).getTime()}), a.addEventListener("DOMContentLoaded", (() => {
                    var t = e.getElementsByTagName(r)[0], z = e.createElement(r);
                    z.defer = !0, z.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(a.zarazData))), t.parentNode.insertBefore(z, t)
                }))
            }(w, d, 0, "script");
        })(window, document);</script>
    <link rel="stylesheet" href="{{asset('assetes/fontawesome-free/css/all.min.css')}}">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('layouts.admin.header');
    @include('layouts.admin.aside');


    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                {{--                <div class="row mb-2">--}}
                {{--                    <div class="col-sm-6">--}}
                {{--                        <h1 class="m-0">Users Management</h1>--}}
                {{--                    </div>--}}
                {{--                    <div class="col-sm-6">--}}
                {{--                        <ol class="breadcrumb float-sm-right">--}}
                {{--                            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                {{--                            <li class="breadcrumb-item active">Users Management</li>--}}
                {{--                        </ol>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>


        <div class="content">
            <div class="container-fluid">
                @yield('content')

            </div>
        </div>

    </div>


    @include('layouts.admin.footer');
</div>


<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('assets/dist/js/adminlte.min.js?v=3.2.0')}}"></script>
<script src="{{asset('assets/fontawesome-free/js/all.min.js')}}"></script>
</body>
</html>
