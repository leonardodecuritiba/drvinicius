@extends('layouts.template')
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
                        <table border="0" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Data criação</th>
                                <th>Status</th>
                                <th>Tipo</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th colspan="2">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Buscas as $profissional)
                                <tr>
                                    <td>{{$profissional->created_at}}</td>
                                    <td>
                                        @if($profissional->get_status())
                                            <a class="btn btn-success btn-xs"><i
                                                        class="fa fa-check"></i> {{$profissional->get_text_status()}}
                                            </a>
                                        @else
                                            <a class="btn btn-danger btn-xs"><i
                                                        class="fa fa-times"></i> {{$profissional->get_text_status()}}
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{$profissional->user->is()}}</td>
                                    <td>{{$profissional->nome}}</td>
                                    <td class="show-cpf">{{$profissional->cpf}}</td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" id="edit"
                                           href="{{route($Page->link.'.edit',$profissional->user->idusers)}}"><i
                                                    class="fa fa-edit"></i> Editar</a>
                                        @if($profissional->get_status())
                                            <a class="btn btn-danger btn-xs"
                                               href="{{route($Page->link.'.destroy',$profissional->user->idusers)}}"><i
                                                        class="fa fa-trash-o fa-sm"></i> Excluir </a>
                                        @else
                                            <a class="btn btn-success btn-xs"
                                               href="{{route($Page->link.'.active',$profissional->user->idusers)}}"><i
                                                        class="fa fa-check fa-sm"></i> Ativar </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--@endforeach--}}
                </div>
            </div>
        </div>
    @else
        @include('layouts.search.no-results')
    @endif
@endsection
@section('scripts_content')
@endsection