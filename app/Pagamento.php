<?php

namespace App;

use App\Helpers\DataHelper;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model {
	protected $table = 'pagamento';
	protected $primaryKey = 'idpagamento';
	protected $fillable = [
		'idorcamento',
		'idpaciente',
		'pagamento'
	];
	// ******************** FUNCTIONS ****************************
	/*
	*/

	public function getStatusText() {
		$abertas = $this->parcelas()->where( 'pago', 0 )->count();

		return ( $abertas > 0 ) ? 'Pendente' : 'Recebido';
	}

	public function parcelas() {
		return $this->hasMany( 'App\Parcela', 'idpagamento' );
	}

	public function getStatusColor() {
		$abertas = $this->parcelas()->where( 'pago', 0 )->count();

		return ( $abertas > 0 ) ? 'danger' : 'success';
	}

	public function valores_total_parcelas( $float = false ) {
		$valores = $this->parcelas->map( function ( $parcela ) {
			//total, pago, pendente, vencimento
			return [
				'valor_pago'     => $parcela->getValorPago(),
				'valor_pendente' => $parcela->getValorPendente(),
			];
		} );
		if ( $float ) {
			$retorno = (object) [
				'valor_pago'     => $valores->sum( 'valor_pago' ),
				'valor_pendente' => $valores->sum( 'valor_pendente' )
			];
		} else {
			$retorno = (object) [
				'valor_pago'     => DataHelper::getFloat2RealMoney( $valores->sum( 'valor_pago' ) ),
				'valor_pendente' => DataHelper::getFloat2RealMoney( $valores->sum( 'valor_pendente' ) ),
			];
		}

		return $retorno;
	}

	public function parcelas_pagas() {
		return $this->parcelas->where( 'pago', 1 )->map( function ( $parcela ) {
			$parcela->valor_formatado = $parcela->getValorTotalReal();

			return $parcela;
		} );
	}
	// ******************** BELONGSTO ****************************
	// Relação orcamento - 1 <-> 1 - pagamento.

	public function parcelas_pendentes() {
		return $this->parcelas->where( 'pago', 0 )->map( function ( $p ) {
			$p->total_pago     = $p->parcela_pagamentos->sum( 'valor' );
			$p->total_pendente = $p->valor - $p->total_pago;

			$p->valor_formatado          = DataHelper::getFloat2RealMoney( $p->valor );
			$p->total_pago_formatado     = DataHelper::getFloat2RealMoney( $p->total_pago );
			$p->total_pendente_formatado = DataHelper::getFloat2RealMoney( $p->total_pendente );

			return $p;
		} );
	}

	public function orcamento() {
		return $this->belongsTo( 'App\Orcamento', 'idorcamento' );
	}

	// ******************** HASMANY ****************************
	// Relação pagamento - 1 <-> N - parcela.

	public function paciente() {
		return $this->belongsTo( 'App\Paciente', 'idpaciente' );
	}
}
