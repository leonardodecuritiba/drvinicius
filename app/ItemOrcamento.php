<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOrcamento extends Model {
	protected $table = 'item_orcamento';
	protected $primaryKey = 'iditem_orcamento';
	protected $fillable = [
		'idorcamento',
		'idintervencao',
		'regiao',
		'valor'
	];


	// ******************** FUNCTIONS ****************************
	public function getValorAttribute( $value ) {
		return number_format( $value, 2, ',', '.' );
	}
	// ******************** BELONGSTO ****************************
	// Relação item_orcamento - 1 <-> N - orcamento.
	public function orcamento() {
		return $this->belongsTo( 'App\Orcamento', 'idorcamento' );
	}

	// Relação item_orcamento - 1 <-> N - intervencao.
	public function intervencao() {
		return $this->belongsTo( 'App\Intervencao', 'idintervencao' );
	}
}
