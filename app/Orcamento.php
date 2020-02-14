<?php

namespace App;

use App\Helpers\DataHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model {
	protected $table = 'orcamento';
	protected $primaryKey = 'idorcamento';
	protected $fillable = [
		'idprofissional',
		'idpaciente',
		'descricao',
		'desconto',
		'numero_parcelas',
		'valor_entrada',
		'valor_total',
		'aprovacao'
	];

	public function aprovar() {
		return $this->update( [ 'aprovacao' => 1 ] );
	}

	public function desaprovar() {
		return $this->update( [ 'aprovacao' => 0 ] );
	}

	public function total_pago() {
		$pagamento = $this->pagamento;

		return ( $pagamento != null ) ? $pagamento->valores_total_parcelas()->valor_pago : DataHelper::getFloat2RealMoney( 0 );
	}

	public function total_pendente() {
		$pagamento = $this->pagamento;

		return ( $pagamento != null ) ? $pagamento->valores_total_parcelas()->valor_pendente : $this->valor_final_total();
	}

	// ******************** FUNCTIONS ****************************

	public function valor_final_total( $float = false ) {
		$total       = $this->attributes['valor_total'];
		$desconto    = $this->attributes['desconto'];
		$valor_final = $total - ( $total * $desconto / 100 );
		if ( $float ) {
			return $valor_final;
		}

		return DataHelper::getFloat2RealMoney( $valor_final );
	}

	public function getCreatedAtAttribute( $value ) {
		return ( $value != null ) ? Carbon::createFromFormat( 'Y-m-d H:i:s', $value )->format( 'd/m/Y H:i' ) : null;
	}

	public function getValorTotalAttribute( $value ) {
		return DataHelper::getFloat2RealMoney( $value );
	}

	public function getValorEntradaAttribute( $value ) {
		return DataHelper::getFloat2RealMoney( $value );
	}

	public function valor_entrada_float() {
		return $this->attributes['valor_entrada'];
	}

	public function setValorTotalAttribute( $value ) {
		$this->attributes['valor_total'] = DataHelper::getReal2Float( $value );
	}

	public function valor_desconto( $float = false ) {
		$total       = $this->attributes['valor_total'];
		$valor_final = ( $total * $this->attributes['desconto'] / 100 );
		if ( $float ) {
			return $valor_final;
		}

		return DataHelper::getFloat2RealMoney( $valor_final );
	}

	public function valor_parcelas( $float = false ) {
		$total           = $this->attributes['valor_total'];
		$desconto        = $this->attributes['desconto'];
		$total           = $total - ( $total * $desconto / 100 );
		$entrada         = $this->attributes['valor_entrada'];
		$numero_parcelas = $this->attributes['numero_parcelas'];
		$valor_final     = ( $total - $entrada ) / $numero_parcelas;
		if ( $float ) {
			return $valor_final;
		}

		return DataHelper::getFloat2RealMoney( $valor_final );
	}

	// ******************** BELONGSTO ****************************
	// Relação paciente - 1 <-> N - orcamento.
	public function paciente() {
		return $this->belongsTo( 'App\Paciente', 'idpaciente' );
	}

	// Relação profissional - 1 <-> N - orcamento.
	public function profissional() {
		return $this->belongsTo( 'App\Profissional', 'idprofissional' );
	}

	// ******************** HASMANY ******************************
	// Relação orcamento - 1 <-> N - item_orcamento.
	public function itens_orcamento() {
		return $this->hasMany( 'App\ItemOrcamento', 'idorcamento' );
	}

	public function remove_itens() {
		foreach ( $this->itens_orcamento as $item ) {
			$item->delete();
		}
	}

	// ******************** HASONE ******************************
	// Relação orcamento - 1 <-> 1 - pagamento.
	public function pagamento() {
		return $this->hasOne( 'App\Pagamento', 'idorcamento' );
	}
}
