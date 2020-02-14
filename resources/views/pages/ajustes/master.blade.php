@extends('layouts.template')

@section('page_content')
    <div class="modal fade" id="modalNovo" tabindex="-1" role="dialog" aria-labelledby="modalNovo">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Novo {{$Page->Target}}</h4>
                </div>
                <div class="modal-body">
                    @include('pages.ajustes.planos.form')
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar {{$Page->Target}}</h4>
                </div>
                <div class="modal-body">
                    @include('pages.ajustes.planos.form')
                    <form class="form-horizontal form-label-left">
                        <div style="float:right;">Nome intervenção:</div>
                        <br>
                        <div class="title_right">
                            <div class="col-md-8 col-sm-8 col-xs-12 form-group pull-right top_search">
                                <div class="input-group" style="float:left;">
                                    <input type="text" class="form-control" value="">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i
                                                    class="fa fa-chevron-circle-right"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nome intervenção</th>
                                <th>Valor plano</th>
                                <th>Valor paciente</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row"><input name="nome" type="text"></th>
                                <td><input name="valor_plano" type="number"></td>
                                <td><input name="valor_paciente" type="number"></td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#exampleModal2"
                                            class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Incluir
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Intervenção 1</th>
                                <td>R$500,00</td>
                                <td>R$500,00</td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#exampleModal1"
                                            class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Editar
                                    </button>
                                    <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-pencil"></i>
                                        Excluir </a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Intervenção 2</th>
                                <td>R$500,00</td>
                                <td>R$500,00</td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#exampleModal2"
                                            class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Editar </a>
                                        <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-pencil"></i>
                                            Excluir </a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Intervenção 3</th>
                                <td>R$500,00</td>
                                <td>R$500,00</td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#exampleModal2"
                                            class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Editar </a>
                                        <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-pencil"></i>
                                            Excluir </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#modalEditar').on('show.bs.modal', function (event) {
                var modal = $(this);
                var button = $(event.relatedTarget); // Button that triggered the modal
                var recipient = button.data('whatever');// Extract info from data-* attributes
                modal.find('.modal-title').text('Editar {{strtolower($Page->Target)}}');
            });
            $('#modalExcluir').on('show.bs.modal', function (event) {
                var modal = $(this);
                var button = $(event.relatedTarget); // Button that triggered the modal
                var recipient = button.data('whatever');// Extract info from data-* attributes
                modal.find('.modal-title').text('Você tem certeza que deseja excluir esse {{strtolower($Page->Target)}}?');
            });
        });
    </script>

    <!-- page content -->
    <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row tile_count" style="padding:10px;">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalNovo">
                Novo {{$Page->Target}}</button>
        </div>
        <!-- /top tiles -->
        <div class="row">
            @foreach($Resultado as $resultado)
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="x_panel tile fixed_height_330">
                        <div class="x_title">
                            <h2>{{$resultado->nome}}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <button type="button" class="btn btn-round btn-success" data-toggle="modal"
                                data-target="#modalEditar">Editar
                        </button>
                        <button type="button" class="btn btn-round btn-danger" data-toggle="modal"
                                data-target="#modalExcluir">Excluir
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection