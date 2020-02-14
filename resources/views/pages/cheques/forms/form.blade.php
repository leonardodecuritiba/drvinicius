<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Nome:</label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="text" class="form-control" name="nome" maxlength="100"
               placeholder="Nome"
               value="@if(isset($Cheque->id)){{$Cheque->nome}}@else{{old('nome')}}@endif" required>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Plano</label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <select class="form-control select2" name="idplano" required>
            @foreach($Page->extras['Planos'] as $selecao)
                <option value="{{$selecao->idplano}}"
                        @if(isset($Cheque->id) && ($selecao->idplano == $Cheque->idplano)) selected @endif
                >{{$selecao->nome}}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Data:</label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="text" class="form-control show-data" name="data"
               placeholder="Data"
               value="{{\Carbon\Carbon::now()->format('d/m/Y')}}" required>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Valor:</label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="text" class="form-control show-valor" name="valor"
               placeholder="Valor"
               value="@if(isset($Cheque->id)){{$Cheque->getValor()}}@else{{old('valor')}}@endif" required>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Banco:</label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="text" class="form-control" name="banco" maxlength="50"
               placeholder="Banco"
               value="@if(isset($Cheque->id)){{$Cheque->banco}}@else{{old('banco')}}@endif" required>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Numeração:</label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="text" class="form-control" name="numeracao" maxlength="100"
               placeholder="Numeração"
               value="@if(isset($Cheque->id)){{$Cheque->numeracao}}@else{{old('numeracao')}}@endif" required>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Destino:</label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="text" class="form-control" name="destino" maxlength="100"
               placeholder="Destino"
               value="@if(isset($Cheque->id)){{$Cheque->destino}}@else{{old('destino')}}@endif" required>
    </div>
</div>