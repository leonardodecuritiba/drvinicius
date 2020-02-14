@extends('layouts.template')
@section('page_content')
    <!-- top tiles -->
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
                        <table border="0" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Data criação</th>
                                <th>Status</th>
                                <th>Nome</th>
                                <th colspan="3">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Buscas as $plano)
                                <tr>
                                    <td>{{$plano->created_at}}</td>
                                    <td class="td-active">
                                        @if($plano->plano_status)
                                            <span class="btn btn-success btn-xs">Ativo</span>
                                        @else
                                            <span class="btn btn-danger btn-xs">Inativo</span></td>
                                    @endif
                                    </td>
                                    <td>{{$plano->nome}}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-active btn-default btn-xs"
                                           data-value="{{$plano->plano_status}}"
                                           data-table="plano"
                                           data-pk="idplano"
                                           data-sk="plano_status"
                                           data-id="{{$plano->idplano}}">
                                            @if($plano->plano_status)
                                                <i class="fa fa-eye-slash"></i> Desativar
                                            @else
                                                <i class="fa fa-eye"></i> Ativar
                                            @endif
                                        </a>
                                        <a class="btn btn-primary btn-xs"
                                           href="{{route(strtolower($Page->link).'.edit',$plano->idplano)}}"><i
                                                    class="fa fa-edit"></i>Editar</a>
                                        <a class="btn btn-danger btn-xs"
                                           data-nome="{{$plano->nome}}"
                                           data-href="{{route(strtolower($Page->link).'.destroy',$plano->idplano)}}"
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