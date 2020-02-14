<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Intervencao extends Model {
	protected $table = 'intervencao';
	protected $primaryKey = 'idintervencao';
	protected $fillable = [
		'codigo',
		'nome',
		'regiao',
		'valor'
	];

	// ******************** FUNCTIONS ****************************
	public function getCreatedAtAttribute( $value ) {
		if ( $value != null ) {
			return Carbon::createFromFormat( 'Y-m-d H:i:s', $value )->format( 'd/m/Y H:i' );
		}
	}

	public function getValorAttribute( $value ) {
		return number_format( $value, 2, ',', '.' );
	}

	public function getValorFloat() {
		return $this->attributes['valor'];
	}

	public function setValorAttribute( $value ) {
		$value                     = str_replace( '.', '', $value );
		$this->attributes['valor'] = floatval( str_replace( ',', '.', $value ) );
	}

	// ******************** HASMANY ******************************
	// Relação intervencao - 1 <-> N - plano_intervencao.
	public function plano_intervencao() {
		return $this->hasMany( 'App\PlanoIntervencao', 'idplano_intervencao' );
	}

	// Relação intervencao - 1 <-> N - item_orcamento.
	public function item_orcamento() {
		return $this->hasMany( 'App\ItemOrcamento', 'iditem_orcamento' );
	}
}
