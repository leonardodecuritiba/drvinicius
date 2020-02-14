<?php

namespace App;

use App\Helpers\DataHelper;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model {
	public $timestamps = true;
	protected $table = 'contato';
	protected $primaryKey = 'idcontato';
	protected $fillable = [
		'email',
		'telefone',
		'celular',
		'comercial',
		'cep',
		'estado',
		'cidade',
		'bairro',
		'logradouro',
		'complemento'
	];

	public function getTelefoneAttribute( $value ) {
		return DataHelper::mask( $value, '(##) ####-####' );
	}

	public function getCelularAttribute( $value ) {
		return DataHelper::mask( $value, '(##) #####-####' );
	}

	public function getCepAttribute( $value ) {
		return DataHelper::mask( $value, '#####-###' );
	}
	// ******************** HASMANY ******************************
	// Relação contato - 1 <-> N - profissional.
	public function getCidadeEstado() {
		$retorno = null;
		if ( $this->cidade != "" ) {
			$retorno[] = $this->cidade;
		}
		if ( $this->estado != "" ) {
			$retorno[] = $this->estado;
		}
		if ( count( $retorno ) > 1 ) {
			return implode( ', ', $retorno );
		}

		return $retorno[0];
	}

	public function getEnderecoCompleto() {
		$retorno = null;
		if ( $this->logradouro != "" ) {
			$retorno[] = $this->logradouro;
		}
		if ( $this->numero != "" ) {
			$retorno[] = $this->numero;
		}
		if ( $this->cidade != "" ) {
			$retorno[] = $this->cidade;
		}
		if ( $this->estado != "" ) {
			$retorno[] = $this->estado;
		}
		if ( count( $retorno ) > 1 ) {
			$retorno = implode( ', ', $retorno );
		} else if ( $retorno != null ) {
			$retorno = $retorno[0];
		}

		$fone = null;
		if ( $this->comercial != "" ) {
			$fone[] = $this->comercial;
		}
		if ( $this->telefone != "" ) {
			$fone[] = $this->telefone;
		}
		if ( $this->celular != "" ) {
			$fone[] = $this->celular;
		}
		if ( $this->celular != "" ) {
			$fone[] = $this->celular;
		}

		if ( count( $fone ) > 1 ) {
			$fone = ' / ' . implode( '- ', $fone );
		} else if ( $fone != null ) {
			$fone = ' / ' . $fone[0];
		}

		return $retorno . $fone;

	}

	public function profissional() {
		return $this->hasMany( 'App\Profissional', 'idprofissional' );
	}

	// Relação contato - 1 <-> N - paciente.
	public function paciente() {
		return $this->hasMany( 'App\Paciente', 'idpaciente' );
	}
}
