<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model {
	protected $table = 'resposta';
	protected $primaryKey = 'idresposta';
	protected $fillable = [
		'idpergunta',
		'idpaciente',
		'resposta',
		'texto_resposta'
	];

	// ******************** BELONGSTO ****************************
	// Relação pergunta - 1 <-> N - resposta.
	public function pergunta() {
		return $this->belongsTo( 'App\Pergunta', 'idpergunta' );
	}

	// Relação paciente - 1 <-> N - resposta.
	public function paciente() {
		return $this->belongsTo( 'App\Paciente', 'idpaciente' );
	}

	public function insert_or_update( $params ) {
		return $this->belongsTo( 'App\Paciente', 'idpaciente' );
	}

	public function ver_resposta() {

		switch ( $this->pergunta->tipo_resposta ) {
			case 0:
				$resposta = $this->get_resposta();
				break;
			case 1:
				$resposta = ( $this->texto_resposta != '' ) ? $this->get_resposta() . '; ' . $this->texto_resposta : $this->get_resposta();
				break;
			case 2:
				$resposta = $this->texto_resposta;
				break;

		}

		return $resposta;

//        $this->tipo_perguntas = (object)[
//            '0' => 'Não crítica',
//            '1' => 'Crítica para SIM',
//            '2' => 'Crítica para NÃO'];
//        $this->tipo_respostas = (object)[
//            '0' => 'SIM/NÃO/NÃO SEI',
//            '1' => 'SIM/NÃO/NÃO SEI e texto',
//            '2' => 'Apenas texto'];
	}

	public function get_resposta() {
		switch ( $this->attributes['resposta'] ) {
			case 0:
				$resposta = 'Não';
				break;
			case 1:
				$resposta = 'Sim';
				break;
			case 2:
				$resposta = 'Não sei';
				break;
		}

		return $resposta;
	}


}
