<?php
/**
 * Created by PhpStorm.
 * User: nobikun1412
 * Date: 12-Jun-17
 * Time: 00:20
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('meta-title', 'Reading English') - Ucendu</title>
    <link rel="stylesheet" href="{{asset('/libs/bootstrap/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('/libs/font-awesome/css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/client/readingLessonDetail.css')}}">
    <link rel="stylesheet" href="{{asset('/css/my-style.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/client/responsive.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/admin/admin-style.css')}}">
    <link rel="stylesheet" href="{{asset('/libs/toolbar/jquery.toolbar.css')}}" />
    <script>
        var current_username = {!! json_encode(Auth::user()->username) !!};
        var current_user_id = {!! json_encode(Auth::id()) !!};
        var current_user_avatar = {!! json_encode(Auth::user()->avatar) !!};
        var current_level_user = {!! json_encode(Auth::user()->level_user_id) !!};
    </script>
    @yield('css')
</head>
<body data-hijacking="on" data-animation="parallax">
<a href="#" id="allownoti" class="hidden">Cho phép thông báo</a>
<a href="#" id="shownoti" class="hidden">Hiển thị thông báo</a>
<div class="overlay"></div>
<div id="loading"></div>
@include('layout.headerAdmin')
@include('layout.menuHeaderAdmin')
<div role="main" class="main main-page">
    {{--@include('layout.tabContentReading')--}}

    @yield('top-information')

    @yield('content')

</div>

{{--@include('layout.footer')--}}
<script src="{{asset('/libs/tether/tether.min.js')}}"></script>
<script src="{{asset('/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/libs/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/libs/highlight/TextHighlighter.min.js')}}"></script>
<script src="{{asset('/libs/bootbox/bootbox.min.js')}}"></script>
<script src="{{asset('/libs/splitter/jquery-resizable.js')}}"></script>
<script src="{{asset('/libs/toolbar/jquery.toolbar.js')}}"></script>
<script src="{{asset('/js/my-script.js')}}"></script>
<script src="{{asset('/js/admin/adminVariableSetup.js')}}"></script>
{{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>--}}
{{--<script src="{{asset('js/socketNoti.js')}}"></script>--}}
@yield('scripts')
</body>
</html>
