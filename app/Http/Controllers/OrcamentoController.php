<?php

namespace App\Http\Controllers;

use App\Helpers\PrintHelper;
use App\Parcela;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use App\ItemOrcamento;
use App\Pagamento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Orcamento;
use App\Http\Controllers\PacientesController;
use Illuminate\Http\Request;
use App\Http\Requests;

class OrcamentoController extends Controller {
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
			return redirect( 'pacientes/' . $idpaciente . '/orcamentos' )
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

			return redirect( 'pacientes/' . $idpaciente . '/orcamentos' );
		}

	}

	public function update( Request $request, $idorcamento ) {
		$validator = Validator::make( $request->all(), [
			'idpaciente'      => 'required',
			'descricao'       => 'required',
			'numero_parcelas' => 'required',
			'idintervencao'   => 'required',
		] );
		if ( $validator->fails() ) {
			return redirect()->back()
			                 ->withErrors( $validator )
			                 ->withInput();
		} else {
			$data = $request->all();

//            return $data;
			//fazer laço nas intervencoes
			//calcular valor total
			$data['valor_total'] = 0;
			foreach ( $data['idintervencao'] as $key => $intervencao ) {
				$value               = str_replace( '.', '', $data["valor"][ $key ] );
				$data['valor_total'] += floatval( str_replace( ',', '.', $value ) );
			}
//            echo 'valor_total= '.$data['valor_total']."<br>";
			$data['desconto']        = ( $data['desconto'] != "" ) ? str_replace( '%', '', $data['desconto'] ) : 0;
			$data['valor_entrada']   = ( $data['valor_entrada'] != "" ) ? floatval( str_replace( ',', '.', str_replace( '.', '', $data["valor_entrada"] ) ) ) : 0;
			$data['numero_parcelas'] = intval( $data['numero_parcelas'] );

//            return $data;
			$Orcamento = Orcamento::find( $idorcamento );
//            $Orcamento->remove_itens();
			$Orcamento->update( $data );

			foreach ( $data['idintervencao'] as $key => $intervencao ) {
				$value = floatval( str_replace( ',', '.', str_replace( '.', '', $data["valor"][ $key ] ) ) );
				$item  = [
					'idorcamento'   => $Orcamento->idorcamento,
					'idintervencao' => $intervencao,
					'regiao'        => $data["regiao"][ $key ],
					'valor'         => $value
				];
				if ( isset( $data["iditem_orcamento"][ $key ] ) ) {
					$ItemOrcamento = ItemOrcamento::find( $data["iditem_orcamento"][ $key ] );
					$ItemOrcamento->update( $item );
				} else {
					$ItemOrcamento = ItemOrcamento::create( $item );
				}
			}

			session()->forget( 'mensagem' );
			session( [ 'mensagem' => $this->Page->Target . ' atualizado!' ] );

			return redirect( 'pacientes/' . $Orcamento->idpaciente . '/orcamentos' );
		}

	}

	public function aprovar( $idorcamento ) {
		$orcamento = Orcamento::find( $idorcamento );
		if ( $orcamento->aprovacao == 1 ) {
			return redirect()->route( 'pacientes.show', $orcamento->idpaciente );
		}
		$orcamento->aprovar();

		$numero_parcelas = $orcamento->numero_parcelas;
		$valor_parcelas  = $orcamento->valor_parcelas( true );

		//criar pagamento
		$Pagamento              = Pagamento::create( [
			'idorcamento' => $idorcamento,
			'idpaciente'  => $orcamento->idpaciente
		] );
		$parcela['idpagamento'] = $Pagamento->idpagamento;
		$from                   = Carbon::now();

		$entrada = $orcamento->valor_entrada_float();
		$i       = 0;
		if ( $entrada > 0 ) {
			$parcela['numero']          = $i;
			$parcela['valor']           = $entrada;
			$parcela['data_vencimento'] = $from->format( "Y-m-d" );
			Parcela::create( $parcela );
			$i ++;
			$from->add( new DateInterval( 'P1M' ) );
//            print_r($parcela);echo '<br>';
		}

		$to = clone $from;
		$to->add( new DateInterval( 'P' . $numero_parcelas . 'M' ) );
		$interval  = new DateInterval( 'P1M' );
		$daterange = new DatePeriod( $from, $interval, $to );

		//varrer os itens do orçamento e criar as parcelas do pagamento

		foreach ( $daterange as $date ) {
			$parcela['numero']          = $i;
			$parcela['valor']           = $valor_parcelas;
			$parcela['data_vencimento'] = $date->format( "Y-m-d" );
			Parcela::create( $parcela );
//            print_r($parcela);echo '<br>';
			$i ++;
		}
//        exit;

		session()->forget( 'mensagem' );
		session( [ 'mensagem' => $this->Page->Target . ' atualizado com sucesso!' ] );

		return redirect()->route( 'pacientes.show', $orcamento->idpaciente );
	}

	public function destroy( $id ) {
		$data       = Orcamento::find( $id );
		$idpaciente = $data->idpaciente;
		$data->delete();
		session()->forget( 'mensagem' );
		session( [ 'mensagem' => $this->Page->Target . ' removido!' ] );

		return redirect()->route( 'pacientes.show', $idpaciente );
	}

	public function destroy_item( $id ) {
		$data = ItemOrcamento::find( $id );
		$data->delete();

		return response()->json( [
			'status'   => '1',
			'response' => 'Removido com sucesso'
		] );
	}

	public function imprimir( $id ) {
		$Orcamento = Orcamento::find( $id );

//	    return $Orcamento;

		return PrintHelper::orcamento( $Orcamento );
	}

	public function sendByEmail( $id ) {
		$Orcamento = Orcamento::find( $id );
		$msg       = PrintHelper::sendByEmail( $Orcamento );
		session()->forget( 'mensagem' );
		session( [ 'mensagem' => $msg ] );

		return redirect()->route( 'pacientes.show', $Orcamento->idpaciente );
	}
}
