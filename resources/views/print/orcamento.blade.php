@extends('print.template')
@section('body_content')
	<?php $profissional = $orcamento->profissional; ?>
    <table border="1" class="table table-condensed table-bordered">
        @include('print.cabecalho')
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr class="fundo_cinza linha_titulo">
            <th colspan="10">Previsão de honorários</th>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr class="linha_titulo">
            <td colspan="2">Data de Início</td>
            <td colspan="4">Nome do Paciente</td>
            <td colspan="4">Nome do Cirurgião</td>
        </tr>
        <tr>
            <td colspan="2">{{$paciente->created_at}}</td>
            <td colspan="4">{{$paciente->nome}}</td>
            <td colspan="4">{{$profissional->nome}}</td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr class="linha_titulo fundo_cinza">
            <td colspan="2">Região</td>
            <td colspan="6">Descrição</td>
            <td colspan="2">Valores</td>
        </tr>
        @foreach($orcamento->itens_orcamento as $item)
            <tr>
                <td colspan="2">{{$item->regiao}}</td>
                <td colspan="6">{{$item->intervencao->nome}}</td>
                <td colspan="2">R$ {{$item->valor}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr class="fundo_cinza">
            <td colspan="2">Valor Total</td>
            <td colspan="2">Valor com desconto</td>
            <td colspan="2">Total já pago</td>
            <td colspan="2">Total a pagar</td>
            <td colspan="2">Entrada</td>
        </tr>
        <tr>
            <td colspan="2">{{$orcamento->valor_total}}</td>
            <td colspan="2">{{$orcamento->valor_final_total()}}</td>
            <td colspan="2">{{$orcamento->total_pago()}}</td>
            <td colspan="2">{{$orcamento->total_pendente()}}</td>
            <td colspan="2">{{$orcamento->valor_entrada}}</td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr class="fundo_cinza linha_titulo">
            <td colspan="10">Parcelamento</td>
        </tr>
        <tr class="linha_titulo">
            <td colspan="1">Nº</td>
            <td colspan="5">Vencimento (estimado)</td>
            <td colspan="4">Valor (R$)</td>
        </tr>
		<?php $hoje = \Carbon\Carbon::now(); ?>
        @if($orcamento->valor_entrada>0)
            <tr>
                <td colspan="1">Entrada</td>
                <td colspan="5">{{$hoje->format('d/m/Y')}}</td>
                <td colspan="4">{{$orcamento->valor_entrada}}</td>
            </tr>
			<?php $hoje->addMonth(); ?>
        @endif
        @for($i=1; $i<=$orcamento->numero_parcelas; $i++)
            <tr>
                <td colspan="1">{{$i}}</td>
                <td colspan="5">{{$hoje->format('d/m/Y')}}</td>
                <td colspan="4">{{$orcamento->valor_parcelas()}}</td>
            </tr>
			<?php $hoje->addMonth(); ?>
        @endfor
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr class="fundo_cinza linha_titulo">
            <td colspan="10">Observações</td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
        <tr>
            <td colspan="4" class="sublinhar"></td>
            <td colspan="2"></td>
            <td colspan="4" class="sublinhar"></td>
        </tr>
        <tr>
            <td colspan="4">Paciente: {{$paciente->nome}}</td>
            <td colspan="2"></td>
            <td colspan="4">Profissional: {{$profissional->nome}}</td>
        </tr>
        <tr>
            <td colspan="4">CPF: {{$paciente->cpf}}</td>
            <td colspan="2"></td>
            <td colspan="4">CPF: {{$profissional->cpf}}</td>
        </tr>
        <tr>
            <td colspan="6"></td>
            <td colspan="4">CRO: {{$profissional->cro}}</td>
        </tr>

    </table>
@endsection