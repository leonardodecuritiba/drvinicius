<?php

namespace App;

use App\Helpers\DataHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model {
	protected $table = 'parcela';
	protected $primaryKey = 'idparcela';
	protected $fillable = [
		'idpagamento',
		'idtipo_pagamento',
		'numero',
		'pago',
		'data_vencimento',
		'data_pagamento',
		'valor'
	];

	// ******************** FUNCTIONS ****************************
	static public function getFromPagamento( $ids ) {
		return self::whereIn( 'idpagamento', $ids )->get()->map( function ( $p ) {
			$p->total_pago          = $p->parcela_pagamentos->sum( 'valor' );
			$p->total_pago_real     = DataHelper::getFloat2RealMoney( $p->total_pago );
			$p->total_pendente      = $p->valor - $p->parcela_pagamentos->sum( 'valor' );
			$p->total_pendente_real = DataHelper::getFloat2RealMoney( $p->total_pendente );

			return $p;
		} );
	}

	static public function getSistemaTotalPagoReal() {
		return DataHelper::getFloat2RealMoney( self::sistema_total()->sum( 'total_pago' ) );
	}

	static public function sistema_total() {
		return self::all()->map( function ( $p ) {
			$p->total_pago     = $p->parcela_pagamentos->sum( 'valor' );
			$p->total_pendente = $p->valor - $p->parcela_pagamentos->sum( 'valor' );

			return $p;
		} );
	}

	static public function getSistemaTotalPendenteReal() {
		return DataHelper::getFloat2RealMoney( self::sistema_total()->sum( 'total_pendente' ) );
	}

	static public function pagar( $data ) {
		$Parcela       = self::find( $data['idparcela'] );
		$data['valor'] = DataHelper::getReal2Float( $data['valor'] );
		$pendente      = $Parcela->getValorPendente();
		if ( $data['valor'] >= $pendente ) {
			//pagou tudo
			$data['valor'] = $pendente;
			ParcelaPagamento::pagar( $data['idparcela'], $data );
			$Parcela->update( [
				'pago'           => 1,
				'data_pagamento' => DataHelper::setDate( $data['data_pagamento'] ),
			] );
		} else {
			//nao pagou tudo
			ParcelaPagamento::pagar( $Parcela->idparcela, $data );
		}

		return $Parcela;
	}

	static public function estornar( $idparcela_pagamento ) {
		$Parcela  = ParcelaPagamento::estornar( $idparcela_pagamento );
		$pendente = $Parcela->getValorPendente();
		if ( $pendente > 0 ) {
			$update = [
				'pago'           => 0,
				'data_pagamento' => null,
			];
		} else {
			$update = [
				'pago' => 1
			];
		}
		$Parcela->update( $update );

		return $Parcela;
	}

	static public function alterarVencimento( $data ) {
		$Parcela = self::find( $data['idparcela'] );
		$Parcela->update( [
			'data_vencimento' => DataHelper::setDate( $data['data_vencimento'] ),
		] );

		return $Parcela;
	}

	// ******************** SCOPE ****************************

	/**
	 * Scope a query to only include popular users.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeVencidas( $query ) {
		return $query->where( 'pago', 0 )
		             ->whereNull( 'data_pagamento' )
		             ->where( 'data_vencimento', '<=', Carbon::now() );
	}


	// ******************** BELONGSTO ****************************

	public function paciente() {
		return $this->pagamento->paciente();
	}

	public function getDataVencimentoAttribute( $value ) {
		if ( $value != null && $value != 0 ) {
			return Carbon::createFromFormat( 'Y-m-d', $value )->format( 'd/m/Y' );
		} else {
			return '-';
		}
	}

	public function getDataPagamentoAttribute( $value ) {
		if ( $value != null && $value != 0 ) {
			return Carbon::createFromFormat( 'Y-m-d', $value )->format( 'd/m/Y' );
		} else {
			return '-';
		}
	}

	public function getValorTotalReal() {
		return DataHelper::getFloat2RealMoney( $this->attributes['valor'] );
	}

	public function getValorPagoReal() {
		return DataHelper::getFloat2RealMoney( $this->getValorPago() );
	}

	public function getValorPago() {
		return $this->parcela_pagamentos->sum( 'valor' );
	}

	public function getValorPendenteReal() {
		return DataHelper::getFloat2RealMoney( $this->getValorPendente() );
	}

	public function getValorPendente() {
		return $this->attributes['valor'] - $this->getValorPago();
	}


	// ******************** BELONGSTO ****************************
	// Relação pagamento - 1 <-> N - parcela.

	public function pagamento() {
		return $this->belongsTo( 'App\Pagamento', 'idpagamento' );
	}

	// Relação tipo_pagamento - 1 <-> N - parcela.
	public function tipo_pagamento() {
		return $this->belongsTo( 'App\TipoPagamento', 'idtipo_pagamento' );
	}

	// ******************** HASONE ******************************
	// Relação parcela - 1 <-> 1 - recibo.
	public function parcela_pagamentos() {
		return $this->hasMany( 'App\ParcelaPagamento', 'idparcela' );
	}
}
