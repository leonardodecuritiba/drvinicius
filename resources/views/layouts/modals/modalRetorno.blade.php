<!-- Modal agendar -->
<div class="modal fade" id="modalRetorno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Agendar retorno</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'retornos.store', 'method' => 'POST',
                            'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
                <input value="" type="hidden" id="idpaciente" name="idpaciente">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Cirurgião:</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <select class="form-control" name="idprofissional">
                            @foreach($Page->Profissionais as $profissional)
                                <option value="{{$profissional->idprofissional}}">{{$profissional->nome}}</option>
                            @endforeach
                        </select>
                        <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Data retorno:</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <input class="form-control col-md-7 col-xs-12 data-from-now" required="required" type="text"
                               name="data_retorno">
                        <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Motivo Retorno:</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <textarea type="text" class="form-control" maxlength="1000" name="motivo_retorno"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3">Observações:</label>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <textarea type="text" class="form-control" name="observacao" maxlength="500"></textarea>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar
                        </button>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
