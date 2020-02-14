<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanoIntervencao extends Model {
	protected $table = 'plano_intervencao';
	protected $primaryKey = 'idplano_intervencao';
	protected $fillable = [
		'idintervencao',
		'idplano',
		'valor_plano',
//        'valor_paciente'
	];

	// ******************** FUNCTIONS ****************************
	public function getCreatedAtAttribute( $value ) {
		if ( $value != null ) {
			return Carbon::createFromFormat( 'Y-m-d H:i:s', $value )->format( 'd/m/Y H:i' );
		}
	}

	public function getValorPlanoAttribute( $value ) {
		return number_format( $value, 2, ',', '.' );
	}

	public function setValorPlanoAttribute( $value ) {
		$value                           = str_replace( '.', '', $value );
		$this->attributes['valor_plano'] = floatval( str_replace( ',', '.', $value ) );
	}
	/*
	public function getValorPacienteAttribute($value)
	{
		return number_format($value,2,',','.');
	}
	public function setValorPacienteAttribute($value)
	{
		$value = str_replace('.','',$value);
		$this->attributes['valor_paciente'] = floatval(str_replace(',','.',$value));
	}
	*/

	// ******************** BELONGSTO ****************************
	// Relação plano - 1 <-> N - plano_intervencao.
	public function plano() {
		return $this->belongsTo( 'App\Plano', 'idplano' );
	}

	// Relação intervencao - 1 <-> N - plano_intervencao.
	public function intervencao() {
		return $this->belongsTo( 'App\Intervencao', 'idintervencao' );
	}
}
