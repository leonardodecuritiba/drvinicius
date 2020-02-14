{{--$Page->Estados--}}
@if(!isset($User))
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tipo:</label>
        <div class="col-md-4 col-sm-4 col-xs-12 form-group">
            <select class="select2_group form-control" name="tipo">
                @foreach($Page->extras['Role'] as $role)
                    <option value="{{$role->id}}">{{$role->display_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
@endif
<script>
    $(document).ready(function () {
        $('select[name=tipo]').change(function () {
            $(this).parents('div.x_content').find('div.cro').toggle();
        });
    })
</script>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Nome:</label>
    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
        <input type="text" class="form-control" name="nome" maxlength="100" placeholder="Nome" required="required"
               value="@if(isset($User->profissional->nome)){{$User->profissional->nome}}@else{{old('nome')}}@endif">
    </div>
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="data_nascimento">Email:</label>
    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
        <input type="email" class="form-control" name="email" maxlength="50" placeholder="E-mail"
               value="@if(isset($User->email)){{$User->email}}@else{{old('email')}}@endif">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">CPF:</label>
    <div class="col-md-4 col-sm-4 col-xs-6 form-group has-feedback">
        <input type="text" class="form-control show-cpf" name="cpf"
               value="@if(isset($User->profissional->cpf)){{$User->profissional->cpf}}@else{{old('cpf')}}@endif">
    </div>
    @if(!isset($User) || $User->hasRole('profissional'))
        <div class="cro">
            <label class="control-label col-md-2 col-sm-2 col-xs-12 cro" for="cro">CRO:</label>
            <div class="col-md-4 col-sm-4 col-xs-6 form-group has-feedback">
                <input type="text" class="form-control show-cro" name="cro"
                       value="@if(isset($User->profissional->cro)){{$User->profissional->cro}}@else{{old('cro')}}@endif">
            </div>
        </div>
    @endif
</div>
<div class="ln_solid"></div>
<div class="form-group">
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Telefone:</label>
    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
        <input type="text" class="form-control show-telefone" name="telefone" placeholder="Telefone"
               value="@if(isset($User->profissional->contato->telefone)){{$User->profissional->contato->telefone}}@else{{old('telefone')}}@endif">
    </div>
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Celular:</label>
    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
        <input type="text" class="form-control show-celular" name="celular" placeholder="Celular"
               value="@if(isset($User->profissional->contato->celular)){{$User->profissional->contato->celular}}@else{{old('celular')}}@endif">
    </div>
    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Comercial:</label>
    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
        <input type="text" class="form-control show-telefone" name="comercial" placeholder="Comercial"
               value="@if(isset($User->profissional->contato->comercial)){{$User->profissional->contato->comercial}}@else{{old('comercial')}}@endif">
    </div>
</div>
<div class="ln_solid"></div>
<section id="endereco">
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">CEP:</label>
        <div class="col-md-4 col-sm-4 col-xs-12 form-group">
            <input type="text" class="form-control show-cep" id="cep" name="cep" placeholder="CEP"
                   value="@if(isset($User->profissional->contato->cep)){{$User->profissional->contato->cep}}@else{{old('cep')}}@endif">
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Estado:</label>
        <div class="col-md-4 col-sm-4 col-xs-12 form-group">
            <select class="select2_group form-control input-estado" name="estado">
                @foreach($Page->Estados as $key => $value)
                    <option value="{{$key}}"
                            @if(isset($User->profissional->contato->estado) && ($User->profissional->contato->estado == $key))
                            selected
                            @endif
                    >{{$value}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Cidade:</label>
        <div class="col-md-4 col-sm-4 col-xs-12 form-group input-cidade">
            <input type="text" class="form-control input-cidade" name="cidade" maxlength="60" id="inputSuccess2"
                   placeholder="Cidade"
                   value="@if(isset($User->profissional->contato->cidade)){{$User->profissional->contato->cidade}}@else{{old('cidade')}}@endif">
        </div>
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Bairro:</label>
        <div class="col-md-4 col-sm-4 col-xs-12 form-group">
            <input type="text" class="form-control input-bairro" name="bairro" maxlength="125" placeholder="Bairro"
                   value="@if(isset($User->profissional->contato->bairro)){{$User->profissional->contato->bairro}}@else{{old('bairro')}}@endif">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Endereço:</label>
        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
            <input type="text" class="form-control input-logradouro" name="logradouro" maxlength="100"
                   placeholder="Endereço"
                   value="@if(isset($User->profissional->contato->logradouro)){{$User->profissional->contato->logradouro}}@else{{old('logradouro')}}@endif">
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 form-group">
            <input type="text" class="form-control" name="complemento" maxlength="50" placeholder="Complemento"
                   value="@if(isset($User->profissional->contato->complemento)){{$User->profissional->contato->complemento}}@else{{old('complemento')}}@endif">
        </div>
    </div>
</section>
