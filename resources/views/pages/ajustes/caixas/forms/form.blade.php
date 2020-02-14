<div class="form-group">
    <label class="control-label col-md-1 col-sm-1 col-xs-12">Nome:</label>
    <div class="col-md-11 col-sm-11 col-xs-12">
        <input type="text" class="form-control" name="nome"
               value="@if(isset($Intervencao->idintervencao)){{$Intervencao->nome}}@else{{old('nome')}}@endif">
        <span class="fa fa-info-circle form-control-feedback right" aria-hidden="true"></span>
    </div>
</div>
