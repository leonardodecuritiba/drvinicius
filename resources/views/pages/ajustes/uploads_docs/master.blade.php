@extends('layouts.template')
@section('page_content')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{$Page->Titulo}}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                @if($Page->funcao == 'create')
                    {!! Form::open(['route'=>strtolower($Page->link).'.store',
                            'files' => true,
                            'method' => 'POST',
                            'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
                    @include('pages.ajustes.'.strtolower($Page->link).'.forms.form')
                    <div class="divider"></div>
                    <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                        <a href="{{ url(strtolower($Page->link)) }}" class="btn btn-warning btn-lg btn-block">Voltar</a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                        {!! Form::submit('Cadastrar',array('class' => 'btn btn-success btn-lg btn-block')) !!}
                    </div>
                    {!! Form::close() !!}
                @else
                    {!! Form::open([
                            'files' => true,'method' => 'PATCH','route'=>[strtolower($Page->link).'.update',$Upload->id], 'class' => 'form-horizontal form-label-left']) !!}
                    @include('pages.ajustes.'.strtolower($Page->link).'.forms.form')
                    <div class="divider"></div>
                    <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                        <a href="{{ url(strtolower($Page->link)) }}" class="btn btn-warning btn-lg btn-block">Voltar</a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                        {!! Form::submit('Salvar',array('class' => 'btn btn-success btn-lg btn-block')) !!}
                    </div>
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
@endsection