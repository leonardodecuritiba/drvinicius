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
                                <th>Nome</th>
                                <th colspan="2">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Buscas as $caixa)
                                {!! Form::open(['method' => 'PATCH','route'=>['caixas.update',$caixa->idtipo_pagamento], 'class' => 'form-horizontal form-label-left']) !!}

                                <tr>
                                    <td>{{$caixa->created_at}}</td>
                                    <td data-value="{{$caixa->nome}}">
                                        <span>{{$caixa->nome}}</span>
                                        <input name="nome" type="text" class="form-control hide"
                                               value="{{$caixa->nome}}">
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" id="edit"><i class="fa fa-edit"></i>
                                            Editar</a>
                                        <button type="submit" class="btn btn-success btn-xs hide"><i
                                                    class="fa fa-check"></i> Salvar
                                        </button>
                                        <a class="btn btn-danger btn-xs"
                                           data-nome="{{$caixa->nome}}"
                                           data-href="{{route(strtolower($Page->link).'.destroy',$caixa->idtipo_pagamento)}}"
                                           data-toggle="modal"
                                           data-target="#modalRemocao"><i class="fa fa-trash-o fa-sm"></i>Excluir </a>
                                    </td>
                                </tr>
                                {!! Form::close() !!}
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--@endforeach--}}
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
@section('scripts_content')
    <script>
        $(document).ready(function () {
            //Edição do caixa
            $('a#edit').click(function () {
                $parent = $(this).parents('td');
                $valor = $($parent).prev();
                $($valor).find('span').addClass('hide');
                $($valor).find('input').removeClass('hide');

                //transformar botão
                $(this).addClass('hide');
                $(this).next().removeClass('hide');

            });
        });
    </script>
@endsection