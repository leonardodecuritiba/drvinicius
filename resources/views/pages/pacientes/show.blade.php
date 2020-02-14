@extends('layouts.template')
@section('style_content')

    <!-- Datatables -->
    @include('helpers.datatables.head')
    <!-- /Datatables -->
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />--}}
    <style>
        .select2 {
            width: 100%;
        }

        .preco {
            font-size: 13px;
            font-weight: 400;
            color: #26B99A;
        }
    </style>

    {!! Html::style('vendors/dropzone/dist/min/dropzone.min.css') !!}
@endsection
@section('modal_content')
    @include('layouts.modals.exclui')
    @include('layouts.modals.modalRetorno')
    @include('pages.pacientes.modals.financeiro.forma_pagamento')
    @include('pages.pacientes.modals.financeiro.receber')
    @include('pages.pacientes.modals.financeiro.recibo')
    @include('pages.pacientes.modals.financeiro.recebimentos')
    @include('pages.pacientes.modals.financeiro.alterar')
    @include('pages.pacientes.modals.alerts.alerta')
    @include('pages.pacientes.modals.evolucao')
    @include('pages.pacientes.modals.uploads')
@endsection
@section('page_content')
    <div class="row">
        <div class="x_panel">
            <div class="x_title">
                <h2>Prontuário - {{$Paciente->nome}}</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <button class="btn btn-danger"
                                data-toggle="modal"
                                data-target="#modalAlertas"><i class="fa fa-exclamation-triangle fa-2"></i> Alertas
                        </button>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                        @include('pages.pacientes.paineis.perfil')
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        @include('pages.pacientes.paineis.sobre')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        {{--Anamnese--}}
        @include('pages.pacientes.paineis.anamnese')
        {{--/Anamnese--}}
        {{--Evoluções--}}
        @include('pages.pacientes.paineis.evolucoes')
        {{--/Evoluções--}}
    </div>

    <div class="row">
        {{--Orçamentos--}}
        @include('pages.pacientes.paineis.orcamentos')
        {{--/Orçamentos--}}
        {{--recebimentos--}}
        @include('pages.pacientes.paineis.recebimentos')
        {{--/recebimentos--}}
    </div>

    {{--Documentos--}}
    @include('pages.pacientes.paineis.documentos')
    {{--/Documentos--}}
