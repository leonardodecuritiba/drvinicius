@extends('layouts.template')

@section('style_content')
    {!! Html::style('css/calendar/fullcalendar.css') !!}
    {!! Html::style('css/calendar/fullcalendar.print.css', array('media'=>'print')) !!}

@endsection
@section('page_content')

    <!-- Start Calender modal -->
    @include('pages.master.forms.calender_new')
    <!-- Start Edit Calender modal -->
    @include('pages.master.forms.calender_edit')
    <!-- End Calender modal -->

    <!-- page content -->
    <div class="page-title">
        <div class="title_left">
            <h3>Agenda</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Clique na data desejada para adicionar, editar uma consulta ou no botão ao lado</h2>
                    <div class="title_right">
                        <div class="pull-right">
                            <button class="btn btn-primary nova-consulta" data-toggle="modal"
                                    data-target="#CalenderModalNew"><i class="fa fa-plus"></i> Nova Consulta
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

@endsection

@section('scripts_content')
    {!! Html::script('js/moment.min.js') !!}
    {!! Html::script('js/calendar/fullcalendar.min.js') !!}
    {!! Html::script('js/calendar/lang/pt-br.js') !!}

    <script>
        var formattedEventData = [];
        @foreach($Page->Consultas as $consulta)
        formattedEventData.push({
            title: "CONSULTA: {{$consulta->title}}",
            start: new Date("{{$consulta->start}}"),
            end: new Date("{{$consulta->end}}"),
            allDay: {{$consulta->allDay}},
            data: JSON.parse('<?php echo( $consulta->data );?>')
        });
        @endforeach
        @foreach($Page->Retornos as $retorno)
        formattedEventData.push({
            title: "RETORNO: {{$retorno->title}}",
            color: 'yellow',
            textColor: 'black', // an option!
            start: new Date("{{$retorno->start}}"),
            data: JSON.parse('<?php echo( $retorno->data );?>')
        });
        @endforeach

        console.log(formattedEventData);

        $(document).ready(function () {
            $('input[name="anonimo"]').change(function () {
                $parent = $(this).parents('div#testmodal');
                if ($(this).is(':checked')) {
                    $($parent).find('div.anonimo').show();
                    $($parent).find('div.cadastrado').hide();
                    //tirar require do select
                    $($parent).find('div.anonimo').find('input').attr('required', true);
                    $($parent).find('div.cadastrado').find('select').attr('required', false);
                } else {
                    $($parent).find('div.anonimo').hide();
                    $($parent).find('div.cadastrado').show();
                    $($parent).find('div.anonimo').find('input').attr('required', false);
                    $($parent).find('div.cadastrado').find('select').attr('required', true);
                    //tirar require do input
                }
            });
        });

        $(document).ready(function () {
            $('select[name="dia_inteiro"]').change(function () {
                if ($(this).val() == 1) {
                    $(this).parents('form#antoform').find('div#opcao-hora').addClass('hide');
                } else {
                    $(this).parents('form#antoform').find('div#opcao-hora').removeClass('hide');
                }
            });
        });

        function setCalendarDate(data_, revertFunc) {
            $.ajax({
                url: "{{url('updateDateTime')}}",
                type: 'GET',
                data: data_,
                dataType: "json",
                error: function (xhr, textStatus) {
                    console.log('xhr-error: ' + xhr.responseText);
                    console.log('textStatus-error: ' + textStatus);
                },
                success: function (json) {
                    console.log(json);
                    if (json.status == "0") {
                        revertFunc();
                        alert(json.response);
                    }
                }
            });
        }

        $(window).load(function () {

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var started;
            var categoryClass;

            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {
                    $('#fc_create').click();

                    started = start;
                    ended = end;

                    $parent = $('div#CalenderModalNew');
                    var dia = started._d.getDate() + 1;
                    dia = dia < 10 ? '0' + dia : dia;
                    var mes = started._d.getMonth() + 1;
                    mes = mes < 10 ? '0' + mes : mes;
                    var $data_consulta = dia + '/' + mes + '/' + started._d.getFullYear();

                    $parent.find('input.data-every').val($data_consulta);
                    $parent.find('input[name="data_consulta"]').data('daterangepicker').setStartDate($data_consulta);
                    $parent.find('input[name="data_consulta"]').data('daterangepicker').setEndDate($data_consulta);

                },
                eventClick: function (calEvent, jsEvent, view) {
//                    alert(calEvent.data, jsEvent, view);
                    $dados = calEvent.data;
                    $('#fc_edit').click();

                    $parent = $('div#CalenderModalEdit');
                    var href_destroy = ("{{route('consultas._remove', '__0__')}}").replace('__0__', $dados.idconsulta);
                    $parent.find('div.modal-footer a.btn-remove').attr('href', href_destroy);

                    console.log(href_destroy);

                    $parent.find('.modal-title').html('Editar consulta de <i>' + calEvent.title + '</i>');
                    $parent.find('input[name="idconsulta"]').val($dados.idconsulta);
                    $parent.find('input[name="idpaciente"]').val($dados.idpaciente);
                    $parent.find('select[name="idprofissional"]').val($dados.idprofissional);
                    $parent.find('textarea[name="observacao"]').val($dados.observacao);

                    $parent.find('input[name="hora_inicio"]').val(calEvent.start.format('HH:mm'));
                    $op = $parent.find('select[name="dia_inteiro"]');
                    dia_inteiro = calEvent.allDay;
                    if (dia_inteiro == 1) {
                        $($op).val(1);
                        $($op).parents('form#antoform').find('div#opcao-hora').addClass('hide');
                        $parent.find('input[name="hora_inicio"]').val('00:00');
                        $parent.find('input[name="hora_termino"]').val('23:59');
                    } else {
                        $($op).val(0);
                        $($op).parents('form#antoform').find('div#opcao-hora').removeClass('hide');
                        $parent.find('input[name="hora_termino"]').val(calEvent.end.format('HH:mm'));
                    }

                    $data_consulta = calEvent.start.format('DD/MM/YYYY');
                    $parent.find('input.data-every').val($data_consulta);
                    $parent.find('input[name="data_consulta"]').data('daterangepicker').setStartDate($data_consulta);
                    $parent.find('input[name="data_consulta"]').data('daterangepicker').setEndDate($data_consulta);

                    $parent.find('select[name="tipo_consulta"]').val($dados.tipo_consulta);


                    categoryClass = $("#event_type").val();

                    $(".antosubmit2").on("click", function () {
                        calEvent.title = $("#title2").val();

                        calendar.fullCalendar('updateEvent', calEvent);
                        $('.antoclose2').click();
                    });
                    calendar.fullCalendar('unselect');
                },
                eventDrop: function (event, delta, revertFunc, view) {
                    //mudar data e hora de inicio, criar funcao que receba via ajax
//                    console.log(event.title + " was dropped on " + event.start.format('DD/MM/YYYY HH:mm'));
                    if (!event.allDay) {
                        dia_inteiro_ = 0;
                        if ((typeof event.end) == 'undefined' || (event.end == null)) {
                            hora_termino_ = event.start;
                            hora_inicio_ = event.start.format('HH:mm');
                            hora_termino_ = moment(event.start).add(2, 'hours');
                            hora_termino_ = hora_termino_.format('HH:mm');
                        } else {
                            hora_inicio_ = event.start.format('HH:mm');
                            hora_termino_ = event.end.format('HH:mm');
                        }
                    } else {
                        dia_inteiro_ = 1;
                        hora_inicio_ = '00:00';
                        hora_termino_ = '23:59';
                    }
                    data_ = {
                        idconsulta: event.data.idconsulta,
                        data_consulta: event.start.format('DD/MM/YYYY'),
                        dia_inteiro: dia_inteiro_,
                        hora_inicio: hora_inicio_,
                        hora_termino: hora_termino_
                    };
                    console.log(data_);
                    setCalendarDate(data_, revertFunc);
                },
                eventResize: function (event, delta, revertFunc) {
                    //mudar hora do final, criar funcao que receba via ajax
//                    console.log(event.title + " was dropped on " + event.end.format('HH:mm'));
                    data_ = {
                        idconsulta: event.data.idconsulta,
                        hora_termino: event.end.format('HH:mm')
                    };
                    setCalendarDate(data_, revertFunc);
                },
                /**/
                editable: true,
                events: formattedEventData
            });
        });
    </script>
@endsection
