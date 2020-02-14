@extends('layouts.template')
@section('style_content')
    @include('helpers.select2.head')
    <!-- Datatables -->
    @include('helpers.datatables.head')
    <!-- /Datatables -->
@endsection
@section('page_content')
    <div class="row">
        <div class="x_panel">
            <div class="x_title">
                <h2>Filtros</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                {!! Form::open(array('route'=>'recibos',
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
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Cirurgião:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                            <select class="form-control select2_single" name="idprofissional">
                                <option value="">Todos</option>
                                @foreach($Page->Profissionais as $selecao)
                                    <option value="{{$selecao->idprofissional}}"
                                            @if(Request::has('idprofissional') && (Request::get('idprofissional') == $selecao->idprofissional)) selected @endif
                                    >{{$selecao->nome}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Plano:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                            <select class="form-control select2_single" name="idplano">
                                <option value="">Todos</option>
                                @foreach($Page->Planos as $selecao)
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
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Paciente:</label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <select class="form-control select2_single" name="idpaciente">
                                <option value="">Todos</option>
                                @foreach($Page->Pacientes as $selecao)
                                    <option value="{{$selecao->idpaciente}}"
                                            @if(Request::has('idpaciente') && (Request::get('idpaciente') == $selecao->idpaciente)) selected @endif
                                    >{{$selecao->nome}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <span class="input-group-btn">
                                <button class="btn btn-block btn-info" type="submit">Filtrar</button>
                            </span>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @if(count($Buscas) > 0)
        <div class="row">
            <div class="x_panel">
                <div class="x_title">
                    <h2><b>{{$Buscas->count()}}</b> {{$Page->Titulo}}</h2>
                    <a class="btn btn-default pull-right" href="{{route('recibos.imprimir', Request::all())}}"
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
                                    <th>Paciente</th>
                                    <th>CPF</th>
                                    <th>Tratamento</th>
                                    <th>Valor</th>
                                    <th>Responsável</th>
                                    <th>Emitido em</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($Buscas as $recebimento)
                                    <tr>
                                        <td>{{$recebimento->id}}</td>
                                        <td data-order="{{$recebimento->data_pagamento}}">{{$recebimento->getDataPagamento()}}</td>
                                        <td>
                                            <a target="_blank"
                                               href="{{route('pacientes.show',$recebimento->paciente()->idpaciente)}}">{{$recebimento->paciente()->nome}}</a>
                                        </td>
                                        <td>{{$recebimento->paciente()->cpf}}</td>
                                        <td>{{$recebimento->orcamento()->descricao}}</td>
                                        <td data-order="{{$recebimento->valor}}">{{$recebimento->getValorReal()}}</td>
                                        <td>{{$recebimento->profissional()->nome}}</td>
                                        <td>{{$recebimento->recibo_em_f}}</td>
                                        <td>
                                            <a target="_blank"
                                               href="{{route('parcelas_pagamento.imprimir',$recebimento->id)}}"
                                               class="btn btn-info btn-xs"><i class="fa fa-print"></i> Recibo</a>
                                            <a href="{{route('parcelas_pagamento.estornar',$recebimento->id)}}"
                                               class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Estornar</a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('layouts.search.no-results')
    @endif
@endsection
@section('scripts_content')
    <!-- form validation -->
    {!! Html::script('js/parsley/parsley.min.js') !!}
    @include('helpers.select2.foot')
    <!-- Datatables -->
    <script type="text/javascript">
        $(document).ready(function () {
            $(".select2_single").select2({
                width: 'resolve'
            });
        });
    </script>
    @include('helpers.datatables.foot')
    <script>
        $(document).ready(function () {
            $('.dt-responsive').DataTable(
                {
                    "language": language_pt_br,
                    "pageLength": 20,
                    "bLengthChange": false, //used to hide the property
                    "bFilter": false,
                    "order": [1, "desc"]
                }
            );
        });
    </script>
    <!-- /Datatables -->
@endsection