@endsection
@section('scripts_content')
    <!-- tags -->
    {!! Html::script('js/tags/jquery.tagsinput.min.js') !!}
    <!-- switchery -->
    {!! Html::script('js/switchery/switchery.min.js') !!}
    <!-- richtext editor -->
    {!! Html::script('js/editor/bootstrap-wysiwyg.js') !!}
    {!! Html::script('js/editor/external/jquery.hotkeys.js') !!}
    {!! Html::script('js/editor/external/google-code-prettify/prettify.js') !!}
    <!-- select2 -->
    <!-- form validation -->
    {!! Html::script('js/parsley/parsley.min.js') !!}
    <!-- textarea resize -->


    <!-- Select2 -->
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>--}}
    {!! Html::script('vendors/select2/dist/js/select2.min.js') !!}

    <!-- Select2 -->
    <script>
        $(document).ready(function () {
            $(".select2").select2({width: 'resolve'});
        });
    </script>
    <!-- /Select2 -->

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

    <!-- dropzone -->
    {!! Html::script('vendors/dropzone/dist/min/dropzone.min.js') !!}

    {{--Retorno--}}
    <script>
        $(document).ready(function () {
            $('div#modalRetorno').on('show.bs.modal', function (e) {
                $origem = $(e.relatedTarget);
                idpaciente_ = $($origem).data('idpaciente');
                $(this).find('.modal-body input#idpaciente').val(idpaciente_);
            });
        });
    </script>

    {{--Alertas--}}
    <script>
        $('#modalAlertas').on('show.bs.modal', function (event) {
            var $this = $(this);
            $modal_body = $($this).find('div.modal-body');
            $($modal_body).empty();
            $.ajax({
                url: '{{route('alertas.pacientes',$Paciente->idpaciente)}}',
                type: 'GET',
                dataType: "json",
                error: function (xhr, textStatus) {
                    console.log('xhr-error: ' + xhr.responseText);
                    console.log('textStatus-error: ' + textStatus);
                },
                success: function (json) {
                    console.log(json);
                    if (json.status == 1) {
                        $($modal_body).append('<div class="alert alert-danger"><ul></ul></div>');
                        $(json.response).each(function (i, v) {
                            $($modal_body).find('ul').append($('<li></li>').html(v));
                        })
                    } else {
                        $($modal_body).html(json.response);
                    }
                }
            });
        })
    </script>

    {{--Anamnese--}}
    <script>
        $(document).ready(function () {

            $('div#tab_anamnese div.x_content form').on('submit', function (e) {
                // Prevent form submission
                e.preventDefault();

                var $form = $(e.target);
                // Use Ajax to submit form data
                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',
                    data: $form.serialize(),
                    beforeSend: function () {
                        $('div.loading').show();
                    },
                    success: function (json) {
                        if (json.status == 1) {
                            new PNotify({
                                title: 'Sucesso!',
                                text: json.response,
                                type: 'success',
                                delay: 2000,
                                styling: 'bootstrap3'
                            });
                        }
                        $('div.loading').hide();
                    }
                });

            });
            $('select#idanamnese').change(function () {
                id = $(this).val();
                $a_imprimir = $(this).parents('div.form-group').find('a.imprimir');
                $a_imprimir.hide();
                if (id > 0) {
                    var url = ("{{route('anamnese.imprimir',['idpaciente' => $Paciente->idpaciente,'idanamnese' =>  '_0_'])}}").replace('_0_', id);
                    $a_imprimir.attr("href", url);
                    $a_imprimir.show();
                }
                $form = $(this).parents('form');
                $($form).find('div.anamnese').addClass('hide');
                $($form).find('div[data-id="' + id + '"]').removeClass('hide');
            });
        });
    </script>
    {{--/Anamnese--}}

    {{--ORCAMENTOS--}}
    <script>

        var cont = 0;
        var VALOR_TOTAL = 0;
        var VALOR_TOTAL_DESCONTO = 0;
        var temp = '<?php echo json_encode( $Intervencoes );?>';
        $Intervencoes = jQuery.parseJSON(temp);
        $INPUT_desconto = '';

        //Atualização do select das intervenções
        function popula_intervencao(cont, $select) {
            $.each($Intervencoes, function (i, intervencao) {
                $($select).append($('<option>', {
                    value: intervencao.idintervencao,
                    text: intervencao.nome,
                    'data-codigo': intervencao.codigo,
                    'data-regiao': intervencao.regiao,
                    'data-valor': intervencao.valor
                }));
            });
        }

        function atualiza_total(action = 'new') {
            console.log(action);
            if (action == 'new') {
                $input_desconto = $INPUT_desconto_new;
                $input_valor_entrada = $INPUT_valor_entrada_new;
                $input_parcelas = $INPUT_parcelas_new;
                $input_valor_parcelas = $INPUT_valor_parcelas_new;
                $input_valor_desconto = $INPUT_valor_desconto_new;
                $input_valor_total = $INPUT_valor_total_new;
            } else {
                $input_desconto = $INPUT_desconto_edit;
                $input_valor_entrada = $INPUT_valor_entrada_edit;
                $input_parcelas = $INPUT_parcelas_edit;
                $input_valor_parcelas = $INPUT_valor_parcelas_edit;
                $input_valor_desconto = $INPUT_valor_desconto_edit;
                $input_valor_total = $INPUT_valor_total_edit;
            }
            desconto = parseInt($($input_desconto).val().replace('%', ''));
            if (desconto >= 100) {
                $($input_desconto).maskMoney('mask', 100);
                desconto = 100;
            }

            VALOR_TOTAL = 0;
            $parent = $('section#' + action + '-orcamento').find('div#orcamento-container');
            $($parent).find('section#tratamentos').find('input[name^="valor"]').each(function (i, v) {
                valor_atual = 0;
                valor_atual = $(this).maskMoney('unmasked')[0];
                VALOR_TOTAL += valor_atual
            });

            entrada = $($input_valor_entrada).maskMoney('unmasked')[0];

            VALOR_TOTAL_DESCONTO = VALOR_TOTAL;
            if (!isNaN(desconto) && desconto != "") {
                VALOR_TOTAL_DESCONTO = VALOR_TOTAL_DESCONTO - (VALOR_TOTAL_DESCONTO * desconto) / 100;
            }

            n_parcela = $($input_parcelas).val();
            n_parcela = (n_parcela != '' && n_parcela > 0) ? n_parcela : 1;
            valor_parcelas = (VALOR_TOTAL_DESCONTO - entrada) / n_parcela;

            $($input_valor_parcelas).maskMoney('mask', valor_parcelas);
            $($input_valor_desconto).maskMoney('mask', VALOR_TOTAL_DESCONTO);
            $($input_valor_total).maskMoney('mask', VALOR_TOTAL);
        }

        function popula_valores($this) {
            $op = $($this).find(":selected");
            $parents = $($this).parents('div.form-group');
            console.log($op);
            $parents.find('input#codigo').val($op.data('codigo'));
            $parents.find('input#regiao').val($op.data('regiao'));
            initMaskMoney($parents.find('input#valor').val($op.data('valor')));
            atualiza_total($($parents).data('action'));
//        atualiza_total('new');
        }

        function add_campos(cont, $this_btn) {
            action = $($this_btn).data('action');
            console.log(action)
            $($this_btn).parents('div.form-group').siblings('section').append(get_campos(cont, action));
            $this = "select[name='idintervencao[" + cont + "]']";

            popula_intervencao(cont, "select[name='idintervencao[" + cont + "]']");
            popula_valores($this);

            $($this).select2({width: 'resolve'});
            initMaskMoney($("input[name='valor[" + cont + "]']"));

            console.log(VALOR_TOTAL);
            atualiza_total(action);
        }

        function get_campos(cont, action, iditem = 0) {
            field_iditem = (iditem == 0) ? '' : '<input name="iditem_orcamento[' + cont + ']" type="hidden" value="' + iditem + '">';
            return '<div class="form-group" data-action="' + action + '">' +
                field_iditem +
                '<label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tratamento:</label>' +
                '<div class="col-md-4 col-sm-4 col-xs-12">' +
                '<select id="interv" onchange="popula_valores(this);" class="select2 form-control" tabindex="-1" style="width: 100%;" name="idintervencao[' + cont + ']">' +
                '</select>' +
                '</div>' +
                '<div class="col-md-2 col-sm-2 col-xs-12">' +
                '<input id="codigo" type="text" class="form-control" disabled placeholder="Código">' +
                '<span class="fa fa-info-circle form-control-feedback right" aria-hidden="true"></span>' +
                '</div>' +
                '<div class="col-md-2 col-sm-2 col-xs-12">' +
                '<input id="regiao" type="text" class="form-control" name="regiao[' + cont + ']" placeholder="Região">' +
                '<span class="fa fa-info-circle form-control-feedback right" aria-hidden="true"></span>' +
                '</div>' +
                '<div class="col-md-2 col-sm-2 col-xs-12">' +
                '<input id="valor" onkeyup="atualiza_total(\'' + action + '\')" type="text" class="form-control show-valor" name="valor[' + cont + ']" placeholder="Valor">' +
                '<span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>' +
                '</div>' +
                '<div class="col-md-1 col-sm-1 col-xs-12">' +
                '<button onclick="remove_valores(this)" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Excluir</button>' +
                '</div>' +
                '</div>';
        }

        function remove_valores($this) {
            $parents = $($this).parents('div.form-group');
            //if isset item_orcamento
            //;
            if (typeof ($($parents).find('input[name^="iditem_orcamento"]').val()) != 'undefined') {
                var URL = '{{route('item_orcamento.remove', '_0_')}}';
                iditem_orcamento = $($parents).find('input[name^="iditem_orcamento"]').val();

                $.ajax({
                    url: URL.replace('_0_', iditem_orcamento),
                    type: 'GET',
                    dataType: "json",
                    error: function (xhr, textStatus) {
                        console.log('xhr-error: ' + xhr.responseText);
                        console.log('textStatus-error: ' + textStatus);
                    },
                    beforeSend: function () {
                        $(".loading").show();
                    },
                    complete: function (xhr, textStatus) {
                        $(".loading").hide();
                    },
                    success: function (json) {
                        console.log(json);
                        if (json.status == 1) {
                            $($parents).remove();
                            atualiza_total($($parents).data('action'));
                        } else {
                            alert('Erro ao remover');
                        }
                    }
                });
            } else {
                $($parents).remove();
                atualiza_total($($parents).data('action'));
            }
        }

        //INICIALIZAÇÃO DE CAMPOS E VARIÁVEIS
        $(document).ready(function () {
            $INPUT_desconto_new = $('div#pagamento-container').find("input#desconto");
            $INPUT_valor_total_new = $('div#orcamento-container').find("input#valor_total");
            $INPUT_valor_entrada_new = $('div#pagamento-container').find("input[name=valor_entrada]");
            $INPUT_parcelas_new = $('div#pagamento-container').find("input[name=numero_parcelas]");
            $INPUT_valor_parcelas_new = $('div#pagamento-container').find("input#valor_parcela");
            $INPUT_valor_desconto_new = $('div#pagamento-container').find("input#valor_total_desconto");

            initMaskMoney($INPUT_valor_total_new);
            initMaskMoney($INPUT_valor_entrada_new);
            initMaskMoney($INPUT_valor_parcelas_new);
            initMaskMoney($INPUT_valor_desconto_new);
            initMaskPercent($INPUT_desconto_new);

            popula_intervencao(0, "select[name='idintervencao[" + cont + "]']");
            VALOR_TOTAL += popula_valores("section#new-orcamento select[name='idintervencao[" + cont + "]']");
//        atualiza_total('new');

            $parent = $('section#edit-orcamento');
            $INPUT_descricao_edit = $($parent).find("input[name=descricao]");
            $INPUT_idprofissional_edit = $($parent).find("select[name=idprofissional]");
            $INPUT_desconto_edit = $($parent).find("input#desconto");
            $INPUT_valor_total_edit = $($parent).find("input#valor_total");
            $INPUT_valor_entrada_edit = $($parent).find("input[name=valor_entrada]");
            $INPUT_parcelas_edit = $($parent).find("input[name=numero_parcelas]");
            $INPUT_valor_parcelas_edit = $($parent).find("input#valor_parcela");
            $INPUT_valor_desconto_edit = $($parent).find("input#valor_total_desconto");

            initMaskMoney($INPUT_valor_total_edit);
            initMaskMoney($INPUT_valor_entrada_edit);
            initMaskMoney($INPUT_valor_parcelas_edit);
            initMaskMoney($INPUT_valor_desconto_edit);
            initMaskPercent($INPUT_desconto_edit);

        });

        //INICIALIZAÇÃO DE BOTÕES

        function edit_orcamento($this) {
            var $parent = $($this).closest('div.x_content').find('section#edit-orcamento');
            var ORCAMENTO = $($this).data('dados');
            var $data = $($this).data();
            var URL = $($parent).find('form#form-edit').attr('action');

            $($parent).find('form#form-edit').attr('action', URL.replace('_0_', ORCAMENTO.idorcamento))

            $($INPUT_descricao_edit).val(ORCAMENTO.descricao);
            $($INPUT_idprofissional_edit).val(ORCAMENTO.idprofissional).trigger("change");
            $($INPUT_valor_entrada_edit).maskMoney('mask', parseFloat($data.valor_entrada));
            $($INPUT_desconto_edit).maskMoney('mask', ORCAMENTO.desconto);
            $($INPUT_parcelas_edit).val(ORCAMENTO.numero_parcelas);

            console.log($data);

            $.each($data.itens, function (i, v) {
//                console.log(v);
                cont++;
                $($parent).find('section#tratamentos').append(get_campos(cont, 'edit', v.iditem_orcamento));

                var $this_i = $($parent).find("select[name='idintervencao[" + cont + "]']");
                popula_intervencao(cont, $this_i);
                $($this_i).select2({width: 'resolve'}).val(v.idintervencao).trigger('change');
//                popula_valores($this);

                var $this_parent = $($this_i).parents("div.form-group");
                //Região do tratamento
                $($this_parent).find("input#regiao").val(v.regiao);
                //Valor do tratamento
                $($this_parent).find("input#valor").val(v.valor);
            });

            $($parent).toggle("slow");
            $($parent).next().toggle("slide");
            atualiza_total('edit');
        }

        $(document).ready(function () {

            $('button#add-orcamento').click(function () {
                $('section#new-orcamento').toggle('slow');
            });

            $('button#add-tratamento').click(function () {
                cont++;
                add_campos(cont, $(this));
            });


            $('a.edit-orcamento-cancel').click(function () {
                $parent = $(this).closest('section#edit-orcamento');
                $($parent).toggle("quick");
                $($parent).next().toggle("slide");
                $($parent).find('div#orcamento-container').find('section#tratamentos').empty();
            });

        });
    </script>
    {{--/ORCAMENTOS--}}

    {{--FINANCEIRO--}}
    <script>
        $(document).ready(function () {
            var _URL_IMPRIMIR_PARCELA_PAGAMENTO_ = '{{route('parcelas_pagamento.imprimir','_IDPARCELA_PAGAMENTO_')}}';
            var _URL_ESTORNAR_PARCELA_PAGAMENTO_ = '{{route('parcelas_pagamento.estornar','_IDPARCELA_PAGAMENTO_')}}';
            $_MODAL_RECEBER_ = $('#modalReceber');
            $_MODAL_FORMA_PAGAMENTO_ = $('#modalFormaPgto');
            $_MODAL_RECIBO_ = $('#modalRecibo');
            $_MODAL_ALTERAR_VENCIMENTO_ = $('#modalAlterarVencimento');
            $_MODAL_RECEBIMENTOS_ = $('#modalRecebimentos');

            $($_MODAL_RECEBER_).on('show.bs.modal', function (event) {
                //listagem das parcelas à receber
                var $button = $(event.relatedTarget);
                var $modal = $(this);
                var $loading = $($modal).find('div.modal-content div.loading');
                var $table_body = $($modal).find('.modal-body table tbody');
                var table = $($modal).find('.modal-body table').DataTable();
                table
                    .clear()
                    .draw();
                $($table_body).empty();
                var href = $($button).data('href');
                console.log(href);
                $.ajax({
                    url: href,
                    type: 'GET',
                    beforeSend: function () {
                        $($loading).show();
                    },
                    complete: function () {
                        $($loading).hide();
                    },
                    success: function (json) {
                        console.log(json);
                        if ($(json).length > 0) {
                            $.each(json, function (i, v) {
                                table.row.add([
                                    v.idparcela,
                                    '<p class="price-total">' + v.valor_formatado + '</p>',
                                    '<p class="price-recebido">' + v.total_pago_formatado + '</p>',
                                    '<p class="price-pendente">' + v.total_pendente_formatado + '</p>',
                                    v.data_vencimento +
                                    ' <a data-toggle="modal" ' +
                                    'data-idparcela="' + v.idparcela + '"' +
                                    'data-numero="' + v.numero + '"' +
                                    'data-data_vencimento="' + v.data_vencimento + '"' +
                                    'data-target="#modalAlterarVencimento" class="btn btn-default btn-xs"><i class="fa fa-calendar"></i></a>',
                                    '<a data-toggle="modal" ' +
                                    'data-idparcela="' + v.idparcela + '"' +
                                    'data-numero="' + v.numero + '"' +
                                    'data-valor_formatado="' + v.valor_formatado + '"' +
                                    'data-total_pago_formatado="' + v.total_pago_formatado + '"' +
                                    'data-total_pendente_formatado="' + v.total_pendente_formatado + '"' +
                                    'data-data_vencimento="' + v.data_vencimento + '"' +
                                    'data-target="#modalFormaPgto" class="btn btn-primary btn-xs"><i class="fa fa-money"></i> Receber</a>'

                                ]).draw();
                            });
                        } else {
                            $($table_body).html('<tr ><td colspan="6" class="text-center">Todas as parcelas já foram pagas!</td></tr>');
                        }
                    }
                });

            });
            $($_MODAL_RECEBER_).on('shown.bs.modal', function (event) {
                var $modal = $(this);
                var table = $($modal).find('.modal-body table').DataTable();
                table.responsive.recalc();
            });

            //MODAL DA FORMA DE PAGAMENTO
            $($_MODAL_FORMA_PAGAMENTO_).on('show.bs.modal', function (event) {
                $($_MODAL_RECEBER_).toggle();
                //total, pago, pendente, vencimento
                var $button = $(event.relatedTarget);
                var $modal = $(this);
                var $loading = $($modal).find('div.modal-content div.loading');

                $($loading).show();

                $($modal).find('div.modal-header h4.modal-title b').html($($button).data("numero"));
                var list = ['idparcela', 'valor_formatado', 'total_pago_formatado', 'total_pendente_formatado', 'data_vencimento'];
                $.each(list, function (i, v) {
                    $($modal).find('input#' + v).val($($button).data(v));
                })
                $($modal).find('input#valor').attr('val');

                $($loading).hide();
            });

            $($_MODAL_FORMA_PAGAMENTO_).on('hide.bs.modal', function (event) {
                $($_MODAL_RECEBER_).toggle();
            });


            //MODAL ALTERAR VENCIMENTO
            $($_MODAL_ALTERAR_VENCIMENTO_).on('show.bs.modal', function (event) {
                $($_MODAL_RECEBER_).toggle();
//            //total, pago, pendente, vencimento
                var $button = $(event.relatedTarget);
                var $modal = $(this);
                var $loading = $($modal).find('div.modal-content div.loading');

                $($loading).show();

                $($modal).find('div.modal-header h4.modal-title b').html($($button).data("numero"));
                $($modal).find('input#idparcela').val($($button).data('idparcela'));
                $($modal).find('input#data_vencimento_old').val($($button).data('data_vencimento'));
                $($modal).find('input[name=data_vencimento]').val($($button).data('data_vencimento'));

                $($loading).hide();
            });

            $($_MODAL_ALTERAR_VENCIMENTO_).on('hide.bs.modal', function (event) {
                $($_MODAL_RECEBER_).toggle();
            });

            //MODAL RECEBIMENTOS
            $($_MODAL_RECEBIMENTOS_).on('show.bs.modal', function (event) {
                var $button = $(event.relatedTarget);
                var $modal = $(this);
                var $loading = $($modal).find('div.modal-content div.loading');
                var $table_body = $($modal).find('.modal-body table tbody');
                var table = $($modal).find('.modal-body table').DataTable();
                table
                    .clear()
                    .draw();
                var href = $($button).data('href');
                console.log(href);
                $.ajax({
                    url: href,
                    type: 'GET',
                    beforeSend: function () {
                        $($loading).show();
                    },
                    complete: function () {
                        $($loading).hide();
                    },
                    success: function (json) {
                        console.log(json);
                        if ($(json).length > 0) {
                            $.each(json, function (i, v) {
                                var url_imprimir = _URL_IMPRIMIR_PARCELA_PAGAMENTO_.replace('_IDPARCELA_PAGAMENTO_', v.id);
                                var url_estornar = _URL_ESTORNAR_PARCELA_PAGAMENTO_.replace('_IDPARCELA_PAGAMENTO_', v.id);
                                var link = '';
                                if (v.recibo_em == null) {
                                    link = '<a target="_blank" href="' + url_imprimir + '" class="btn btn-info btn-xs"><i class="fa fa-print"></i> Recibo</a>';
                                } else {
                                    link = '<a target="_blank" href="' + url_imprimir + '" class="btn btn-warning btn-xs"><i class="fa fa-print"></i> Reemitir</a>';
                                }
                                table.row.add([
                                    v.id,
                                    '<p class="price-recebido">' + v.valor_formatado + '</p>',
                                    v.data_pagamento_formatado,
                                    link + ' <a href="' + url_estornar + '" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Estornar</a>'
                                ]).draw();
                            });
                        } else {
                            $($table_body).html('<tr ><td colspan="4" class="text-center">Não há nenhum recebimento!</td></tr>');
                        }
                    }
                });
            });

            $($_MODAL_RECEBIMENTOS_).on('shown.bs.modal', function (event) {
                var $modal = $(this);
                var table = $($modal).find('.modal-body table').DataTable();
                table.responsive.recalc();
            });

            {{--//MODAL RECIBO--}}
            {{--$($_MODAL_RECIBO_).on('show.bs.modal', function (event) {--}}
            {{--$($_MODAL_RECEBER_).toggle();--}}
            {{--var $button = $(event.relatedTarget);--}}
            {{--var $modal = $(this);--}}
            {{--var $loading = $($modal).find('div.modal-content div.loading');--}}
            {{--var $table_body = $($modal).find('.modal-body table tbody');--}}
            {{--$($table_body).empty();--}}
            {{--var URL_imprimir = '{{route('pagamento.imprimir','IDP')}}';--}}
            {{--var parcela_pagamentos = $($button).data('parcela_pagamentos');--}}
            {{--var tabela = ''--}}

            {{--$($loading).show();--}}

            {{--$.each(parcela_pagamentos, function (i, v) {--}}
            {{--url_imprimir = URL_imprimir.replace('IDP', v.id);--}}
            {{--console.log(v);--}}
            {{--tabela += '<tr>' +--}}
            {{--'<td>' + v.data_pagamento + '</td>' +--}}
            {{--'<td>' + v.valor + '</td>' +--}}
            {{--'<td class="td-receber">' +--}}
            {{--'<a target="_blank" href="' + url_imprimir + '" class="btn btn-info btn-xs"><i class="fa fa-print"></i> Recibo</a>' +--}}
            {{--'</td>' +--}}
            {{--'</tr>';--}}
            {{--});--}}
            {{--$($table_body).html(tabela);--}}

            {{--$($loading).hide();--}}

            {{--});--}}

            {{--$($_MODAL_RECIBO_).on('hide.bs.modal', function (event) {--}}
            {{--$($_MODAL_RECEBER_).toggle();--}}
            {{--});--}}
        });
    </script>
    {{--/FINANCEIRO--}}
@endsection


