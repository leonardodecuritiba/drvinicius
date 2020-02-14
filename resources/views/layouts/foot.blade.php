{!! Html::script('js/bootstrap.min.js') !!}
{!! Html::script('js/chartjs/chart.min.js') !!}
{!! Html::script('js/nicescroll/jquery.nicescroll.min.js') !!}
{!! Html::script('js/progressbar/bootstrap-progressbar.min.js') !!}
{!! Html::script('js/icheck/icheck.min.js') !!}
{!! Html::script('build/js/custom.min.js') !!}

<!-- script remoção -->
<script>
    $(document).ready(function () {
        $('#buscar').keypress(function (e) {
            if (e.which == 13) {
                $('form#search').submit();
                return false;    //<---- Add this line
            }
        });

        //exclusão tem redirect
        $('div#modalExclusao').on('show.bs.modal', function (e) {
            $origem = $(e.relatedTarget);
            nome_ = $($origem).data('nome');
            href_ = $($origem).data('href');
            $(this).find('.modal-content form').attr('action', href_);
            $(this).find('.modal-body').html('Você realmente deseja excluir <strong>' + nome_ + '</strong> e suas relações? Esta ação é irreversível!');
        });

        //remoção é com ajax
        $('div#modalRemocao').on('show.bs.modal', function (e) {
            $origem = $(e.relatedTarget);
            nome_ = $($origem).data('nome');
            href_ = $($origem).data('href');
            $(this).find('.modal-body').html('Você realmente deseja remover <strong>' + nome_ + '</strong> e suas relações? Esta ação é irreversível!');
            $(this).find('.btn-ok').click(function () {
                $('div#modalRemocao').modal('hide');
                $.ajax({
                    url: href_,
                    type: 'post',
                    data: {"_method": 'delete', "_token": "{{ csrf_token() }}"},
                    beforeSend: function () {
                        $(".loading").show();
                    },
                    complete: function (xhr, textStatus) {
                        $(".loading").hide();
                    },
                    success: function (json) {
                        if (json.status) {
                            console.log(json.response);
                            $el = $($origem).closest('tr');
                            if ($el.length == 0) {
                                $el = $($origem).closest('.tr');
                            }
                            $($el).toggle('fast');
                        } else {
                            alert(json.response);
                        }
                    }
                });

            });
        });
    });
</script>

<!-- script ativar/desativar -->
<script>
    function ajaxActive($target_, action_) {
        var href_ = '{{url('ajax')}}';
        if (typeof $($target_).data('href') != 'undefined') {
            href_ = $($target_).data('href');
        }
        $.ajax({
            url: href_,
            type: 'GET',
            data: {
                id: $($target_).data('id'),
                table: $($target_).data('table'),
                pk: $($target_).data('pk'),
                sk: $($target_).data('sk'),
                action: action_
            },
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
                    if (json.valor == 1) {
                        $($target_).data('value', 1);
                        $($target_).html('<i class="fa fa-eye-slash"></i>Desativar');
                        $($target_).closest('tr').find('td.td-active:first').html('<span class="btn btn-success btn-xs">Ativo</span>');
                    } else {
                        $($target_).data('value', 0);
                        $($target_).html('<i class="fa fa-eye"></i>Ativar');
                        $($target_).closest('tr').find('td.td-active:first').html('<span class="btn btn-danger btn-xs">Inativo</span>');
                    }
                }
            }
        });
    }

    $(document).ready(function () {
        $('a.btn-active').click(function () {
            if ($(this).data('value')) {
                ajaxActive($(this), 'desativar');
            } else {
                ajaxActive($(this), 'ativar');
            }
        });
    });
</script>
<!-- /script ativar/desativar -->

<!-- script aprovar/Não Aprovar -->
<script>
    /*
    function ajaxAprovar($target_,action_){
        var href_ = '{{url('ajax')}}';
        if(typeof $($target_).data('href') != 'undefined'){
            href_ = $($target_).data('href');
        }
        $.ajax({
            url: href_,
            type: 'GET',
            data: {id: $($target_).data('id'),
                table: $($target_).data('table'),
                pk: $($target_).data('pk'),
                sk: $($target_).data('sk'),
                action: action_},
            dataType: "json",
            error: function (xhr, textStatus) {
                console.log('xhr-error: ' + xhr.responseText);
                console.log('textStatus-error: ' + textStatus);
            },
            success: function (json) {
                console.log(json);
                if(json.status==1) {
                    if (json.valor == 1) {
//                        $($target_).data('value', 1);
//                        $($target_).html('<i class="fa fa-thumbs-o-down"></i> Não Aprovar');
                        $($target_).closest('tr').find('td.td-aprovar:first').html('<span class="btn btn-success btn-xs">Aprovado</span>');
                        $($target_).remove();
                    }
                    else {
                        $($target_).data('value', 0);
                        $($target_).html('<i class="fa fa-thumbs-o-up"></i> Aprovar');
                        $($target_).closest('tr').find('td.td-aprovar:first').html('<span class="btn btn-danger btn-xs">Não Aprovado</span>');
                    }

                }
            }
        });
    }
    $(document).ready(function () {
        $('a.btn-aprovar').click(function(){
            if($(this).data('value')){
                ajaxAprovar($(this), 'desativar');
            } else {
                ajaxAprovar($(this), 'ativar');
            }
        });
    });
                     */
