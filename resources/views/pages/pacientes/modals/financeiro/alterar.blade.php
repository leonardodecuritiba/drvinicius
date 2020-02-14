<div id="modalAlterarVencimento" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalAlterarVencimento"
     aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="loading"></div>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alterar Vencimento</h4>
            </div>
            {!! Form::open(['route' => 'parcelas.alterar_vencimento', 'method' => 'POST',
                    'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
            <input type="hidden" name="idparcela" id="idparcela">
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vencimento:</label>
                    <div class="col-md-9 col-sm-9 col-xs-12 form-group">
                        <input type="text" class="form-control show-data" id="data_vencimento_old" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Novo Vencimento:</label>
                    <div class="col-md-9 col-sm-9 col-xs-12 form-group">
                        <input type="text" class="form-control show-data" name="data_vencimento">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button class="btn btn-success"><i class="fa fa-check"></i> Alterar</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>