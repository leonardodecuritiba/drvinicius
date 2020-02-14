<?php

namespace App;

use App\Helpers\DataHelper;
use App\Helpers\ImageHelper;
use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model {
	public $timestamps = true;
	protected $table = 'paciente';
	protected $primaryKey = 'idpaciente';
	protected $fillable = [
		'idplano',
		'idprofissional_criador',
		'idcontato',
		'nome',
		'cpf',
		'rg',
		'sexo',
		'data_nascimento',
		'foto'
	];

	// ******************** FUNCTIONS ****************************

	public function getEmail() {
		return ( $this->contato->email );
	}

	public function getFoto() {
		return ( $this->foto != null ) ? ImageHelper::getFullPath( 'pacientes' ) . $this->foto : asset( 'imgs/user.png' );
	}

	public function getThumbFoto() {
		return ( $this->foto != null ) ? ImageHelper::getFullThumbPath( 'pacientes' ) . $this->foto : asset( 'imgs/user.png' );
	}


	public function hasIdade() {
		$value = $this->attributes['data_nascimento'];
		if ( $value != null && $value != 0 ) {
			return 1;
		}

		return 0;
	}

	public function getIdade() {
		$value = $this->attributes['data_nascimento'];
		if ( $value != null && $value != 0 ) {
			$created = new Carbon( $this->attributes['data_nascimento'] );
			$idade   = $created->diffInYears( Carbon::now() );
		} else {
			$idade = null;
		}

		return $idade;
	}

	public function getCreatedAtAttribute( $value ) {
		return DataHelper::getPrettyDateTime( $value );
	}

	public function getDataNascimentoAttribute( $value ) {
		return DataHelper::getPrettyDate( $value );
	}

	public function setDataNascimentoAttribute( $value ) {
		$this->attributes['data_nascimento'] = DataHelper::setDate( $value );
	}

	public function getCpfAttribute( $value ) {
		return ( $value != '' ) ? DataHelper::mask( $value, '###.###.###-##' ) : $value;
	}

	// ******************** BELONGSTO ****************************
	// Relação plano - 1 <-> N - paciente.
	public function plano() {
		return $this->belongsTo( 'App\Plano', 'idplano' );
	}

	// Relação profissional - 1 <-> N - paciente (CRIAÇÃO).
	public function profissional_criador() {
		return $this->belongsTo( 'App\Profissional', 'idprofissional_criador', 'idprofissional' );
	}

	// Relação contato - 1 <-> N - paciente.
	public function contato() {
		return $this->belongsTo( 'App\Contato', 'idcontato' );
	}

	// ******************** HASMANY ****************************
	// Relação paciente - 1 <-> N - retornos.

	public function getLastRetorno() {
		return $this->retornos()->first();
	}

	public function retornos() {
		return $this->hasMany( 'App\Retorno', 'idpaciente' )->where( 'data_retorno', '>', Carbon::now()->format( 'Y-m-d' ) );
	}

	public function has_retorno() {
		return ( $this->retornos()->count() > 0 ) ? 1 : 0;
	}

	public function retornos_todos() {
		return $this->hasMany( 'App\Retorno', 'idpaciente' );
	}

	public function has_documentos() {
		return $this->documentos()->count();
	}

	public function documentos() {
		return $this->hasMany( 'App\PacienteDocumentos', 'idpaciente' );
	}

	public function has_images() {
		return $this->images()->count();
	}

	public function images() {
		return $this->hasMany( 'App\PacienteImages', 'idpaciente' );
	}

	public function total_pendente( $float = false ) {
		$total = Parcela::getFromPagamento( $this->pagamentos->pluck( 'idpagamento' ) )->sum( 'total_pendente' );

		return ( $float ) ? $total : DataHelper::getFloat2RealMoney( $total );
	}

	public function total_recebido( $float = false ) {
		$total = Parcela::getFromPagamento( $this->pagamentos->pluck( 'idpagamento' ) )->sum( 'total_pago' );

		return ( $float ) ? $total : DataHelper::getFloat2RealMoney( $total );
	}

	public function totais_valores( $float = false ) {
		//<?php $valores = $orcamento->pagamento->valores_total_parcelas();

		dd( $this->pagamentos() );
		$pagamentos = $this->pagamentos;
		if ( $this->pagamentos->count() > 0 ) {
			$valores = [
				'valor_pendente' => 0,
				'valor_pago'     => 0,
			];


			foreach ( $pagamentos as $pagamento ) {
				$parcelas                  = $pagamento->parcelas_json();
				$valores['valor_pendente'] += $parcelas->sum( 'valor_pendente_float' );
				$valores['valor_pago']     += $parcelas->sum( 'valor_pago_float' );
			}
			foreach ( $valores as $key => $valor ) {
				$valores[ $key ] = DataHelper::getFloat2RealMoney( $valor );
			}

		} else {
			$valores = 0;
		}
		if ( $float ) {
			return $valores;
		}

		return $valores;
	}

	// Relação paciente - 1 <-> N - consultas.

	public function pagamentos() {
		return $this->hasMany( 'App\Pagamento', 'idpaciente' );
	}

	public function consultas() {
		return $this->hasMany( 'App\Consulta', 'idpaciente' );
	}

	public function orcamentos() {
		return $this->hasMany( 'App\Orcamento', 'idpaciente' )->orderBy( 'aprovacao', 'DESC' );
	}

	public function respostas() {
		return $this->hasMany( 'App\Resposta', 'idpaciente' );
	}

	public function evolucoes() {
		return $this->hasMany( 'App\Evolucao', 'idpaciente' )->orderBy( 'data_evolucao', 'desc' );
	}

	public function orcamentos_abertos() {
		return $this->hasMany( 'App\Orcamento', 'idpaciente' )->where( 'aprovacao', 0 )->orderBy( 'aprovacao', 'DESC' );
	}

	public function has_pagamentos() {
		return ( $this->hasMany( 'App\Orcamento', 'idpaciente' )->where( 'aprovacao', 1 )->count() > 0 ) ? 1 : 0;
	}

	public function orcamentos_pagamento() {
		return $this->hasMany( 'App\Orcamento', 'idpaciente' )->where( 'aprovacao', 1 );
	}

	public function respostas_anamnse( $idanamnese ) {
		$ids = Pergunta::where( 'idanamnese', $idanamnese )->pluck( 'idpergunta' );

		return $this->hasMany( 'App\Resposta', 'idpaciente' )->whereIn( 'idpergunta', $ids )->with( 'pergunta' )->get();
	}

	// Relação paciente - 1 <-> N - evolucoes.
	public function has_evolucao() {
		return ( $this->evolucoes->count() > 0 );
	}

	public function getLastEvolucao() {
		return $this->evolucoes->first();
	}
}
