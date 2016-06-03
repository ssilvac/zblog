<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ZBlog</title>

    <!-- Fonts -->
    <link href="/assets/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <!-- Styles -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/bootstrap-theme.min.css" rel="stylesheet">

    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body id="app-layout">
    

    @include('partials/menu')

    @yield('content')

    <!-- JavaScripts -->
    <script src="/assets/js/jquery-2.2.0.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>

    @yield('libjs')
</body>
</html>
