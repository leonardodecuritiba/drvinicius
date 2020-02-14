<?php

namespace App;

use App\Helpers\DataHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model {
	protected $table = 'consulta';
	protected $primaryKey = 'idconsulta';
	protected $fillable = [
		'idprofissional_criador',
		'idprofissional',
		'idpaciente',
		'data_consulta',
		'dia_inteiro',
		'hora_inicio',
		'hora_termino',
		'observacao',
		'tipo_consulta',
		'nome',
		'telefone'
	];

	// ******************** FUNCTIONS ****************************
	static public function getProximaConsulta() {
		return self::where( 'data_consulta', Carbon::now()->format( 'Y-m-d' ) )->
		where( 'hora_inicio', '>', Carbon::now()->format( 'H:i' ) )->first();
	}

	static public function getConsultasDoDia() {
		return self::where( 'data_consulta', Carbon::now()->format( 'Y-m-d' ) )->get();
	}

	public function getNome() {
		return ( $this->idpaciente == null ) ? $this->nome : $this->paciente->nome;
	}

	public function getTelefone() {
		return ( $this->idpaciente == null ) ? DataHelper::mask( $this->telefone, '(##) ####-####' ) : $this->paciente->contato->telefone;
	}

	public function data_consulta_inicio() {
		$date = $this->data_consulta_inicio_date();

		return ( $date != null ) ? DataHelper::getPrettyDateTime( $date ) : 'Dia inteiro';
	}

	public function data_consulta_inicio_date() {
		return ( ! $this->attributes['dia_inteiro'] ) ? ( $this->attributes['data_consulta'] . ' ' . $this->attributes['hora_inicio'] . ':00' ) : null;
	}

	public function data_consulta_termino() {
//        $data_consulta = Carbon::createFromFormat('d/m/Y', $this->attributes['data_consulta'])->format('Y-m-d');
		return $this->attributes['data_consulta'] . ' ' . $this->attributes['hora_termino'] . ':00';
	}

	public function getDataConsultaAttribute( $value ) {
		if ( $value != null && $value != 0 ) {
			return Carbon::createFromFormat( 'Y-m-d', $value )->format( 'd/m/Y' );
		} else {
			return $value;
		}
	}

	public function setDataConsultaAttribute( $value ) {
		if ( $value != null && $value != 0 ) {
			$this->attributes['data_consulta'] = Carbon::createFromFormat( 'd/m/Y', $value )->format( 'Y-m-d' );
		} else {
			$this->attributes['data_consulta'] = $value;
		}
	}
	/*
		public function getHoraInicioAttribute($value)
		{
			if($value != NULL && $value != 0)
				return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
			else
				return $value;
		}
		public function getHoraTerminoAttribute($value)
		{
			if($value != NULL && $value != 0)
				return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
			else
				return $value;
		}
	*/
	// ******************** BELONGSTO ****************************
	// Relação profissional - 1 <-> N - consulta (CRIAÇÃO)
	public function profissional_criador() {
		return $this->belongsTo( 'App\Profissional', 'idprofissional_criador', 'idprofissional' );
	}

	// Relação profissional - 1 <-> N - consulta.
	public function profissional() {
		return $this->belongsTo( 'App\Profissional', 'idprofissional', 'idprofissional' );
	}

	// Relação paciente - 1 <-> N - consulta.
	public function paciente() {
		return $this->belongsTo( 'App\Paciente', 'idpaciente' );
	}
}
