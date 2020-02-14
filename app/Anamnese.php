<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Anamnese extends Model {
	protected $table = 'anamnese';
	protected $primaryKey = 'idanamnese';
	protected $fillable = [
		'idprofissional_criador',
		'nome',
	];

	// ******************** FUNCTIONS ****************************
	public function getCreatedAtAttribute( $value ) {
		if ( $value != null ) {
			return Carbon::createFromFormat( 'Y-m-d H:i:s', $value )->format( 'd/m/Y à\s H:i' );
		}
	}

	// ******************** BELONGSTO ****************************
	// Relação profissional - 1 <-> N - anamnese.
	public function criador() {
		return $this->belongsTo( 'App\Profissional', 'idprofissional_criador', 'idprofissional' );
	}

	// ******************** HASMANY ******************************
	// Relação anamnese - 1 <-> N - pergunta.
	public function perguntas() {
		return $this->hasMany( 'App\Pergunta', 'idanamnese' );
	}
}
