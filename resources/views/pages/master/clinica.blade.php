@extends('layouts.template')
@section('style_content')
    {!! Html::style('vendors/select2/dist/css/select2.min.css') !!}
@endsection
@section('page_content')
	<?php
	if ( isset( $Clinica ) ) {
		$route = [ $Page->link . '.update', $Clinica->idclinica ];
	} else {
		$route = $Page->link . '.store';
	}
	$estado = isset( $Clinica->contato->estado ) ? $Clinica->contato->estado : old( 'estado' );
	?>

    <!-- page content -->
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Clínica</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Dados gerais</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        {!! Form::open(['route' => $route, 'files' => true,
                                                        'method' => 'POST',
                                                        'class' => 'form-horizontal form-label-left',
                                                        'data-parsley-validate']) !!}
                        @if(isset($Clinica) && ($Clinica->foto != ""))
                            <div class="form-group">
                                <div class="col-md-offset-4 col-sm-offset-4 col-xs-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="peca_image">
                                        <img src="{{$Clinica->getFoto()}}" width="70%"/>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        @endif
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Logo:</label>
                            <div class="col-md-10 col-sm-10 col-xs-12 form-group">
                                <input name="foto" type="file" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Nome da clínica:
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-6 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" name="nome"
                                       placeholder="Nome da clínica"
                                       value="@if(isset($Clinica->nome)){{$Clinica->nome}}@else{{old('nome')}}@endif"
                                       required>
                                <span class="fa fa-hospital-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">CPF/CNPJ:</label>
                            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" name="cnpj" maxlength="20"
                                       placeholder="20.711.652/0001-41"
                                       value="@if(isset($Clinica->cnpj)){{$Clinica->cnpj}}@else{{old('cnpj')}}@endif"
                                       required>
                                <span class="fa fa-hospital-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12"
                                   for="first-name">Responsável:</label>
                            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                                <select class="form-control" name="idresponsavel" required>
                                    @foreach($Profissionais as $profissional)
                                        <option value="{{$profissional->idprofissional}}"
                                                @if(isset($Clinica) && ($Clinica->idresponsavel) == ($profissional->idprofissional)) selected @endif
                                        >{{$profissional->nome}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">E-mail:
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" name="email"
                                       placeholder="clinica@gmail.com"
                                       value="@if(isset($Clinica->email)){{$Clinica->email}}@else{{old('email')}}@endif"
                                       required>
                                <span class="fa fa-envelope-o form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Telefone:</label>
                            <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                                <input type="text" class="form-control show-telefone" name="telefone"
                                       placeholder="Telefone"
                                       value="@if(isset($Clinica->contato->telefone)){{$Clinica->contato->telefone}}@else{{old('telefone')}}@endif">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Celular:</label>
                            <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                                <input type="text" class="form-control show-celular" name="celular"
                                       placeholder="Celular"
                                       value="@if(isset($Clinica->contato->celular)){{$Clinica->contato->celular}}@else{{old('celular')}}@endif">
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Comercial:</label>
                            <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                                <input type="text" class="form-control show-telefone" name="comercial"
                                       placeholder="Comercial"
                                       value="@if(isset($Clinica->contato->comercial)){{$Clinica->contato->comercial}}@else{{old('comercial')}}@endif">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <section id="endereco">
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">CEP:</label>
                                <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                                    <input type="text" class="form-control show-cep" id="cep" name="cep"
                                           placeholder="CEP"
                                           value="@if(isset($Clinica->contato->cep)){{$Clinica->contato->cep}}@else{{old('cep')}}@endif"
                                           required>
                                </div>
                                <label class="control-label col-md-2 col-sm-2 col-xs-12"
                                       for="first-name">Estado:</label>
                                <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                                    <select class="select2_group form-control input-estado" name="estado">
                                        @foreach($Page->Estados as $key => $value)
                                            <option value="{{$key}}"
                                                    @if(isset($Clinica->contato->estado) && ($Clinica->contato->estado == $key))
                                                    selected
                                                    @endif
                                            >{{$value}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12"
                                       for="first-name">Cidade:</label>
                                <div class="col-md-4 col-sm-4 col-xs-12 form-group input-cidade">
                                    <input type="text" class="form-control input-cidade" name="cidade" maxlength="60"
                                           id="inputSuccess2" placeholder="Cidade"
                                           value="@if(isset($Clinica->contato->cidade)){{$Clinica->contato->cidade}}@else{{old('cidade')}}@endif">
                                </div>
                                <label class="control-label col-md-2 col-sm-2 col-xs-12"
                                       for="first-name">Bairro:</label>
                                <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                                    <input type="text" class="form-control input-bairro" name="bairro" maxlength="125"
                                           placeholder="Bairro"
                                           value="@if(isset($Clinica->contato->bairro)){{$Clinica->contato->bairro}}@else{{old('bairro')}}@endif">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12"
                                       for="first-name">Endereço:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                    <input type="text" class="form-control input-logradouro" name="logradouro"
                                           maxlength="100" placeholder="Endereço"
                                           value="@if(isset($Clinica->contato->logradouro)){{$Clinica->contato->logradouro}}@else{{old('logradouro')}}@endif">
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                                    <input type="text" class="form-control" name="complemento" maxlength="50"
                                           placeholder="Complemento"
                                           value="@if(isset($Clinica->contato->complemento)){{$Clinica->contato->complemento}}@else{{old('complemento')}}@endif">
                                </div>
                            </div>
                        </section>
                        <div class="form-group pull-right">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <button type="submit" class="btn btn-danger">Cancelar</button>
                                <button type="submit" class="btn btn-success">Salvar</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts_content')
    {!! Html::script('vendors/select2/dist/js/select2.min.js') !!}
    <!-- form validation -->
    {!! Html::script('js/parsley/parsley.min.js') !!}

    <!-- GET CEP CODE -->
    <script>
        $(document).ready(function () {
            var _cep_input = 'input#cep';
            var _logradouro_input = '.input-logradouro';
            var _bairro_input = '.input-bairro';
            var _cidade_input = '.input-cidade';
            var _estado_input = '.input-estado';
            $(_cep_input).change(function () {
                var cep_code = $(this).val();
                if (cep_code.length <= 0) return;
                $.get("http://apps.widenet.com.br/busca-cep/api/cep.json", {code: cep_code},
                    function (result) {
                        if (result.status != 1) {
                            alert(result.message || "Houve um erro desconhecido");
                            return false;
                        }
                        console.log(result);
                        $(_cep_input).val(result.code);
                        $(_logradouro_input).val(result.address);
                        $(_bairro_input).val(result.district);
                        $(_cidade_input).val(result.city);
                        $(_estado_input).val(result.state);
                    });
            });
            @if($estado != "")$(_estado_input).val('{{$estado}}');@endif
        });

    </script>
@endsection