<!doctype html>
<html class="no-js" lang="en">
<head>
    @section('title','Login page')
    @include('layouts.partial.head')
    <style>
        .logo-centered{
            margin-bottom: 10px!important;
        }
        .logo-centered a{
            font-size: 3rem;
            font-weight: bolder;
            text-transform: uppercase;
            letter-spacing: 5px;
        }
    </style>
</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div id="app">
    <login-component></login-component>
</div>

@include('layouts.partial.footer-script')
</body>
</html>

