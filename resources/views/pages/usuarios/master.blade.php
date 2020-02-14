@extends('layouts.template')
@section('style_content')
    {!! Html::style('vendors/select2/dist/css/select2.min.css') !!}
    {!! Html::style('vendors/pnotify/dist/pnotify.css') !!}
@endsection
@section('page_content')
    {{--@include('admin.master.forms.search')--}}
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
                    @if(isset($User))
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <button class="btn btn-success" data-toggle="modal" data-target="#modalPWD"><i
                                            class="fa fa-refresh fa-2"></i> Atualizar Senha
                                </button>
                            </li>
                        </ul>
                    @endif
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if(!isset($User))
                        {!! Form::open(['route' => $Page->link.'.store',
                            'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
                    @else
                        @include('pages.usuarios.modal.pwd')
                        {!! Form::open(['route'=>[$Page->link.'.update',$User->idusers],
                            'method' => 'PATCH',
                            'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
                    @endif
                    @include('pages.'.$Page->link.'.forms.cadastro')
                    <div class="form-group pull-right">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <a type="submit" class="btn btn-danger" href="{{route($Page->link.'.index')}}">Cancelar</a>
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </div>
                    {{ Form::close() }}
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
                console.log(cep_code);
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