<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model {
	protected $fillable = [
		'idprofissional_criador',
		'nome',
		'descricao',
		'link'
	];

	// ******************** FUNCTIONS ****************************
	public function getLink() {
		return asset( 'uploads/documentos/' . $this->attributes['link'] );
	}
	// ******************** BELONGSTO ****************************
	// Relação orcamento - 1 <-> 1 - pagamento.
	public function profissional_criador() {
		return $this->belongsTo( 'App\Profissional', 'idprofissional_criador', 'idprofissional' );
	}

	// ******************** HASMANY ****************************
	// Relação pagamento - 1 <-> N - parcela.
}
