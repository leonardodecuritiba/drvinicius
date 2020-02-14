<?php

namespace App\Models;

use App\Helpers\DataHelper;
use Illuminate\Database\Eloquent\Model;

class Cheque extends Model {
	protected $fillable = [
//        'idpaciente',
//        'idprofissional',
		'idplano',
		'nome',
		'data',
		'valor',
		'banco',
		'numeracao',
		'destino'
	];

	// ******************** FUNCTIONS ****************************

	static public function filter( $data ) {
		//buscando a partir dos orçamentos
		$query = Cheque::orderBy( 'id', 'desc' );

		//filtro nome
		if ( isset( $data['nome'] ) && ( $data['nome'] != '' ) ) {
			$query->where( 'nome', 'like', '%' . $data['nome'] . '%' );
		}

		//filtro planos
		if ( isset( $data['idplano'] ) && ( $data['idplano'] != '' ) ) {
			$query->where( 'idplano', $data['idplano'] );
		}

		if ( isset( $data['data_inicial'] ) && ( isset( $data['data_final'] ) ) ) {
			$query = $query->whereBetween( 'data', [
				DataHelper::setDateToDateTime( $data['data_inicial'] ),
				DataHelper::setDateToDateTime( $data['data_final'] )
			] );
		}

		return $query->get();
	}

	public function getNomePlano() {
		return $this->plano->nome;
	}

	public function getData() {
		return ( $this->attributes['data'] != null ) ? DataHelper::getPrettyDate( $this->attributes['data'] ) : null;
	}

	public function getValor() {
		return ( $this->attributes['valor'] != null ) ? DataHelper::getFloat2RealMoney( $this->attributes['valor'] ) : null;
	}

	public function setDataAttribute( $value ) {
		$this->attributes['data'] = DataHelper::setDate( $value );
	}

	public function setValorAttribute( $value ) {
		$this->attributes['valor'] = DataHelper::getReal2Float( $value );
	}

	// ******************** BELONGSTO ****************************
	public function plano() {
		return $this->belongsTo( 'App\Plano', 'idplano' );
	}
//    public function paciente()
//    {
//        return $this->belongsTo('App\Paciente', 'idpaciente');
//    }
//    public function profissional()
//    {
//        return $this->belongsTo('App\Profissional', 'idprofissional');
//    }
}
