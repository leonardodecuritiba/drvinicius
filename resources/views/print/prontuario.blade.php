@extends('print.template')
@section('body_content')
    <table border="1" class="table table-condensed table-bordered">
        @include('print.cabecalho')
        <tr>
            <td colspan="2">Prontuário:</td>
            <td colspan="8">{{$paciente->idpaciente}} - {{$paciente->nome}}</td>
        </tr>
        <tr>
            <td colspan="2">Cadastrado em:</td>
            <td colspan="8">{{$paciente->created_at}}</td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr>
            <td class="campo_titulo" colspan="10">Dados Pessoais</td>
        </tr>
        <tr>
            <td colspan="2">Nome:</td>
            <td class="campo_valor" colspan="8">{{$paciente->nome}}</td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr>
            <td colspan="2">CPF:</td>
            <td class="campo_valor" colspan="3">{{$paciente->cpf}}</td>
            <td colspan="2">RG:</td>
            <td class="campo_valor" colspan="3">{{$paciente->rg}}</td>
        </tr>
        <tr>
            <td colspan="2">Nascimento:</td>
            <td class="campo_valor" colspan="3">{{$paciente->data_nascimento}}</td>
            <td colspan="2">Email:</td>
            <td class="campo_valor" colspan="3">{{$paciente->contato->email}}</td>
        </tr>
        <tr>
            <td colspan="2">Telefone:</td>
            <td class="campo_valor" colspan="3">{{$paciente->contato->telefone}}</td>
            <td colspan="2">Celular:</td>
            <td class="campo_valor" colspan="3">{{$paciente->contato->celular}}</td>
        </tr>
        <tr>
            <td colspan="2">Comercial:</td>
            <td class="campo_valor" colspan="3">{{$paciente->contato->comercial}}</td>
            <td colspan="5"></td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr>
            <td colspan="2">CEP:</td>
            <td class="campo_valor" colspan="3">{{$paciente->contato->cep}}</td>
            <td colspan="2">Estado:</td>
            <td class="campo_valor" colspan="3">{{$paciente->contato->estado}}</td>
        </tr>
        <tr>
            <td colspan="2">Cidade:</td>
            <td class="campo_valor" colspan="3">{{$paciente->contato->cidade}}</td>
            <td colspan="2">Bairro:</td>
            <td class="campo_valor" colspan="3">{{$paciente->contato->bairro}}</td>
        </tr>
        <tr>
            <td colspan="2">Endereço:</td>
            <td class="campo_valor" colspan="5">{{$paciente->contato->logradouro}}</td>
            <td class="campo_valor" colspan="1">{{$paciente->contato->numero}}</td>
            <td class="campo_valor" colspan="2">{{$paciente->contato->complemento}}</td>
        </tr>
        <tr>
            <td colspan="2">Observações:</td>
            <td class="campo_valor" colspan="8"></td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
    </table>
@endsection