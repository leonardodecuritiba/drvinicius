<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Plano:</label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="text" class="form-control" name="nome"
               value="@if(isset($Plano->idplano)){{$Plano->nome}}@else{{old('nome')}}@endif">
        <span class="fa fa-user-md form-control-feedback right" aria-hidden="true"></span>
    </div>
</div>
