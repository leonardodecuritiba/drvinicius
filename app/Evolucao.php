<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Evolucao extends Model {
	protected $table = 'evolucao';
	protected $primaryKey = 'idevolucao';
	protected $fillable = [
		'idprofissional_criador',
		'idpaciente',
		'data_evolucao',
		'texto'
	];

	// ******************** FUNCTIONS ****************************
	public function getDataEvolucaoAttribute( $value ) {
		if ( $value != null ) {
			return Carbon::createFromFormat( 'Y-m-d', $value )->format( 'd/m/Y' );
		}
	}

	public function setDataEvolucaoAttribute( $value ) {
		if ( $value != null ) {
			$this->attributes['data_evolucao'] = Carbon::createFromFormat( 'd/m/Y', $value )->format( 'Y-m-d' );
		}
	}
	// ******************** BELONGSTO ****************************
	// Relação pergunta - 1 <-> N - profissional. (CRIAÇÃO)
	public function profissional_criador() {
		return $this->belongsTo( 'App\Profissional', 'idprofissional_criador', 'idprofissional' );
	}

	// Relação paciente - 1 <-> N - retorno.
	public function paciente() {
		return $this->belongsTo( 'App\Paciente', 'idpaciente' );
	}
}
