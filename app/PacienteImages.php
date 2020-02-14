<?php

namespace App;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Model;

class PacienteImages extends Model {
	const DEFAULT_PATH = 'paciente_images';
	protected $fillable = [
		'idprofissional_criador',
		'idpaciente',
		'titulo',
		'descricao',
		'link'
	];

	// ******************** FUNCTIONS ****************************
	public function getLink() {
		return asset( 'uploads/' . self::DEFAULT_PATH . '/' . $this->attributes['link'] );
	}

	public function getDocumentoThumb() {
		return ImageHelper::getFullPath( self::DEFAULT_PATH ) . $this->attributes['link'];
	}
	// ******************** BELONGSTO ****************************
	// Relação orcamento - 1 <-> 1 - pagamento.
	public function paciente() {
		return $this->belongsTo( 'App\Paciente', 'idpaciente' );
	}

	public function profissional_criador() {
		return $this->belongsTo( 'App\Profissional', 'idprofissional_criador', 'idprofissional' );
	}

	// ******************** HASMANY ****************************
	// Relação pagamento - 1 <-> N - parcela.
}
