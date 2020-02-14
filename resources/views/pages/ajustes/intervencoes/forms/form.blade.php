<div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-12">Nome:</label>
    <div class="col-md-5 col-sm-5 col-xs-12">
        <input type="text" class="form-control" name="nome" required="required"
               value="@if(isset($Intervencao->idintervencao)){{$Intervencao->nome}}@else{{old('nome')}}@endif">
        <span class="fa fa-info-circle form-control-feedback right" aria-hidden="true"></span>
    </div>
    <label class="control-label col-md-1 col-sm-1 col-xs-12">Código:</label>
    <div class="col-md-5 col-sm-5 col-xs-12">
        <input type="text" class="form-control" name="codigo"
               value="@if(isset($Intervencao->idintervencao)){{$Intervencao->codigo}}@else{{old('codigo')}}@endif">
        <span class="fa fa-info-circle form-control-feedback right" aria-hidden="true"></span>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-12">Região:</label>
    <div class="col-md-5 col-sm-5 col-xs-12">
        <input type="text" class="form-control" name="regiao"
               value="@if(isset($Intervencao->idintervencao)){{$Intervencao->regiao}}@else{{old('regiao')}}@endif">
        <span class="fa fa-info form-control-feedback right" aria-hidden="true"></span>
    </div>
    <label class="control-label col-md-1 col-sm-1 col-xs-12">Valor:</label>
    <div class="col-md-5 col-sm-5 col-xs-12">
        <input type="text" class="form-control show-valor" name="valor"
               value="@if(isset($Intervencao->idintervencao)){{$Intervencao->valor}}@else{{old('valor')}}@endif">
        <span class="fa fa-money form-control-feedback right" aria-hidden="true"></span>
    </div>
</div>
