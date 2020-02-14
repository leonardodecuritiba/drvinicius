<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TipoPagamento extends Model {
	protected $table = 'tipo_pagamento';
	protected $primaryKey = 'idtipo_pagamento';
	protected $fillable = [
		'nome',
	];

	// ******************** FUNCTIONS ****************************
	public function getCreatedAtAttribute( $value ) {
		if ( $value != null ) {
			return Carbon::createFromFormat( 'Y-m-d H:i:s', $value )->format( 'd/m/Y à\s H:i' );
		}
	}
	// ******************** HASMANY ****************************
	// Relação tipo_pagamento - 1 <-> N - parcela.
	public function parcelas() {
		return $this->hasMany( 'App\Parcela', 'idparcela' );
	}
}
