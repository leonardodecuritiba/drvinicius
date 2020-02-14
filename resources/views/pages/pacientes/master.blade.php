@extends('layouts.template')
@section('style_content')
    {!! Html::style('vendors/select2/dist/css/select2.min.css') !!}
    {!! Html::style('vendors/pnotify/dist/pnotify.css') !!}
@endsection
@section('page_content')
    <div class="page-title">
        <div class="title_left">
            <h3>{{$Page->titulo_primario.$Page->Targets}}</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{$Page->titulo_secundario}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if(!isset($Paciente))
                        {!! Form::open(['route' => $Page->link.'.store', 'files' => true,
                            'method' => 'POST',
                            'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
                        @include('pages.'.$Page->link.'.form.cadastro')
                        <div class="form-group pull-right">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <button type="submit" class="btn btn-danger">Cancelar</button>
                                <button type="submit" class="btn btn-success">Salvar</button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    @else
                        {!! Form::model($Paciente, ['method' => 'PATCH','route'=>[$Page->link.'.update',$Paciente->$Paciente]]) !!}
                        @include('pages.'.$Page->link.'.form.cadastro')
                        {{ Form::close() }}
                    @endif

                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
@section('scripts_content')
    <!-- select2 -->
    {!! Html::script('vendors/select2/dist/js/select2.min.js') !!}
    <!-- form validation -->
    {!! Html::script('js/parsley/parsley.min.js') !!}


    <!-- GET CEP CODE -->
    <script>
        $(document).ready(function () {
            var _cep_input = 'input#cep';
            var _logradouro_input = '.input-logradouro';
            var _bairro_input = '.input-bairro';
            var _cidade_input = '.input-cidade';
            var _estado_input = '.input-estado';
            $(_cep_input).change(function () {
                var cep_code = $(this).val();
                if (cep_code.length <= 0) return;
                $.get("http://apps.widenet.com.br/busca-cep/api/cep.json", {code: cep_code},
                    function (result) {
                        if (result.status != 1) {
                            alert(result.message || "Houve um erro desconhecido");
                            return false;
                        }
                        console.log(result);
                        $(_cep_input).val(result.code);
                        $(_logradouro_input).val(result.address);
                        $(_bairro_input).val(result.district);
                        $(_cidade_input).val(result.city);
                        $(_estado_input).val(result.state);
                    });
            });
        });
    </script>
@endsection