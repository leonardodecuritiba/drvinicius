<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Profissional extends Model {
	use SoftDeletes;
	protected $table = 'profissional';
	protected $primaryKey = 'idprofissional';
	protected $fillable = [
		'idusers',
		'idcontato',
		'nome',
		'cpf',
		'cro',
		'foto',
	];

	public function scopeProfissionais( $query ) {
		return $query->whereIn( 'idusers',
			User::whereHas( 'roles', function ( $query ) {
				$query->where( 'name', 'profissional' )
				      ->orWhere( 'name', 'dentista' );
			} )->pluck( 'idusers' )
		)->get();
	}

	public function get_status() {
		return ( $this->attributes['deleted_at'] == null ) ? 1 : 0;
	}

	public function get_text_status() {
		return ( $this->attributes['deleted_at'] == null ) ? 'Ativo' : 'Inativo';
	}

	// ******************** BELONGSTO ****************************
	// Relação contato - 1 <-> N - profissional.
	public function contato() {
		return $this->belongsTo( 'App\Contato', 'idcontato' );
	}

	// Relação profissional - 1 <-> 1 - user.
	public function user() {
		return $this->belongsTo( 'App\User', 'idusers' );
	}

	// ******************** HASMANY ****************************
	// Relação profissional - 1 <-> N - anamnese.
	public function anamnese() {
		return $this->hasMany( 'App\Anamnese', 'idanamnese' );
	}

	// Relação profissional - 1 <-> N - orcamento.
	public function orcamento() {
		return $this->hasMany( 'App\Orcamento', 'idorcamento' );
	}

	// Relação profissional - 1 <-> N - paciente.
	public function paciente() {
		return $this->hasMany( 'App\Paciente', 'idpaciente' );
	}

	// Relação profissional - 1 <-> N - retorno.
	public function retorno() {
		return $this->hasMany( 'App\Retorno', 'idretorno' );
	}

	// Relação profissional - 1 <-> N - consulta.
	public function consulta() {
		return $this->hasMany( 'App\Consulta', 'idconsulta' );
	}
}
