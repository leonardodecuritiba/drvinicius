@extends('layouts.template')
@section('style_content')
    <!-- Datatables -->
    @include('helpers.datatables.head')
    <!-- /Datatables -->
@endsection
@section('modal_content')
    @include('layouts.modals.modalRetorno')
@endsection
@section('page_content')
    @include('layouts.search.form')
    @if(count($Buscas) > 0)
        <div class="x_panel">
            <div class="x_title">
                <h2>{{$Page->Targets}} encontrados</h2>
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
                                <th>Nome</th>
                                <th>Idade</th>
                                <th>Retorno</th>
                                <th>Prontuário</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Buscas as $paciente)
                                <tr>
                                    <td>{{$paciente->idpaciente}}</td>
                                    <td>{{$paciente->nome}}</td>
                                    <td>{{$paciente->hasIdade() ? $paciente->getIdade() . ' anos' : '-'}}</td>
                                    <td>{{$paciente->has_retorno() ? $paciente->getLastRetorno()->data_retorno : '-'}}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-xs add-retorno"
                                                data-idpaciente="{{$paciente->idpaciente}}"
                                                data-toggle="modal"
                                                data-target="#modalRetorno">
                                            <i class="fa fa-plus"></i> Agendar retorno
                                        </button>
                                        <a href="{{route('pacientes.show',$paciente->idpaciente)}}"
                                           class="btn btn-primary btn-xs">
                                            <i class="fa fa-user"></i> Prontuário
                                        </a>
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
    <script>
        $(document).ready(function () {
            $('div#modalRetorno').on('show.bs.modal', function (e) {
                $origem = $(e.relatedTarget);
                idpaciente_ = $($origem).data('idpaciente');
                $(this).find('.modal-body input#idpaciente').val(idpaciente_);
            });
        });
    </script>
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
@endsection