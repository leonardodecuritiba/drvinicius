<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>

    <!-- Fonts -->
    {!! Html::style('vendors/font-awesome/css/font-awesome.min.css') !!}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    {!! Html::style('vendors/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('vendors/bootstrap/dist/css/bootstrap.min.css') !!}


    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">

@yield('content')

<!-- JavaScripts -->
{!! Html::script('vendors/jquery/dist/jquery.min.js') !!}
{!! Html::script('vendors/bootstrap/dist/js/bootstrap.min.js') !!}
</body>
</html>
