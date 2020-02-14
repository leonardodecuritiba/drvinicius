<div id="modalFormaPgto" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="modalShow" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="loading"></div>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Receber parcela (#<b></b>)</h4>
            </div>
            <div class="modal-body">

                {!! Form::open(['route' => 'parcelas.receber', 'method' => 'POST',
                        'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
                <input type="hidden" name="idparcela" id="idparcela">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Total:</label>
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                        <input type="text" class="form-control show-valor" id="valor_formatado" disabled>
                    </div>
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Pago:</label>
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                        <input type="text" class="form-control show-valor" id="total_pago_formatado" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Pendente:</label>
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                        <input type="text" class="form-control show-valor" id="total_pendente_formatado" disabled>
                    </div>
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Vencimento:</label>
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                        <input type="text" class="form-control show-valor" id="data_vencimento" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Forma:</label>
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                        <select class="form-control" tabindex="-1" style="width: 100%;" name="idtipo_pagamento"
                                required>
                            @foreach($TipoPagamentos as $tipo)
                                <option value="{{$tipo->idtipo_pagamento}}">{{$tipo->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Data:</label>
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                        <input type="text" class="form-control show-data" name="data_pagamento"
                               placeholder="Data de Pagamento"
                               value="{{\Carbon\Carbon::now()->format('d/m/Y')}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Valor:</label>
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                        <input type="text" class="form-control show-valor" id="valor" name="valor" required>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                        <button class="btn btn-primary btn-block"><i class="fa fa-money"></i> Receber</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>