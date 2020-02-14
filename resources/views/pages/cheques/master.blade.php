@extends('layouts.template')
@section('style_content')

    <!-- select2 -->
    @include('helpers.select2.head')
    <!-- /select2 -->
@endsection
@section('page_content')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{$Page->Titulo}}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                @if($Page->funcao == 'create')
                    {!! Form::open(['route'=>strtolower($Page->link).'.store', 'class' => 'form-horizontal form-label-left']) !!}
                    @include('pages.'.strtolower($Page->link).'.forms.form')
                    <div class="divider"></div>
                    <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                        <a href="{{ url(strtolower($Page->link)) }}" class="btn btn-warning btn-lg btn-block">Voltar</a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                        {!! Form::submit('Cadastrar',array('class' => 'btn btn-success btn-lg btn-block')) !!}
                    </div>
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['route'=>[strtolower($Page->link).'.update', $Cheque->id], 'method' => 'PATCH', 'class' => 'form-horizontal form-label-left']) !!}
                    @include('pages.'.strtolower($Page->link).'.forms.form')
                    <div class="divider"></div>
                    <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                        <a href="{{ url(strtolower($Page->link)) }}" class="btn btn-warning btn-lg btn-block">Voltar</a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                        {!! Form::submit('Cadastrar',array('class' => 'btn btn-success btn-lg btn-block')) !!}
                    </div>
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts_content')
    <!-- form validation -->
    {!! Html::script('js/parsley/parsley.min.js') !!}
    <!-- Select2 -->
    {!! Html::script('vendors/select2/dist/js/select2.min.js') !!}
    <!-- Select2 -->
    <script>
        $(document).ready(function () {
            $(".select2").select2({width: 'resolve'});
        });
    </script>
    <!-- /Select2 -->
@endsection