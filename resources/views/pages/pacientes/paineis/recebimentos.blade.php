<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Débitos</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-md-6 col-sm-6 col-xs-12 product_price">
                <h1 class="price price-recebido text-center">{{$Paciente->total_recebido()}}</h1>
                <p class="price-tax text-center">Total recebido</p>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 product_price">
                <h1 class="price price-pendente text-center">{{$Paciente->total_pendente()}}</h1>
                <p class="price-tax text-center">À receber</p>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 animated fadeInDown">
                    @if($Paciente->has_pagamentos())
                        <table class="table table-striped dt-responsive table-bordered nowrap" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Situação</th>
                                <th>Descrição</th>
                                <th>Valor Total</th>
                                <th>Pagamento</th>
                                <th>Pago / Restante</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($Paciente->orcamentos_pagamento as $orcamento)
                                <tr>
                                    <td>
                                        {{$orcamento->pagamento->idpagamento}}
                                    </td>
                                    <td>
                                        <span class="btn btn-xs btn-{{$orcamento->pagamento->getStatusColor()}}">
                                            {{$orcamento->pagamento->getStatusText()}}</span>
                                    </td>
                                    <td>
                                        <h4 class="price">{{$orcamento->descricao}}</h4>
                                        <small>Data: {{$orcamento->created_at}}</small>
                                    </td>
                                    <td>
                                        <p class="price-total">{{$orcamento->valor_final_total()}}</p>
                                    </td>
                                    <td>
                                        @if($orcamento->valor_entrada>0)
                                            <span>{{$orcamento->valor_entrada}}</span><br/>
                                            <small>+
                                                {{$orcamento->numero_parcelas}} &times; {{$orcamento->valor_parcelas()}}</small>
                                        @else
                                            <span>{{$orcamento->numero_parcelas}} &times; {{$orcamento->valor_parcelas()}}</span>
                                        @endif
                                    </td>
                                    <td class="project_progress">
										<?php $valores = $orcamento->pagamento->valores_total_parcelas(); ?>
                                        <h4 class="price">{{$valores->valor_pago}}</h4>
                                        <small style="color:red">{{$valores->valor_pendente}}</small>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-xs receber"
                                           data-toggle="modal"
                                           data-target="#modalReceber"
                                           data-href="{{route('json.parcelas.pendentes', $orcamento->pagamento->idpagamento)}}"><i
                                                    class="fa fa-money"></i>
                                            Receber</a>
                                        <a class="btn btn-default btn-xs"
                                           data-toggle="modal"
                                           data-target="#modalRecebimentos"
                                           data-href="{{route('json.parcelas.pagas', $orcamento->pagamento->idpagamento)}}"><i
                                                    class="fa fa-eye"></i>
                                            Recebimentos</a>
                                        <a class="btn btn-danger btn-xs"
                                           data-nome="Recebimento: #{{$orcamento->pagamento->idpagamento}}"
                                           data-href="{{route('pagamento.destroy', $orcamento->pagamento->idpagamento)}}"
                                           data-toggle="modal"
                                           data-target="#modalExclusao"><i class="fa fa-trash-o fa-sm"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>