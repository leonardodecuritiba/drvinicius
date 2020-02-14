<input type="hidden" name="tipo"
       value="@if(isset($Data->id)){{$Data->getTipoName()}}@else{{$Page->extras['tipo']}}@endif">
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Fonte:</label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="text" class="form-control" name="fonte" maxlength="100"
               placeholder="Fonte"
               value="@if(isset($Data->id)){{$Data->fonte}}@else{{old('fonte')}}@endif" required>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Data:</label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="text" class="form-control show-data" name="data"
               placeholder="Data"
               value="@if(isset($Data->id)){{$Data->fonte}}@else{{\Carbon\Carbon::now()->format('d/m/Y')}}@endif"
               required>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Valor:</label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="text" class="form-control show-valor" name="valor"
               placeholder="Valor"
               value="@if(isset($Data->id)){{$Data->getValor()}}@else{{old('valor')}}@endif" required>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">CNPJ/CPF:</label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="text" class="form-control" name="documento" maxlength="30"
               placeholder="CNPJ/CPF"
               value="@if(isset($Data->documento)){{$Data->documento}}@else{{old('documento')}}@endif" required>
    </div>
</div>