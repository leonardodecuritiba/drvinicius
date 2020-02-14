@extends('layouts.template')
@section('style_content')
    <!-- Datatables -->
    @include('helpers.datatables.head')
    <!-- /Datatables -->
@endsection
@section('page_content')
    <!-- Seach form -->
    @include('layouts.search.form')
    <!-- /Seach form -->
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
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Região</th>
                                <th>Valor</th>
                                <th>Data criação</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Buscas as $intervencao)
                                <tr>
                                    <td>{{$intervencao->codigo}}</td>
                                    <td>{{$intervencao->nome}}</td>
                                    <td>{{$intervencao->regiao}}</td>
                                    <td data-order="{{$intervencao->getValorFloat()}}">R$ {{$intervencao->valor}}</td>
                                    <td>{{$intervencao->created_at}}</td>
                                    <td>
                                        <a class="btn btn-primary btn-xs"
                                           href="{{route(strtolower($Page->link).'.edit',$intervencao->idintervencao)}}"><i
                                                    class="fa fa-edit"></i>Editar</a>
                                        <a class="btn btn-danger btn-xs"
                                           data-nome="{{$intervencao->nome}}"
                                           data-href="{{route(strtolower($Page->link).'.destroy',$intervencao->idintervencao)}}"
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
@endsection