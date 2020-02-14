@extends('layouts.template')
@section('page_content')
    <!-- top tiles -->
    <!-- Seach form -->
    @include('layouts.search.form')
    <!-- /Seach form -->
    @if(count($Buscas) > 0)
        <div class="x_panel">
            <div class="x_title">
                <h2>{{$Page->Targets}} encontradas</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 animated fadeInDown">
                        <table border="0" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Data criação</th>
                                <th>Nome</th>
                                <th>Criador</th>
                                <th colspan="3">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Buscas as $anamnese)
                                <tr>
                                    <td>{{$anamnese->created_at}}</td>
                                    <td>{{$anamnese->nome}}</td>
                                    <td>{{$anamnese->criador->nome}}</td>
                                    <td>
                                        <a class="btn btn-primary btn-xs"
                                           href="{{route(strtolower($Page->link).'.edit',$anamnese->idanamnese)}}"><i
                                                    class="fa fa-edit"></i>Editar</a>
                                        <a class="btn btn-danger btn-xs"
                                           data-nome="{{$anamnese->nome}}"
                                           data-href="{{route(strtolower($Page->link).'.destroy',$anamnese->idanamnese)}}"
                                           data-toggle="modal"
                                           data-target="#modalRemocao"><i class="fa fa-trash-o fa-sm"></i>Excluir </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row pull-right">
                    {!! $Buscas->appends(Request::only('busca'))->links() !!}
                </div>
            </div>
        </div>
    @else
        @include('layouts.search.no-results')
    @endif
@endsection