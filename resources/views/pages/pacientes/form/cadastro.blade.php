<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Nome:</label>
    <div class="col-md-10 col-sm-10 col-xs-12 form-group">
        <input type="text" class="form-control" name="nome" maxlength="100" placeholder="Nome" required="required"
               value="@if(isset($Paciente->nome)){{$Paciente->nome}}@else{{old('nome')}}@endif">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">CPF:</label>
    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
        <input type="text" class="form-control show-cpf" name="cpf" maxlength="14" placeholder="CPF"
               value="@if(isset($Paciente->cpf)){{$Paciente->cpf}}@else{{old('cpf')}}@endif">
    </div>
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">RG:</label>
    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
        <input type="text" class="form-control" name="rg" maxlength="12" placeholder="RG"
               value="@if(isset($Paciente->rg)){{$Paciente->rg}}@else{{old('rg')}}@endif">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="data_nascimento">Nascimento:</label>
    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
        <input type="text" class="form-control show-data" name="data_nascimento" placeholder="Data de Nascimento"
               value="@if(isset($Paciente->data_nascimento)){{$Paciente->data_nascimento}}@else{{old('data_nascimento')}}@endif">
    </div>
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Email:</label>
    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
        <input type="email" class="form-control" name="email" maxlength="50" placeholder="E-mail"
               value="@if(isset($Paciente->contato->email)){{$Paciente->contato->email}}@else{{old('email')}}@endif">
    </div>
</div>


<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Telefone:</label>
    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
        <input type="text" class="form-control show-telefone" name="telefone" placeholder="Telefone"
               value="@if(isset($Paciente->contato->telefone)){{$Paciente->contato->telefone}}@else{{old('telefone')}}@endif">
    </div>
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Celular:</label>
    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
        <input type="text" class="form-control show-celular" name="celular" placeholder="Celular"
               value="@if(isset($Paciente->contato->celular)){{$Paciente->contato->celular}}@else{{old('celular')}}@endif">
    </div>
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Comercial:</label>
    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
        <input type="text" class="form-control show-telefone" name="comercial" placeholder="Comercial"
               value="@if(isset($Paciente->contato->comercial)){{$Paciente->contato->comercial}}@else{{old('comercial')}}@endif">
    </div>
</div>
<div class="ln_solid"></div>
<section id="endereco">
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">CEP:</label>
        <div class="col-md-4 col-sm-4 col-xs-12 form-group">
            <input type="text" class="form-control show-cep" id="cep" name="cep" placeholder="CEP"
                   value="@if(isset($Paciente->contato->cep)){{$Paciente->contato->cep}}@else{{old('cep')}}@endif">
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Estado:</label>
        <div class="col-md-4 col-sm-4 col-xs-12 form-group">
            <select class="select2_group form-control input-estado" name="estado">
                <option value="">Estado</option>
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espírito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="AL">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Cidade:</label>
        <div class="col-md-4 col-sm-4 col-xs-12 form-group input-cidade">
            <input type="text" class="form-control input-cidade" name="cidade" maxlength="60" id="inputSuccess2"
                   placeholder="Cidade"
                   value="@if(isset($Paciente->contato->cidade)){{$Paciente->contato->cidade}}@else{{old('cidade')}}@endif">
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Bairro:</label>
        <div class="col-md-4 col-sm-4 col-xs-12 form-group">
            <input type="text" class="form-control input-bairro" name="bairro" maxlength="125" placeholder="Bairro"
                   value="@if(isset($Paciente->contato->bairro)){{$Paciente->contato->bairro}}@else{{old('bairro')}}@endif">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Endereço:</label>
        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
            <input type="text" class="form-control input-logradouro" name="logradouro" maxlength="100"
                   placeholder="Endereço"
                   value="@if(isset($Paciente->contato->logradouro)){{$Paciente->contato->logradouro}}@else{{old('logradouro')}}@endif">
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 form-group">
            <input type="text" class="form-control" name="complemento" maxlength="50" placeholder="Complemento"
                   value="@if(isset($Paciente->contato->complemento)){{$Paciente->contato->complemento}}@else{{old('complemento')}}@endif">
        </div>
    </div>
</section>
<div class="ln_solid"></div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Plano:</label>
    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
        <select class="form-control" name="idplano">
            @foreach($Planos as $plano)
                <option value="{{$plano->idplano}}"
                        @if(isset($Paciente) && ($Paciente->idplano) == ($plano->idplano)) selected @endif>
                    {{$plano->nome}}
                </option>
            @endforeach
        </select>
    </div>

    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Cirurgião:</label>
    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
        <select class="form-control" name="idprofissional">
            @foreach($Profissionais as $profissional)
                <option value="{{$profissional->idprofissional}}"
                        @if(isset($Paciente) && ($Paciente->idprofissional) == ($profissional->idprofissional)) selected @endif>
                    {{$profissional->nome}}
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="foto">Foto: </label>
    <div class="col-md-10 col-sm-10 col-xs-12 form-group">
        <input name="foto" type="file" class="form-control" rows="9" cols="25">
    </div>
</div>
<div class="ln_solid"></div>