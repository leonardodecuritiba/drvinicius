<div class="modal fade" id="modalEvolucao" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Evolução do paciente</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'evolucoes.store', 'method' => 'POST',
                            'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
                <input value="{{$Paciente->idpaciente}}" type="hidden" name="idpaciente">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Data:</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <input name="data_evolucao" class="form-control col-md-7 col-xs-12 data-to-now"
                               required="required" type="text">
                        <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Evolução:</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                            <textarea name="texto" type="text" class="form-control" maxlength="1000"
                                      required="required"></textarea>
                        <span class="fa fa-bullhorn form-control-feedback right" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>