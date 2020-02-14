<?php

namespace App\Models;

use App\Helpers\DataHelper;
use Illuminate\Database\Eloquent\Model;

class Valores extends Model {
	const _TIPO_SAIDA_ = 0;
	const _TIPO_ENTRADA_ = 1;
	protected $fillable = [
//        'idpaciente',
//        'idprofissional',
		'tipo',
		'data',
		'fonte',
		'documento',
		'valor',
	];

	// ******************** FUNCTIONS ****************************
	static public function filter( $data ) {
		$query = ( $data['tipo'] == 'despesas' ) ? self::despesas() : self::receitas();

		//filtro fonte
		if ( isset( $data['fonte'] ) && ( $data['fonte'] != '' ) ) {
			$query->where( 'fonte', 'like', '%' . $data['fonte'] . '%' );
		}

		//filtro documento
		if ( isset( $data['documento'] ) && ( $data['documento'] != '' ) ) {
			$query->where( 'documento', 'like', '%' . $data['documento'] . '%' );
		}

		if ( isset( $data['data_inicial'] ) && ( isset( $data['data_final'] ) ) ) {
			$query = $query->whereBetween( 'data', [
				DataHelper::setDateToDateTime( $data['data_inicial'] ),
				DataHelper::setDateToDateTime( $data['data_final'] )
			] );
		}

		return $query->get();
	}


	public function scopeDespesas( $query ) {
		return $query->where( 'tipo', 0 );
	}

	public function scopeReceitas( $query ) {
		return $query->where( 'tipo', 1 );
	}

	public function getTipoName() {
		return ( $this->attributes['tipo'] ) ? 'receitas' : 'despesas';
	}

	public function getTipoText() {
		return self::getTipo( $this->attributes['tipo'] );
	}

	static public function getTipo( $tipo ) {
		return ( ( $tipo == self::_TIPO_ENTRADA_ ) || ( $tipo == 'receitas' ) ) ? 'Receitas' : 'Despesas';
	}

	public function getData() {
		return ( $this->attributes['data'] != null ) ? DataHelper::getPrettyDate( $this->attributes['data'] ) : null;
	}

	public function getValor() {
		return ( $this->attributes['valor'] != null ) ? DataHelper::getFloat2RealMoney( $this->attributes['valor'] ) : null;
	}

	public function setTipoAttribute( $value ) {
		$this->attributes['tipo'] = ( $value == 'receitas' ) ? 1 : 0;
	}

	public function setDataAttribute( $value ) {
		$this->attributes['data'] = DataHelper::setDate( $value );
	}

	public function setValorAttribute( $value ) {
		$this->attributes['valor'] = DataHelper::getReal2Float( $value );
	}

	// ******************** BELONGSTO ****************************
}
