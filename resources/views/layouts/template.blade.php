<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CDENTAL</title>
    @include('layouts.head')
    @yield('style_content')
    <style>
        .loading {
            background: #fff url("{{asset('images/ajax-loader.gif')}}") no-repeat center center !important;
        }

        .esconde {
            display: none;
        }

        .price-total, .price-recebido, .price-pendente {
            font-weight: 700 !important;
        }

        .price-recebido {
            color: #26B99A !important;
        }

        .price-total {
            color: #1A82C3 !important;
        }

        .price-pendente {
            color: #d9534f !important;
        }

        .modal {
            z-index: 9999;
        }
    </style>
</head>
<body class="nav-md">
{!! Html::script('js/nprogress.js') !!}
<script>
    NProgress.start();
</script>
<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
@yield('modal_content')
<!---- Visualização de popup ----->
{{--		@include('layouts.alerts.popup')--}}
{{--@include('layouts.alerts.notifications')--}}
{{--@include('layouts.modals.notifications')--}}
@include('layouts.modals.remove')
@include('layouts.modals.add')

<div class="container body">
    <div class="main_container">
        <!---- Visualização de erros ----->
    @if (count($errors) > 0)
        @include('layouts.alerts.erros')
    @endif
    @if (session()->has('mensagem'))
        @include('layouts.alerts.success')
    @endif
    @include('layouts.menu')
    <!-- page content -->
        <div class="right_col" role="main">
        @yield('page_content')
        <!-- /page content -->
        </div>
    </div>
</div>
@include('layouts.foot')
@yield('scripts_content')
</body>
</html>
