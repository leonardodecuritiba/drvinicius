<div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"></h4>
            </div>
            {!! Form::open(['route' => 'consultas._update',
                'method' => 'POST',
                'id' => 'antoform',
                'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
            <input type="hidden" name="idconsulta">
            <input type="hidden" name="idpaciente">
            <div class="modal-body">
                <div id="testmodal" style="padding: 5px 20px;">
                    @include('pages.master.forms.agenda')
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger btn-remove">Remover</a>
                <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary antosubmit">Salvar</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>