<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Evoluções</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#modalEvolucao"><i class="fa fa-plus-circle fa-2"></i> Adicionar
                        evolução
                    </button>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            @if($Paciente->has_evolucao())
                <ul class="list-unstyled timeline">
                    @foreach($Paciente->evolucoes as $evolucao)
                        <li>
                            <div class="block">
                                <div class="tags">
                                    <a class="tag">
                                        <span>{{$evolucao->data_evolucao}}</span>
                                    </a>
                                </div>
                                <div class="block_content">
                                    <h2 class="title">
                                        <a>{{$evolucao->profissional_criador->nome}}</a>
                                        <a class="btn btn-danger btn-xs"
                                           data-nome="Evolução: ({{$evolucao->data_evolucao}}) {{$evolucao->texto}}"
                                           data-href="{{route('evolucoes.destroy', $evolucao->idevolucao)}}"
                                           data-toggle="modal"
                                           data-target="#modalExclusao"><i class="fa fa-trash-o fa-sm"></i></a>
                                    </h2>
                                    <p class="excerpt">{{$evolucao->texto}}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="clearfix"></div>
            @else
                <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="jumbotron">
                        <p>Este paciente não possui nenhuma evolução cadastrada.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>