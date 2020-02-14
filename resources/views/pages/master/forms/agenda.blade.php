<div class="form-group">
    <label class="col-sm-3 control-label">Profissional</label>
    <div class="col-sm-9">
        <select class="form-control" name="idprofissional">
            @foreach($Page->Profissionais as $profissional)
                <option value="{{$profissional->idprofissional}}">{{$profissional->nome}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Observação</label>
    <div class="col-sm-9">
        <textarea class="form-control" style="height:55px;" maxlength="1000" name="observacao"></textarea>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Tipo:</label>
    <div class="col-sm-9">
        <select class="form-control" name="tipo_consulta">
            @foreach($Page->TipoConsultas as $tipo_consulta)
                <option value="{{$tipo_consulta}}">{{$tipo_consulta}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Data:</label>
    <div class="col-sm-9">
        <input type="text" class="form-control data-every" name="data_consulta">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3 control-label">Dia inteiro?</label>
    <div class="col-sm-9">
        <select class="form-control" id="dia-inteiro" name="dia_inteiro">
            <option value="0">Não</option>
            <option value="1">Sim</option>
        </select>
    </div>
</div>
<div id="opcao-hora">
    <div class="form-group">
        <label class="col-sm-3 control-label">Início:</label>
        <div class="col-sm-9">
            <input type="text" maxlength="5" class="form-control show-time" name="hora_inicio" value="00:00">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Término:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control show-time" maxlength="5" name="hora_termino" value="23:59">
        </div>
    </div>
</div>