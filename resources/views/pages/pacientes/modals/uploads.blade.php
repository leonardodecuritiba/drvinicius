<div class="modal fade" id="modalUploads" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"></h4>
            </div>

            {!! Form::open(['route' => 'documentos.pacientes.store',
            'files' => true,
            'method' => 'POST',
            'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
            <input name="type" type="hidden">
            <input name="idpaciente" type="hidden">
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Título:</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="text" maxlength="50" class="form-control" name="titulo" placeholder="Título"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Descrição:</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="text" maxlength="100" class="form-control" name="descricao" placeholder="Descrição"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Arquivo:</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="file" class="form-control" name="upload" placeholder="Arquivo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        Cancelar
                    </button>
                </div>
                <div class="pull-right">
                    <button class="btn btn-success"><i class="fa fa-check"></i> Adicionar</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>