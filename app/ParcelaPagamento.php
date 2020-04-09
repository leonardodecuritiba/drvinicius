<?php

namespace App;

use  App\Helpers\DataHelper;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ParcelaPagamento extends Model {
	protected $table = 'parcela_pagamentos';
	protected $primaryKey = 'id';
	protected $fillable = [
		'idparcela',
		'idtipo_pagamento',
		'data_pagamento',
		'recibo_em',
		'valor'
	];

	protected $appends = [
		'recibo_em_f'
	];


	// ******************** BELONGSTO ****************************
	// Relação ParcelaPagamento - 1 <-> N - parcela.
	static public function gerarRecibo( $id ) {
		$self = self::findOrFail( $id );
		$self->update( [
			'recibo_em' => Carbon::now()
		] );

		return $self;
	}

	static public function filter( $data ) {
		//buscando a partir dos orçamentos
		$query          = Orcamento::orderBy( 'idorcamento', 'desc' );
		$queryPacientes = Paciente::orderBy( 'idpaciente', 'desc' );

		//filtro planos
		if ( isset( $data['idplano'] ) && ( $data['idplano'] != '' ) ) {
			$queryPacientes->where( 'idplano', $data['idplano'] );
		}

		//filtro pacientes
		if ( isset( $data['idpaciente'] ) && ( $data['idpaciente'] != '' ) ) {
			$queryPacientes->where( 'idpaciente', $data['idpaciente'] );
		}


		$query->whereIn( 'idpaciente', $queryPacientes->pluck( 'idpaciente' ) );

		//filtro profissionais
		if ( isset( $data['idprofissional'] ) && ( $data['idprofissional'] != '' ) ) {
			$query->where( 'idprofissional', $data['idprofissional'] );
		}


		$query = ParcelaPagamento::whereIn( 'idparcela',
			Parcela::whereIn( 'idpagamento',
				Pagamento::whereIn( 'idorcamento', $query->pluck( 'idorcamento' ) )->pluck( 'idpagamento' )
			)->pluck( 'idparcela' )
		);

		if ( isset( $data['data_inicial'] ) && ( isset( $data['data_final'] ) ) ) {
			$query = $query->whereBetween( 'data_pagamento', [
				DataHelper::setDateToDateTime( $data['data_inicial'] ),
				DataHelper::setDateToDateTime( $data['data_final'] )
			] );
		}

		//filtro recbidos gerados
		if ( isset( $data['emitidas'] ) && ( $data['emitidas'] != '' ) ) {
			$query->whereNotNull( 'recibo_em' );
		}

		//filtro idtipo_pagamento
		if ( isset( $data['idtipo_pagamento'] ) && ( $data['idtipo_pagamento'] != '' ) ) {
			$query->where( 'idtipo_pagamento', $data['idtipo_pagamento'] );
		}

		return $query->get();
	}

	static public function total_recebido() {
		return DataHelper::getFloat2RealMoney( self::sum( 'valor' ) );
	}

	static public function pagar( $idparcela, $data ) {
		return self::create( [
			'idparcela'        => $idparcela,
			'idtipo_pagamento' => $data['idtipo_pagamento'],
			'data_pagamento'   => DataHelper::setDate( $data['data_pagamento'] ),
			'valor'            => $data['valor']
		] );
	}


	static public function estornar( $id ) {
		$ParcelaPagamento = self::find( $id );
		$ParcelaPagamento->delete();
		$Parcela = $ParcelaPagamento->parcela;

		return $Parcela;
	}

	static public function parcelasPagas( $idparcelas ) {
		return self::whereIn( 'idparcela', $idparcelas )->get()->map( function ( $p ) {
			$p->valor_formatado          = $p->getValorReal();
			$p->data_pagamento_formatado = $p->getDataPagamento();

			return $p;
		} );;
	}


	public function getReciboEmFAttribute() {
		return DataHelper::getPrettyDateTime( $this->attributes['recibo_em'] );
	}

	public function valor_extenso() {
		return DataHelper::extenso( $this->attributes['valor'], true );
	}

	public function getValorReal() {
		return DataHelper::getFloat2RealMoney( $this->attributes['valor'] );
	}

	public function getDataPagamento() {
		return DataHelper::getPrettyDate( $this->attributes['data_pagamento'] );
	}

	public function parcela() {
		return $this->belongsTo( 'App\Parcela', 'idparcela' );
	}

	public function tipo_pagamento() {
		return $this->belongsTo( TipoPagamento::class, 'idtipo_pagamento' );
	}

	public function paciente() {
		return $this->pagamento()->paciente;
	}

	public function pagamento() {
		return $this->parcela->pagamento;
	}

	public function profissional() {
		return $this->orcamento()->profissional;
	}

	public function orcamento() {
		return $this->pagamento()->orcamento;
	}
}
