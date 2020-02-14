<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Nome:</label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="text" class="form-control" name="nome" required="required"
               value="@if(isset($Upload->id)){{$Upload->nome}}@else{{old('nome')}}@endif">
        <span class="fa fa-info-circle form-control-feedback right" aria-hidden="true"></span>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Descrição:</label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="text" class="form-control" name="descricao"
               value="@if(isset($Upload->id)){{$Upload->descricao}}@else{{old('descricao')}}@endif">
        <span class="fa fa-info-circle form-control-feedback right" aria-hidden="true"></span>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12">Arquivo:</label>
    <div class="col-md-10 col-sm-10 col-xs-12">
        <input type="file" class="form-control" name="link"
               @if(!isset($Upload->id)) required @endif>
        <span class="fa fa-info form-control-feedback right" aria-hidden="true"></span>
    </div>
</div>
@if(isset($Upload->id))
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Link:</label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <a class="btn btn-default btn-xs" target="_blank" href="{{$Upload->getLink()}}"><i class="fa fa-eye"></i>
                Abrir</a>
        </div>
    </div>
@endif
