@extends('layouts.template')
@section('style_content')
    <!-- select2 -->
    @include('helpers.select2.head')
    <!-- /select2 -->
    <!-- Datatables -->
    @include('helpers.datatables.head')
    <!-- /Datatables -->
@endsection
@section('page_content')
    <div class="row">
        <div class="x_panel">
            <div class="x_title">
                <h2>Filtros</h2>
                <a class="btn btn-primary pull-right" href="{{ route(strtolower($Page->link).'.create') }}"
                >Cadastrar {{$Page->Target}}</a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                {!! Form::open(array('route'=>'cheques.index',
                    'method'=> 'GET',
                    'class' => 'form-horizontal form-label-left', 'data-parsley-validate')) !!}
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Data Inicial:</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input value="{{Request::get('data_inicial')}}"
                                   type="text" class="form-control show-data" name="data_inicial"
                                   placeholder="Data" required>
                        </div>
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Data Final:</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input value="{{Request::get('data_final')}}"
                                   type="text" class="form-control show-data" name="data_final" placeholder="Data"
                                   placeholder="MM/DD/YYYY"
                                   data-date-format="MM/DD/YYYY"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Plano:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                            <select class="form-control select2" name="idplano">
                                <option value="">Todos</option>
                                @foreach($Page->extras['Planos'] as $selecao)
                                    <option value="{{$selecao->idplano}}"
                                            @if(Request::has('idplano') && (Request::get('idplano') == $selecao->idplano)) selected @endif
                                    >{{$selecao->nome}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
                {{--<div class="row">--}}
                {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
                {{--<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Cirurgião:</label>--}}
                {{--<div class="col-md-6 col-sm-6 col-xs-12 form-group">--}}
                {{--<select class="form-control select2_single" name="idprofissional">--}}
                {{--<option value="">Todos</option>--}}
                {{--@foreach($Page->Profissionais as $selecao)--}}
                {{--<option value="{{$selecao->idprofissional}}"--}}
                {{--@if(Request::has('idprofissional') && (Request::get('idprofissional') == $selecao->idprofissional)) selected @endif--}}
                {{-->{{$selecao->nome}}</option>--}}
                {{--@endforeach--}}
                {{--</select>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="ln_solid"></div>--}}
                <div class="row">
                    {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
                    {{--<label class="control-label col-md-2 col-sm-2 col-xs-12">Paciente:</label>--}}
                    {{--<div class="col-md-5 col-sm-5 col-xs-12">--}}
                    {{--<select class="form-control select2_single" name="idpaciente">--}}
                    {{--<option value="">Todos</option>--}}
                    {{--@foreach($Page->Pacientes as $selecao)--}}
                    {{--<option value="{{$selecao->idpaciente}}"--}}
                    {{--@if(Request::has('idpaciente') && (Request::get('idpaciente') == $selecao->idpaciente)) selected @endif--}}
                    {{-->{{$selecao->nome}}</option>--}}
                    {{--@endforeach--}}
                    {{--</select>--}}
                    {{--</div>--}}
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Nome:</label>
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group">
                            <input value="{{Request::get('nome')}}"
                                   type="text" class="form-control" name="nome" placeholder="Nome">
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-12">
						<span class="input-group-btn">
							<button class="btn btn-block btn-info" name="buscar" type="submit">Filtrar</button>
						</span>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @if(count($Buscas) > 0)
        <div class="x_panel">
            <div class="x_title">
                <h2><b>{{$Buscas->count()}}</b> {{$Page->Targets}} encontrados</h2>
                <a class="btn btn-default pull-right" href="{{route('cheques.imprimir', Request::all())}}"
                   target="_blank">
                    <i class="fa fa-print fa-2"></i> Imprimir
                </a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 animated fadeInDown">
                        <table class="table table-striped dt-responsive table-bordered nowrap" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Data</th>
                                <th>Nome</th>
                                <th>Valor</th>
                                <th>Banco</th>
                                <th>Número</th>
                                <th>Plano</th>
                                <th>Destino</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Buscas as $sel)
                                <tr>
                                    <td>{{$sel->id}}</td>
                                    <td>{{$sel->getData()}}</td>
                                    <td>{{$sel->nome}}</td>
                                    <td data-order="{{$sel->valor}}">{{$sel->getValor()}}</td>
                                    <td>{{$sel->banco}}</td>
                                    <td>{{$sel->numeracao}}</td>
                                    <td>{{$sel->getNomePlano()}}</td>
                                    <td>{{$sel->destino}}</td>
                                    <td>
                                        <a class="btn btn-primary btn-xs"
                                           href="{{route(strtolower($Page->link).'.edit',$sel->id)}}"><i
                                                    class="fa fa-edit"></i>Editar</a>
                                        <a class="btn btn-danger btn-xs"
                                           data-nome="Número {{$sel->numeracao}}"
                                           data-href="{{route(strtolower($Page->link).'.destroy',$sel->id)}}"
                                           data-toggle="modal"
                                           data-target="#modalRemocao"><i class="fa fa-trash-o fa-sm"></i>Excluir </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('layouts.search.no-results')
    @endif
@endsection
@section('scripts_content')
    <!-- Datatables -->
    @include('helpers.datatables.foot')
    <script>
        $(document).ready(function () {
            $('.dt-responsive').DataTable(
                {
                    "language": language_pt_br,
                    "pageLength": 10,
                    "bLengthChange": false, //used to hide the property
                    "bFilter": false,
                    "order": [0, "desc"]
                }
            );
        });
    </script>
    <!-- /Datatables -->
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