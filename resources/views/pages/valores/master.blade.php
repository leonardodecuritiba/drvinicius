@extends('layouts.template')
@section('style_content')

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
                        <a href="{{ route(strtolower($Page->link).'.index',$Page->extras['tipo']) }}"
                           class="btn btn-warning btn-lg btn-block">Voltar</a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                        {!! Form::submit('Cadastrar',array('class' => 'btn btn-success btn-lg btn-block')) !!}
                    </div>
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['route'=>[strtolower($Page->link).'.update', $Data->id], 'method' => 'PATCH', 'class' => 'form-horizontal form-label-left']) !!}
                    @include('pages.'.strtolower($Page->link).'.forms.form')
                    <div class="divider"></div>
                    <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                        <a href="{{ route(strtolower($Page->link).'.index',$Page->extras['tipo']) }}"
                           class="btn btn-warning btn-lg btn-block">Voltar</a>
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
@endsection