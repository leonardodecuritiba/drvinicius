{!! Html::script('js/jquery.min.js') !!}

<!-- Bootstrap core CSS -->
{!! Html::style('css/bootstrap.min.css') !!}
{!! Html::style('fonts/css/font-awesome.min.css') !!}
{!! Html::style('css/animate.min.css') !!}

{{--{!! Html::style('css/maps/jquery-jvectormap-2.0.1.css') !!}--}}
{!! Html::style('css/icheck/flat/green.css') !!}
{!! Html::style('css/floatexamples.css') !!}

<!-- Select2 -->
{!! Html::style('vendors/select2/dist/css/select2.css') !!}

<!-- Custom styling plus plugins -->
{!! Html::style('build/css/custom.min.css') !!}

<!-- PNotify -->
{!! Html::style('vendors/pnotify/dist/pnotify.css') !!}

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<!--[if lt IE 9]>
<script src="../assets/js/ie8-responsive-file-warning.js"></script>
<![endif]-->

<style>
    .daterangepicker {
        position: absolute;
        z-index: 9999999;
    }

    .select2-container {
        z-index: 9999999;
    }

    .loading {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: none;
        background: #fff url("{{asset('images/ajax-loader.gif')}}") no-repeat center center;
        opacity: .75;
        filter: alpha(opacity=75);
        z-index: 999999999;
    }
</style>

@yield('style_content')

