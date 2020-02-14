<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model {
	protected $table = 'pergunta';
	protected $primaryKey = 'idpergunta';
	protected $fillable = [
		'idanamnese',
		'numero_ordem',
		'tipo_pergunta',
		'tipo_resposta',
		'texto_pergunta',
		'msg_alerta'
	];

	// ******************** FUNCTIONS ****************************
	public function getCreatedAtAttribute( $value ) {
		if ( $value != null ) {
			return Carbon::createFromFormat( 'Y-m-d H:i:s', $value )->format( 'd/m/Y H:i' );
		}
	}

	public function traduzTipoPergunta() {
		switch ( $this->attributes['tipo_pergunta'] ) {
			case 0:
				$value = 'Não crítica';
				break;
			case 1:
				$value = 'Crítica para SIM';
				break;
			case 2:
				$value = 'Crítica para NÃO';
				break;
		}

		return $value;
	}

	public function traduzTipoResposta() {
		switch ( $this->attributes['tipo_resposta'] ) {
			case 0:
				$value = 'SIM/NÃO/NÃO SEI';
				break;
			case 1:
				$value = 'SIM/NÃO/NÃO SEI e texto';
				break;
			case 2:
				$value = 'Apenas texto';
				break;
		}

		return $value;
	}

	// ******************** BELONGSTO ****************************
	// Relação profissional - 1 <-> N - anamnese.
	public function anamnese() {
		return $this->belongsTo( 'App\Anamnese', 'idanamnese' );
	}
	// ******************** HASMANY ****************************
	// Relação pergunta - 1 <-> N - resposta.
	public function has_resposta( $idpaciente ) {
		return $this->hasMany( 'App\Resposta', 'idpergunta' )->where( 'idpaciente', $idpaciente )->count();
	}

	public function resposta( $idpaciente ) {
		return $this->hasMany( 'App\Resposta', 'idpergunta' )->where( 'idpaciente', $idpaciente )->first();
	}
}
