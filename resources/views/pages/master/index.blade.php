@extends('layouts.template')
@section('style_content')

    <!-- Datatables -->
    @include('helpers.datatables.head')
@endsection
@section('page_content')
    <!-- top tiles -->
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                    <h2>Próximo Paciente</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if($Page->Data['ProximaConsulta'] != NULL)
                        <table class="table table-striped dt-responsive table-bordered nowrap" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Data/Hora</th>
                                <th>Telefone/Celular</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    {{$Page->Data['ProximaConsulta']->getNome()}}
                                </td>
                                <td>
                                    {{$Page->Data['ProximaConsulta']->data_consulta_inicio()}}
                                </td>
                                <td>
                                    {{$Page->Data['ProximaConsulta']->getTelefone()}}
                                </td>
                                <td>
                                    @if($Page->Data['ProximaConsulta']->idpaciente == NULL)
                                        <i>Não cadastrado</i>
                                    @else
                                        <a href="{{route('pacientes.show',$Page->Data['ProximaConsulta']->idpaciente)}}"
                                           class="btn btn-default btn-xs"><i class="fa fa-eye"></i> Ver prontuário </a>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    @else
                        <div class="jumbotron">
                            <h1>Ops!</h1>
                            <h3>Nenhuma consulta marcada para hoje.</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                    <h2>Agenda do dia</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if($Page->Data['ConsultasDoDia']->count() > 0)
                        <table class="table table-striped dt-responsive table-bordered nowrap" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Data/Hora</th>
                                <th>Celular/Telefone</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($Page->Data['ConsultasDoDia'] as $consulta)
                                <tr>
                                    <td>
                                        {{$consulta->getNome()}}
                                    </td>
                                    <td>
                                        {{$consulta->data_consulta_inicio()}}
                                    </td>
                                    <td>
                                        {{$consulta->getTelefone()}}
                                    </td>
                                    <td>
                                        @if($consulta->idpaciente == NULL)
                                            <i>Não cadastrado</i>
                                        @else
                                            <a href="{{route('pacientes.show',$consulta->idpaciente)}}"
                                               class="btn btn-default btn-xs"><i class="fa fa-eye"></i> Ver prontuário
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="jumbotron">
                            <h1>Ops!</h1>
                            <h3>Nenhuma consulta marcada para hoje.</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                    <h2>Próximos Retornos</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if($Page->Data['Retornos'] != NULL)
                        <table class="table table-striped dt-responsive table-bordered nowrap" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Data</th>
                                <th>Telefone/Celular</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($Page->Data['Retornos'] as $retorno)
                                <tr>
                                    <td>
                                        {{$retorno->getNome()}}
                                    </td>
                                    <td>
                                        {{$retorno->data_retorno}}
                                    </td>
                                    <td>
                                        {{$retorno->getTelefone()}}
                                    </td>
                                    <td>
                                        <a href="{{route('pacientes.show',$retorno->idpaciente)}}"
                                           class="btn btn-default btn-xs"><i class="fa fa-eye"></i> Ver prontuário </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="jumbotron">
                            <h1>Ops!</h1>
                            <h3>Nenhuma retorno marcado.</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                    <h2>Débitos vencidos pendentes</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if($Page->Data['ParcelaVencidas']->count() > 0)
                        <table class="table table-striped dt-responsive table-bordered nowrap" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Valor</th>
                                <th>Pago</th>
                                <th>Pendente</th>
                                <th>Vencimento</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($Page->Data['ParcelaVencidas'] as $parcela)
                                <tr>
                                    <td>
                                        <a href="{{route('pacientes.show',$parcela->paciente->idpaciente)}}">{{$parcela->paciente->nome}}</a>
                                    </td>
                                    <td>
                                        {{$parcela->getValorTotalReal()}}
                                    </td>
                                    <td>
                                        {{$parcela->getValorPagoReal()}}
                                    </td>
                                    <td>
                                        {{$parcela->getValorPendenteReal()}}
                                    </td>
                                    <td>
                                        {{$parcela->data_vencimento}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="jumbotron">
                            <h1>Ops!</h1>
                            <h3>Nenhuma consulta marcada para hoje.</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts_content')

    <!-- Datatables -->
    @include('helpers.datatables.foot')
    <script>
        $(document).ready(function () {
            $('.dt-responsive').DataTable(
                {
                    "language": language_pt_br,
                    "pageLength": 4,
                    "bLengthChange": false, //used to hide the property
                    "bFilter": false,
                    "order": [0, "desc"]
                }
            );
        });
    </script>
    <!-- /Datatables -->
@endsection