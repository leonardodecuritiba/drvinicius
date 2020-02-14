<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Retorno extends Model {
	protected $table = 'retorno';
	protected $primaryKey = 'idretorno';
	protected $fillable = [
		'idprofissional_criador',
		'idprofissional',
		'idpaciente',
		'data_retorno',
		'motivo_retorno',
		'observacao'
	];


	// ******************** FUNCTIONS ****************************

	public function scopeProximos( $query ) {
		return $query->where( 'data_retorno', '>', Carbon::now() );;
	}

	public function getNome() {
		return $this->paciente->nome;
	}

	public function getTelefone() {
		return $this->paciente->contato->telefone;
	}

	public function data_retorno_date() {
		return ( $this->attributes['data_retorno'] );
	}

	public function getDataRetornoAttribute( $value ) {
		if ( $value != null && $value != 0 ) {
			return Carbon::createFromFormat( 'Y-m-d', $value )->format( 'd/m/Y' );
		} else {
			return $value;
		}
	}

	public function setDataRetornoAttribute( $value ) {
		if ( $value != null && $value != 0 ) {
			$this->attributes['data_retorno'] = Carbon::createFromFormat( 'd/m/Y', $value )->format( 'Y-m-d' );
		}
	}
	// ******************** BELONGSTO ****************************
	// Relação pergunta - 1 <-> N - profissional. (CRIAÇÃO)
	public function profissional_criador() {
		return $this->belongsTo( 'App\Profissional', 'idprofissional_criador', 'idprofissional' );
	}

	// Relação pergunta - 1 <-> N - profissional.
	public function profissional() {
		return $this->belongsTo( 'App\Profissional', 'idprofissional' );
	}

	// Relação paciente - 1 <-> N - retorno.
	public function paciente() {
		return $this->belongsTo( 'App\Paciente', 'idpaciente' );
	}
}
