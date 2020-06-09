<?php

namespace App\Http\Controllers;

use App\Helpers\DataHelper;
use App\Helpers\PrintHelper;
use App\Parcela;
use App\ParcelaPagamento;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use App\ItemOrcamento;
use App\Pagamento;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Orcamento;
use App\Http\Controllers\PacientesController;
use Illuminate\Http\Request;
use App\Http\Requests;

class PagamentoController extends Controller {
	protected $Page;

	public function __construct() {
		$this->idprofissional_criador = Auth::user()->profissional->idprofissional;
		$this->Page                   = (object) [
			'link'    => 'orcamentos',
			'Targets' => 'Orçamentos',
			'Target'  => 'Orçamento',
			'Titulo'  => 'Orçamento',
			'funcao'  => 'index'
		];
	}

	public function store( Request $request ) {
		$idpaciente = $request->get( 'idpaciente' );
		$validator  = Validator::make( $request->all(), [
			'idpaciente'      => 'required',
			'descricao'       => 'required',
			'numero_parcelas' => 'required',
			'idintervencao'   => 'required',
		] );
		if ( $validator->fails() ) {
			return redirect( 'pacientes/' . $idpaciente )
				->withErrors( $validator )
				->withInput();
		} else {
			$data = $request->all();

			//fazer laço nas intervencoes
			//calcular valor total
			$data['valor_total'] = 0;
			foreach ( $data['idintervencao'] as $key => $intervencao ) {
				$value               = str_replace( '.', '', $data["valor"][ $key ] );
				$data['valor_total'] += floatval( str_replace( ',', '.', $value ) );
			}
//            echo 'valor_total= '.$data['valor_total']."<br>";
			$data['desconto']        = ( $data['desconto'] != "" ) ? $data['desconto'] : 0;
			$data['valor_entrada']   = ( $data['valor_entrada'] != "" ) ? floatval( str_replace( ',', '.', str_replace( '.', '', $data["valor_entrada"] ) ) ) : 0;
			$data['numero_parcelas'] = intval( $data['numero_parcelas'] );
			$Orcamento               = Orcamento::create( $data );

			foreach ( $data['idintervencao'] as $key => $intervencao ) {
				$value         = str_replace( '.', '', $data["valor"][ $key ] );
				$item          = [
					'idorcamento'   => $Orcamento->idorcamento,
					'idintervencao' => $intervencao,
					'regiao'        => $data["regiao"][ $key ],
					'valor'         => floatval( str_replace( ',', '.', $value ) )
				];
				$ItemOrcamento = ItemOrcamento::create( $item );
			}
			/*
			//verificar se tem desconto. se tiver, calcular novo valor
			$valor_total_desconto = $data['valor_total'];
			//verificar se tem desconto. se tiver, calcular novo valor
			$valor_total_desconto = $data['valor_total'];
			if($request->has('desconto')){
				$valor_total_desconto -= ($valor_total_desconto * $data['desconto']/100);
				echo 'valor_total_desconto= '.$valor_total_desconto."<br>";
			}
			//verificar se tem entrada. se tiver calcular valor restante
			if($request->has('valor_entrada')){
				$value = str_replace('.','',$data["valor_entrada"]);
				$valor_total_desconto -= floatval(str_replace(',','.',$value));
				echo 'valor_total_desconto (com entrada) = '.$valor_total_desconto."<br>";
			}
			//verificar se tem parcelamento. se tiver, calcular valor de parcelas
			if($request->has('numero_parcelas')){
				$valor_total_final = floatval(str_replace(',','.',$value));
				echo 'valor_total_desconto (com entrada) = '.$valor_total_desconto."<br>";
			}
			*/

			session()->forget( 'mensagem' );
			session( [ 'mensagem' => $this->Page->Target . ' cadastrado!' ] );

			return redirect()->route( 'pacientes.show', $idpaciente );
		}

	}

	public function imprimir( $id ) {

		return PrintHelper::recibo( ParcelaPagamento::gerarRecibo( $id ) );
	}

	public function estornar( $idparcela_pagamento ) {
		$Parcela = Parcela::estornar( $idparcela_pagamento );
		session()->forget( 'mensagem' );
		session( [ 'mensagem' => 'Pagamento estornado!' ] );

		return redirect()->route( 'pacientes.show', $Parcela->pagamento->idpaciente );
	}

	public function alterarVencimento( Request $request ) {
		$Parcela = Parcela::alterarVencimento( $request->all() );
		session()->forget( 'mensagem' );
		session( [ 'mensagem' => 'Vencimento da Parcela alterado!' ] );

		return redirect()->route( 'pacientes.show', $Parcela->pagamento->idpaciente );
	}

	public function receber( Request $request ) {
		$Parcela = Parcela::pagar( $request->all() );
		session()->forget( 'mensagem' );
		session( [ 'mensagem' => 'Pagamento efetuado!' ] );

		return redirect()->route( 'pacientes.show', $Parcela->pagamento->idpaciente );
	}

	public function parcelas_pagas( $id ) {
		$data = Pagamento::find( $id );

		return ParcelaPagamento::parcelasPagas( $data->parcelas->pluck( 'idparcela' ) );
	}

	public function parcelas_pendentes( $id ) {
		$data = Pagamento::find( $id );

		return $data->parcelas_pendentes();
	}

	public function destroy( $id ) {
		$Pagamento  = Pagamento::find( $id );
		$idpaciente = $Pagamento->idpaciente;
		$Pagamento->orcamento->desaprovar();
		$Pagamento->delete();
		session()->forget( 'mensagem' );
		session( [ 'mensagem' => $this->Page->Target . ' removido!' ] );

		return redirect()->route( 'pacientes.show', $idpaciente );
	}
}