</script>
<!-- /script aprovar/Não Aprovar -->

{!! Html::script('js/inputmask/inputmask.min.js') !!}
{!! Html::script('js/inputmask/jquery.inputmask.min.js') !!}
{!! Html::script('js/inputmask/inputmask.date.extensions.js') !!}

{{--PACIENTES--}}
<script type="text/javascript">
    $(document).ready(function () {
        $('.show-cep').inputmask({'mask': '99999-999', 'removeMaskOnSubmit': true});
        $('.show-cpf').inputmask({'mask': '999.999.999-99', 'removeMaskOnSubmit': true});
        $('.show-cnpj').inputmask({'mask': '99.999.999/9999-99', 'removeMaskOnSubmit': true});
        $('.show-rg').inputmask({'mask': '99.999.999-9', 'removeMaskOnSubmit': true});
        $('.show-celular').inputmask({'mask': '(99) 99999-9999', 'removeMaskOnSubmit': true});
        $('.show-telefone').inputmask({'mask': '(99) 9999-9999', 'removeMaskOnSubmit': true});
        $('.show-data').inputmask({'alias': "date", "placeholder": "dd/mm/aaaa", 'removeMaskOnSubmit': false});
        $('.show-time').inputmask({
            'alias': "datetime",
            'mask': "h:s",
            'placeholder': "hh:mm",
            hourFormat: "24",
            'removeMaskOnSubmit': false
        });
    });

</script>

{!! Html::script('js/maskmoney/jquery.maskMoney.min.js') !!}
<script type="text/javascript">
    function initMaskMoney(selector) {
        $(selector).maskMoney({prefix: 'R$ ', allowNegative: false, thousands: '.', decimal: ',', affixesStay: false});
    }

    function initMaskPercent(selector) {
        $(selector).maskMoney({suffix: '%', thousands: '', precision: 0, affixesStay: true});
    }

    $(document).ready(function () {
        initMaskMoney($(".show-valor"));
    });
</script>


<!-- daterangepicker -->
{!! Html::script('js/datepicker/moment.min.js') !!}
{!! Html::script('js/datepicker/daterangepicker.js') !!}
<script type="text/javascript">
    //    calender_style: "picker_4"
    var locale = {
        format: "DD/MM/YYYY",
        separator: " - ",
        applyLabel: "Aplicar",
        cancelLabel: "Cancelar",
        fromLabel: "De",
        toLabel: "A",
        customRangeLabel: "Customizado",
        daysOfWeek: [
            "Dom",
            "Seg",
            "Ter",
            "Qua",
            "Qui",
            "Sex",
            "Sáb"
        ],
        monthNames: [
            "Janeiro",
            "Fevereiro",
            "Março",
            "Abril",
            "Maio",
            "Junho",
            "Julho",
            "Agosto",
            "Setembro",
            "Outubro",
            "Novembro",
            "Dezembro"
        ],
        "firstDay": 1
    };
    var dateOptionsToNow = {
        locale: locale,
        maxDate: new Date(),
        singleDatePicker: true,
        autoUpdateInput: false
    };
    var dateOptionsFromNow = {
        locale: locale,
        minDate: new Date(),
        singleDatePicker: true,
        autoUpdateInput: false
    };
    var dateOptionsEvery = {
        locale: locale,
        singleDatePicker: true,
        autoUpdateInput: false
    };
    $(document).ready(function () {

        $('.data-every').daterangepicker(dateOptionsEvery);
        $('.data-to-now').daterangepicker(dateOptionsToNow);
        $('.data-from-now').daterangepicker(dateOptionsFromNow);
        $('.data-every, .data-to-now, .data-from-now').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format(locale.format));
        });
    });
</script>

<!-- PNotify -->
{!! Html::script('vendors/pnotify/dist/pnotify.js') !!}

<!-- bootstrap progress js -->
<script>
    NProgress.done();
</script>