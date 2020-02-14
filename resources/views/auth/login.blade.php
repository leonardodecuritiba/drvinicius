<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CDENTAL</title>

    <!-- Bootstrap -->
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('fonts/css/font-awesome.min.css') !!}
    {!! Html::style('css/animate.min.css') !!}
    {!! Html::style('build/css/custom.min.css') !!}
</head>
<body class="login">
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <h1>Login</h1>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" placeholder="Email"
                               value="{{ old('email') }}">
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" name="password" class="form-control" placeholder="Password" required=""/>
                    </div>
                    @if(env('APP_DEMO'))
                        <div class="form-group">
                            <p>Email: admin@cdental.com</p>
                            <p>Senha: 123</p>
                        </div>
                    @endif
                    <div class="form-group">
                        <button class="btn btn-default submit">Entrar</button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <p class="change_link">Esqueceu a senha?
                            <a href="#signup" class="to_remember"> Lembrar </a>
                        </p>

                        <div class="clearfix"></div>
                        <br/>

                        <div>
                            <h1><i class="fa fa-paw"></i> Control-Dental</h1>
                            <p>©{{\Carbon\Carbon::now()}} Todos os direitos reservados. Control dental</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
        <div id="remember" class="animate form registration_form">
            <section class="login_content">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                    {{ csrf_field() }}
                    <h1>Relembrar Senha</h1>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required=""/>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-default submit"> Enviar link relembrar senha</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Já é membro?
                            <a href="#signin" class="to_register"> Login </a>
                        </p>

                        <div class="clearfix"></div>
                        <br/>

                        <div>
                            <h1><i class="fa fa-paw"></i> Control-Dental</h1>
                            <p>©2016 Todos os direitos reservados. Control dental</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

</body>
</html>
