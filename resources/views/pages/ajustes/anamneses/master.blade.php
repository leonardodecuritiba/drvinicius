@extends('layouts.template')
@section('modal_content')
    <style>
        span.msg-alerta {
            position: relative;
            top: 10px;
        }
    </style>
    <div class="modal fade" id="perguntaModal" tabindex="-1" role="dialog" aria-labelledby="perguntaModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <span id='0' class="hide">
                        <div class="form-horizontal form-label-left">
                            <label for="pergunta"></label>
                            <p>
                                <input type="radio" class="flat" name="resposta" value="0" checked="checked"/> Não
                                <input type="radio" class="flat" name="resposta" value="1"/> Sim
                                <input type="radio" class="flat" name="resposta" value="2"/> Não sei
                            </p>
                            <span class="msg-alerta hide">
                                <label for="alerta"></label>
                                <p></p>
                            </span>
                        </div>
                    </span>
                    <span id='1' class="hide">
                        <div class="form-horizontal form-label-left">
                            <label for="pergunta"></label>
                            <p>
                                <input type="radio" class="flat" name="resposta" value="0" checked="checked"/> Não
                                <input type="radio" class="flat" name="resposta" value="1"/> Sim
                                <input type="radio" class="flat" name="resposta" value="2"/> Não sei
                            </p>
                            <input type="text" class="form-control" placeholder="Resposta textual">
                            <span class="msg-alerta hide">
                                <label for="alerta"></label>
                                <p></p>
                            </span>
                        </div>
                    </span>
                    <span id='2' class="hide">
                        <div class="form-horizontal form-label-left">
                            <label for="pergunta"></label>
                            <input type="text" class="form-control" placeholder="Resposta textual">
                            <span class="msg-alerta hide">
                                <label for="alerta"></label>
                                <p></p>
                            </span>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_content')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{$Page->Titulo}}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                @if($Page->funcao == 'create')
                    {!! Form::open(['route'=>strtolower($Page->link).'.store', 'class' => 'form-horizontal form-label-left']) !!}
                    @include('pages.ajustes.'.strtolower($Page->link).'.forms.form')
                    <div class="divider"></div>
                    <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                        <a href="{{ url(strtolower($Page->link)) }}" class="btn btn-warning btn-lg btn-block">Voltar</a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                        {!! Form::submit('Cadastrar',array('class' => 'btn btn-success btn-lg btn-block')) !!}
                    </div>
                    {!! Form::close() !!}
                @elseif($Page->funcao == 'edit')
                    {!! Form::open(['method' => 'PATCH','route'=>[strtolower($Page->link).'.update',$Anamnese->idanamnese], 'class' => 'form-horizontal form-label-left']) !!}
                    @include('pages.ajustes.'.strtolower($Page->link).'.forms.form')
                    <div class="divider"></div>
                    <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                        <a href="{{ url(strtolower($Page->link)) }}" class="btn btn-warning btn-lg btn-block">Voltar</a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                        {!! Form::submit('Salvar',array('class' => 'btn btn-success btn-lg btn-block')) !!}
                    </div>
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
        @if($Page->funcao == 'edit')
            <div class="x_panel">
                <div class="x_title">
                    <h2>Lista de perguntas da Anamnese <i>{{$Anamnese->nome}}</i></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 animated fadeInDown">
                            <table border="0" class="table table-hover">
                                <thead>
                                <tr>
                                    <th># Ordem</th>
                                    <th>Texto da Pergunta</th>
                                    <th>Tipo de Pergunta</th>
                                    <th>Tipo de Resposta</th>
                                    <th>Mensagem de alerta</th>
                                    <th colspan="2">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php $last_numero_ordem = 0;?>
                                @if(count($Anamnese->perguntas) > 0)
                                    @foreach ($Anamnese->perguntas as $pergunta)
										<?php $last_numero_ordem = $pergunta->numero_ordem;?>
                                        {!! Form::open(['method' => 'PATCH','route'=>['perguntas.update',$pergunta->idpergunta], 'class' => 'form-horizontal form-label-left']) !!}
                                        <input name="idanamnese" type="hidden" value="{{$Anamnese->idanamnese}}">
                                        <tr>
                                            <td>
                                                <span>{{$pergunta->numero_ordem}}</span>
                                                <input name="numero_ordem" type="text" class="form-control hide"
                                                       value="{{$pergunta->numero_ordem}}">
                                            </td>
                                            <td>
                                                <span>{{$pergunta->texto_pergunta}}</span>
                                                <input name="texto_pergunta" type="text" class="form-control hide"
                                                       value="{{$pergunta->texto_pergunta}}">
                                            </td>
                                            <td>
                                                <span>{{$pergunta->traduzTipoPergunta()}}</span>
                                                <select id="tipo_pergunta" name="tipo_pergunta"
                                                        class="form-control hide" required>
                                                    @foreach($tipo_perguntas as $i => $valor)
                                                        <option value="{{$i}}">{{$valor}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <span>{{$pergunta->traduzTipoResposta()}}</span>
                                                <select id="tipo_resposta" name="tipo_resposta"
                                                        class="form-control hide" required>
                                                    @foreach($tipo_respostas as $i => $valor)
                                                        <option value="{{$i}}">{{$valor}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <span>{{$pergunta->msg_alerta}}</span>
                                                <input name="msg_alerta" type="text" class="form-control hide"
                                                       value="{{$pergunta->msg_alerta}}">
                                            </td>
                                            <td>
                                                <a class="btn btn-default btn-xs" id='open-modal'
                                                   data-pergunta="{{json_encode($pergunta)}}"
                                                   data-target="#perguntaModal"><i class="fa fa-eye"></i> Visualizar</a>
                                                <a class="btn btn-primary btn-xs" id="edit-inline"><i
                                                            class="fa fa-edit"></i> Editar</a>
                                                <button type="submit" class="btn btn-success btn-xs hide"><i
                                                            class="fa fa-check"></i> Salvar
                                                </button>
                                                <a class="btn btn-danger btn-xs"
                                                   data-nome='a pergunta "{{$pergunta->texto_pergunta}}"'
                                                   data-href="{{route('perguntas.destroy',$pergunta->idpergunta)}}"
                                                   data-toggle="modal"
                                                   data-target="#modalRemocao"><i class="fa fa-trash-o fa-sm"></i>
                                                    Excluir </a>
                                            </td>
                                        </tr>
                                        {!! Form::close() !!}
                                    @endforeach
                                @endif
                                <tr id="add">
                                    {!! Form::open(['route'=>'perguntas.store', 'class' => 'form-horizontal form-label-left']) !!}
                                    <input name="idanamnese" type="hidden" value="{{$Anamnese->idanamnese}}">
                                    <td>
                                        <input type="number" id="numero_ordem" name="numero_ordem" class="form-control"
                                               value="{{++$last_numero_ordem}}" required>
                                    </td>
                                    <td><input name="texto_pergunta" type="text" class="form-control" value=""
                                               placeholder="Texto da pergunta" required></td>
                                    <td>
                                        <select id="tipo_pergunta" name="tipo_pergunta" class="form-control" required>
                                            @foreach($tipo_perguntas as $i => $valor)
                                                <option value="{{$i}}">{{$valor}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select id="tipo_resposta" name="tipo_resposta" class="form-control" required>
                                            @foreach($tipo_respostas as $i => $valor)
                                                <option value="{{$i}}">{{$valor}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input name="msg_alerta" type="text" class="form-control" value=""
                                               placeholder="Mensagem de alerta em caso crítico"></td>
                                    <td>
                                        <button type="submit" class="btn btn-info btn-xs">
                                            <i class="fa fa-plus fa-sm"></i> Adicionar Pergunta
                                        </button>
                                    </td>
                                    {!! Form::close() !!}
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('scripts_content')
    <script>
        function traduzTipoPergunta($value) {
            switch ($value) {
                case 0:
                    $value = 'Não crítica';
                    break;
                case 1:
                    $value = 'Crítica para SIM';
                    break;
                case 2:
                    $value = 'Crítica para NÃO';
                    break;
            }
            return $value;
        }

        $(document).ready(function () {

            $('a#open-modal').click(function () {
                var elmodal = $(this).data('target');
                var pergunta = $(this).data('pergunta');
                $(elmodal).find('.modal-title').text('Visualizar pergunta');
                $(elmodal).find('.modal-body span').addClass('hide');

                tipo_resposta = pergunta.tipo_resposta;
                tipo_pergunta = pergunta.tipo_pergunta;
                txt_pergunta = pergunta.texto_pergunta;

                $campo = $(elmodal).find('.modal-body span#' + tipo_resposta);
                $campo.removeClass('hide');
                $campo.find('label').html(txt_pergunta);

                if (tipo_pergunta > 0) {
//                    txt_pergunta += ' (<i>' + traduzTipoPergunta(tipo_pergunta) + '</i>)';
                    txt_alerta = 'Mensagem (' + traduzTipoPergunta(tipo_pergunta) + '): ';
                    msg_alerta = '<i>' + pergunta.msg_alerta + '</i>:';
                    $campo.find('span.msg-alerta label').html(txt_alerta);
                    $campo.find('span.msg-alerta p').html(msg_alerta);
                    $campo.find('span.msg-alerta').removeClass('hide');
                }

                $(elmodal).modal();

            });

            $('a#edit-inline').click(function () {
                $parent = $(this).parents('tr');
                $($parent).find('span').addClass('hide');
                $($parent).find('input').removeClass('hide');
                $($parent).find('select').removeClass('hide');

                //transformar botão
                $(this).addClass('hide');
                $(this).next().removeClass('hide');
            });
        });
    </script>


    @if($Page->funcao == 'XXXedit')
        <script>
            var temp = <?php echo json_encode( $Intervencoes );?>;
            var intervencoes = jQuery.parseJSON(temp);

            $(document).ready(function () {
                if (intervencoes.length > 0) {
                    $('tr#add').removeClass('hide');
                }

                //Seleção da intervenção
                $('select#idintervencao').change(function () {
                    var id_atual = $(this).val();

                    $parent = $(this).parents('tr#add');
                    $($parent).find('td#regiao').empty();
                    $($parent).find('td#regiao').empty();
                    $($parent).find('button').attr('disabled', true);

                    $(intervencoes).each(function (i, v) {
                        if (id_atual == v.idintervencao) {
                            $($parent).find('button').attr('disabled', false);
                            $($parent).find('td#regiao').html(v.regiao);
                            $($parent).find('td#valor').html('R$ ' + v.valor);
                            return;
                        }
                    });
                });

                //Edição

            });
        </script>
    @endif
@endsection