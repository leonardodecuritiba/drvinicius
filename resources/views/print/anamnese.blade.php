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
            <th class="campo_valor" colspan="10">Anamnese: {{$respostas[0]->pergunta->anamnese->nome}}</th>
        </tr>
        <thead>
        <tr>
            <th colspan="5">Pergunta</th>
            <th colspan="5">Resposta</th>
        </tr>
        </thead>
        <tbody>
        @foreach($respostas as $resposta)
            <tr>
                <td colspan="5" style="text-align: left;">{{$resposta->pergunta->texto_pergunta}}</td>
                <td colspan="5" style="text-align: left;">{{$resposta->ver_resposta()}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection