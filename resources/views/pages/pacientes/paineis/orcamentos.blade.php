<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Orçamentos</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <button class="btn btn-primary" id="add-orcamento"><i class="fa fa-plus-circle fa-2"></i>
                        Novo orçamento
                    </button>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <section id="new-orcamento" style="display: none">
                {!! Form::open(['route' => 'orcamentos.store', 'method' => 'POST',
                            'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
                <input type="hidden" name="idpaciente" value="{{$Paciente->idpaciente}}">
                <div class="x_title" style="margin-top:20px;">
                    <h2>Novo Orçamento</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" id="orcamento-container">
                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-12"
                               for="first-name">Descrição:</label>
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
                            <input type="text" class="form-control" name="descricao"
                                   placeholder="Descrição do orçamento..." required="required">
                            <span class="fa fa-medkit form-control-feedback right" aria-hidden="true"></span>
                        </div>
                        <label class="control-label col-md-1 col-sm-1 col-xs-12"
                               for="first-name">Profissional:</label>
                        <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                            <select class="select2 form-control" tabindex="-1" style="width: 100%;"
                                    name="idprofissional">
                                @foreach($Profissionais as $profissional)
                                    <option value="{{$profissional->idprofissional}}"
                                            @if(isset($Paciente) && ($Paciente->idprofissional) == ($profissional->idprofissional)) selected @endif>
                                        {{$profissional->nome}}
                                    </option>
                                @endforeach
                            </select>
                            <span class="fa fa-user-md form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <section id="tratamentos">
                        <div class="form-group" data-action="new">
                            <label class="control-label col-md-1 col-sm-1 col-xs-12"
                                   for="first-name">Tratamento:</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select id="intervencao" onchange="popula_valores(this);"
                                        class="select2 form-control" tabindex="-1" style="width: 100%;"
                                        name="idintervencao[0]">
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <input id="codigo" type="text" class="form-control" disabled
                                       placeholder="Código">
                                <span class="fa fa-info-circle form-control-feedback right"
                                      aria-hidden="true"></span>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <input id="regiao" type="text" class="form-control" name="regiao[0]"
                                       placeholder="Região">
                                <span class="fa fa-info-circle form-control-feedback right"
                                      aria-hidden="true"></span>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <input id="valor" onkeyup="atualiza_total('new')" type="text"
                                       class="form-control show-valor" name="valor[0]" placeholder="Valor">
                                <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                    </section>
                    <div class="form-group">
                        <label class="control-label col-md-offset-8 col-md-1 col-sm-offset-8 col-sm-1 col-xs-12"
                               for="first-name">Total:</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input id="valor_total" type="text" disabled class="form-control"
                                   placeholder="Valor">
                            <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-9 col-md-2 col-sm-offset-9 col-sm-2 col-xs-12">
                            <button id="add-tratamento" data-action="new" type="button" class="btn btn-primary">
                                <i class="fa fa-plus-circle fa-2"></i> Adicionar tratamento
                            </button>
                        </div>
                    </div>
                </div>
                <div class="x_title" style="margin-top:20px;">
                    <h2>Forma de Pagamento</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" id="pagamento-container">
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Desconto
                            (%)</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <input type="text" onkeyup="atualiza_total('new')" class="form-control"
                                   id="desconto" name="desconto">
                        </div>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Valor de
                            entrada</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <input type="text" onkeyup="atualiza_total('new')" class="form-control"
                                   name="valor_entrada">
                            <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Número de
                            Parcelas</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <input type="number" onchange="atualiza_total('new')"
                                   onkeyup="atualiza_total('new')" min="1" class="form-control" value="1"
                                   name="numero_parcelas" required="required">
                        </div>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Valor das
                            Parcelas</label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <input id="valor_parcela" type="text" class="form-control" disabled
                                   placeholder="Valor da parcela:">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-offset-7 col-md-2 col-sm-offset-7 col-sm-2 col-xs-12"
                               for="first-name">Valor total com desconto:</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <input id="valor_total_desconto" type="text" disabled class="form-control">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-offset-9 col-md-2 col-sm-offset-9 col-sm-2 col-xs-12">
                            <button type="submit" class="btn btn-block btn-round btn-success"><i
                                        class="fa fa-save"></i> Salvar
                            </button>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </section>
            @if($Paciente->orcamentos->count() > 0)
                <section id="edit-orcamento" style="display: none">
                    {!! Form::open(['route' => ['orcamentos.update', '_0_'], 'method' => 'PATCH',
                                'id' => 'form-edit', 'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
                    <input type="hidden" name="idpaciente" value="{{$Paciente->idpaciente}}">
                    <div class="x_title" style="margin-top:20px;">
                        <h2>Editar Orçamento</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" id="orcamento-container">
                        <div class="form-group">
                            <label class="control-label col-md-1 col-sm-1 col-xs-12"
                                   for="first-name">Descrição:</label>
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group has-feedback">
                                <input type="text" class="form-control" name="descricao"
                                       placeholder="Descrição do orçamento..." required="required">
                                <span class="fa fa-medkit form-control-feedback right"
                                      aria-hidden="true"></span>
                            </div>
                            <label class="control-label col-md-1 col-sm-1 col-xs-12"
                                   for="first-name">Profissional:</label>
                            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                                <select class="select2 form-control" tabindex="-1" style="width: 100%;"
                                        name="idprofissional">
                                    @foreach($Profissionais as $profissional)
                                        <option value="{{$profissional->idprofissional}}"
                                                @if(isset($Paciente) && ($Paciente->idprofissional) == ($profissional->idprofissional)) selected @endif
                                        >{{$profissional->nome}}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="fa fa-user-md form-control-feedback right"
                                      aria-hidden="true"></span>
                            </div>
                        </div>
                        <section id="tratamentos">
                        </section>
                        <div class="form-group">
                            <label class="control-label col-md-offset-8 col-md-1 col-sm-offset-8 col-sm-1 col-xs-12"
                                   for="first-name">Total:</label>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <input id="valor_total" type="text" disabled class="form-control"
                                       placeholder="Valor">
                                <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-9 col-md-2 col-sm-offset-9 col-sm-2 col-xs-12">
                                <button id="add-tratamento" data-action="edit" type="button"
                                        class="btn btn-primary"><i class="fa fa-plus-circle fa-2"></i> Adicionar
                                    tratamento
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="x_title" style="margin-top:20px;">
                        <h2>Forma de Pagamento</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" id="pagamento-container">
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Desconto
                                (%)</label>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <input type="text" onkeyup="atualiza_total('edit')" class="form-control"
                                       id="desconto" name="desconto">
                            </div>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Valor de
                                entrada</label>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <input type="text" onkeyup="atualiza_total('edit')" class="form-control"
                                       name="valor_entrada">
                                <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Número de
                                Parcelas</label>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <input type="number" onchange="atualiza_total('edit')"
                                       onkeyup="atualiza_total('edit')" min="1" class="form-control" value="1"
                                       name="numero_parcelas" required="required">
                            </div>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Valor das
                                Parcelas</label>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <input id="valor_parcela" type="text" class="form-control" disabled
                                       placeholder="Valor da parcela:">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-offset-7 col-md-2 col-sm-offset-7 col-sm-2 col-xs-12"
                                   for="first-name">Valor total com desconto:</label>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <input id="valor_total_desconto" type="text" disabled class="form-control">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group pull-right">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <a class="edit-orcamento-cancel btn btn-block btn-round btn-danger"><i
                                            class="fa fa-times"></i> Cancelar</a>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <button type="submit" class="btn btn-block btn-round btn-success"><i
                                            class="fa fa-save"></i> Salvar
                                </button>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </section>
                <section id="show-orcamentos">
                    <table class="table table-striped dt-responsive table-bordered nowrap" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Status</th>
                            <th>Dentista/Data</th>
                            <th>Descrição</th>
                            <th>Valor</th>
                            <th>Desconto</th>
                            <th>Total</th>
                            <th>Pagamento</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--@foreach($Paciente->orcamentos_abertos as $orcamento)--}}
                        @foreach($Paciente->orcamentos as $orcamento)
                            <tr>
                                <td>
                                    {{$orcamento->idorcamento}}
                                </td>
                                <td class="td-aprovar">
                                    @if($orcamento->aprovacao == 1)
                                        <span class="btn btn-success btn-xs"> Aprovado</span>
                                    @else
                                        <span class="btn btn-danger btn-xs"> Não Aprovado</span>
                                    @endif
                                </td>
                                <td>
                                    <span>{{$orcamento->profissional->nome}}</span>
                                    <br/>
                                    <small>Data: {{$orcamento->created_at}}</small>
                                </td>
                                <td>
                                    <span>{{$orcamento->descricao}}</span>
                                </td>
                                <td>
                                    <span>{{$orcamento->valor_total}}</span>
                                </td>
                                <td>
                                    @if($orcamento->desconto>0)
                                        <span>{{$orcamento->valor_desconto()}} ({{$orcamento->desconto}}
                                            %)</span>
                                    @else
                                        <p class="text-center">-</p>
                                    @endif
                                </td>
                                <td>
                                    <span class="preco show-valor">{{$orcamento->valor_final_total()}}</span>
                                </td>
                                <td>
                                    @if($orcamento->valor_entrada>0)
                                        <span>{{$orcamento->valor_entrada}}</span>
                                        <br/>
                                        <small>+
                                            {{$orcamento->numero_parcelas}} &times; {{$orcamento->valor_parcelas()}}</small>
                                    @else
                                        <span class="show-valor">{{$orcamento->numero_parcelas}} &times; {{$orcamento->valor_parcelas()}}</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-default btn-xs"
                                       href="{{route('orcamento.enviar',$orcamento->idorcamento)}}"><i
                                                class="fa fa-envelope"></i></a>
                                    <a class="btn btn-default btn-xs"
                                       target="_blank"
                                       href="{{route('orcamento.imprimir',$orcamento->idorcamento)}}"><i
                                                class="fa fa-print"></i></a>
                                    @if(!$orcamento->aprovacao)
                                        <a href="{{route('orcamento.aprovar',$orcamento->idorcamento)}}"
                                           class="btn btn-aprovar btn-default btn-xs"><i
                                                    class="fa fa-thumbs-o-up"></i> Aprovar</a>
                                        <a class="btn btn-info btn-xs"
                                           onclick="edit_orcamento(this)"
                                           data-dados='{{$orcamento}}'
                                           data-valor_entrada="{{$orcamento->valor_entrada_float()}}"
                                           data-itens="{{$orcamento->itens_orcamento}}"><i
                                                    class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger btn-xs"
                                           data-nome="Orçamento: {{$orcamento->descricao}}"
                                           data-href="{{route('orcamentos.destroy', $orcamento->idorcamento)}}"
                                           data-toggle="modal"
                                           data-target="#modalExclusao"><i class="fa fa-trash-o fa-sm"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
            @endif
        </div>
    </div>
</div>