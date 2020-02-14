@extends('layouts.template')
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
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Opções:</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="checkbox">
                                <label class="plano_padrao">
                                    <input type="radio" name="plano_padrao" class="flat" value="0" checked="checked">
                                    Não copiar (plano vazio)
                                </label>
                            </div>
                            <div class="checkbox">
                                <label class="plano_padrao">
                                    <input type="radio" name="plano_padrao" class="flat" value="1"> Copiar tratamentos
                                    do plano
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="copiar" style="display: none;">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Copiar de:</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select class="form-control" name="idplano">
                                    @foreach($Planos as $plano)
                                        <option value="{{$plano->idplano}}">{{$plano->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                        <a href="{{ url(strtolower($Page->link)) }}" class="btn btn-warning btn-lg btn-block">Voltar</a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 form-group">
                        {!! Form::submit('Cadastrar',array('class' => 'btn btn-success btn-lg btn-block')) !!}
                    </div>
                    {!! Form::close() !!}
                @elseif($Page->funcao == 'edit')
                    {!! Form::open(['method' => 'PATCH','route'=>[strtolower($Page->link).'.update',$Plano->idplano], 'class' => 'form-horizontal form-label-left']) !!}
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
                    <h2>Lista de intervenções do plano <i>{{$Plano->nome}}</i></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 animated fadeInDown">
                            <table border="0" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Região</th>
                                    <th>Valor da intervenção</th>
                                    <th>Valor do plano</th>
                                    {{--<th>Valor do paciente</th>--}}
                                    <th colspan="2">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($Plano->plano_intervencao) > 0)
                                    @foreach ($Plano->plano_intervencao as $plano_intervencao)
                                        {!! Form::open(['method' => 'PATCH','route'=>['plano_intervencao.update',$plano_intervencao->idplano_intervencao], 'class' => 'form-horizontal form-label-left']) !!}
                                        <input name="idplano" type="hidden" value="{{$Plano->idplano}}">
                                        <tr>
                                            <td>{{$plano_intervencao->intervencao->nome}}</td>
                                            <td>{{$plano_intervencao->intervencao->regiao}}</td>
                                            <td class="show-valor">R$ {{$plano_intervencao->intervencao->valor}}</td>
                                            <td class="show-valor" data-value="{{$plano_intervencao->valor_plano}}">
                                                <span>R$ {{$plano_intervencao->valor_plano}}</span>
                                                <input name="valor_plano" type="text"
                                                       class="form-control show-valor hide"
                                                       value="{{$plano_intervencao->valor_plano}}">
                                            </td>
                                            {{--<td class="show-valor" data-value="{{$plano_intervencao->valor_paciente}}">--}}
                                            {{--<span>R$ {{$plano_intervencao->valor_paciente}}</span>--}}
                                            {{--<input name="valor_paciente" type="text" class="form-control show-valor hide" value="{{$plano_intervencao->valor_paciente}}">--}}
                                            {{--</td>--}}
                                            <td>
                                                <a class="btn btn-primary btn-xs" id="edit-inline"><i
                                                            class="fa fa-edit"></i> Editar</a>
                                                <button type="submit" class="btn btn-success btn-xs hide"><i
                                                            class="fa fa-check"></i> Salvar
                                                </button>
                                                <a class="btn btn-danger btn-xs"
                                                   data-nome="{{$plano_intervencao->intervencao->nome}}"
                                                   data-href="{{route('plano_intervencao.destroy',$plano_intervencao->idplano_intervencao)}}"
                                                   data-toggle="modal"
                                                   data-target="#modalRemocao"><i class="fa fa-trash-o fa-sm"></i>
                                                    Excluir </a>
                                            </td>
                                        </tr>
                                        {!! Form::close() !!}
                                    @endforeach
                                @endif
                                <tr id="add" class="hide">
                                    {!! Form::open(['route'=>'plano_intervencao.store', 'class' => 'form-horizontal form-label-left']) !!}
                                    <input name="idplano" type="hidden" value="{{$Plano->idplano}}">
                                    <td>
                                        <select id="idintervencao" name="idintervencao" class="form-control">
                                            <option>Escolha</option>
                                            @foreach(json_decode($Intervencoes) as $intervencao)
                                                <option value="{{$intervencao->idintervencao}}">{{$intervencao->nome}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td id="regiao"></td>
                                    <td id="valor"></td>
                                    <td><input name="valor_plano" type="text" class="form-control show-valor" value="">
                                    </td>
                                    {{--<td><input name="valor_paciente" type="text" class="form-control show-valor" value=""></td>--}}
                                    <td>
                                        <button disabled type="submit" class="btn btn-info btn-xs">
                                            <i class="fa fa-plus fa-sm"></i> Adicionar Intervenção
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
    @if($Page->funcao == 'edit')
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
                //Edição da intervenção
                $('a#edit-inline').click(function () {
                    $parent = $(this).parents('td');
                    $($parent).find('span').addClass('hide');
                    $($parent).find('input').removeClass('hide');
                    $vplano = $($parent).prev();
                    $($vplano).find('span').addClass('hide');
                    $($vplano).find('input').removeClass('hide');

                    /*
                    $vpaciente = $($parent).prev();
                    $($vpaciente).find('span').addClass('hide');
                    $($vpaciente).find('input').removeClass('hide');
                    $vplano = $($vpaciente).prev();
                    $($vplano).find('span').addClass('hide');
                    $($vplano).find('input').removeClass('hide');
                    */

                    //transformar botão
                    $(this).addClass('hide');
                    $(this).next().removeClass('hide');
                });
            });
            $(document).ready(function () {
                $('input[name=plano_padrao]').change(function () {
                    alert($(this).val());
                });
            });

        </script>
    @else

        <script>
            $(document).ready(function () {
                $('label.plano_padrao').click(function () {
                    valo = $(this).find('input[name=plano_padrao]').val();
                    if (valo == "1") {
                        $('div.copiar').show();
                    } else {
                        $('div.copiar').hide();
                    }
                });
            });

        </script>
    @endif
@endsection