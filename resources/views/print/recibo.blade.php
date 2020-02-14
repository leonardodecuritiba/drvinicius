@extends('print.template')
@section('body_content')
	<?php $Parcela = $ParcelaPagamento->parcela; ?>
	<?php $Paciente = $Parcela->pagamento->paciente; ?>
	<?php $Profissional = $Parcela->pagamento->orcamento->profissional; ?>
    <table border="1" class="table table-condensed table-bordered">
		<?php for($i = 0; $i < 2; $i ++){ ?>
        @include('print.cabecalho')
        <tr>
            <td colspan="7" class="campo_titulo">Recibo</td>
            <td>R$</td>
            <td colspan="2" class="campo_titulo">{{$ParcelaPagamento->getValorReal()}}</td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr>
            <td colspan="2">Recebi de</td>
            <td colspan="4">{{$Paciente->nome}}</td>
            <td>CPF</td>
            <td colspan="2">{{$Paciente->cpf}}</td>
            <td>a quantia de</td>
        </tr>
        <tr>
            <td colspan="10">{{$ParcelaPagamento->valor_extenso()}}</td>
        </tr>
        <tr>
            <td colspan="10">referente ao tratamento odontológico realizado.</td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr>
            <td colspan="2">Data:</td>
            <td colspan="2">{{$ParcelaPagamento->getDataPagamento()}}</td>
            <td colspan="6"></td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr>
            <td colspan="10">Profissional: {{$Profissional->nome}}</td>
        </tr>
        <tr>
            <td colspan="10">CRO: {{$Profissional->cro}}</td>
        </tr>
        <tr>
            <td colspan="10">CPF: {{$Profissional->cpf}}</td>
        </tr>
        <tr>
            <td colspan="10">@for($x=0;$x<190;$x++).@endfor</td>
        </tr>
		<?php }?>
    </table>

@endsection