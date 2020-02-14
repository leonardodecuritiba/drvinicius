<?php

namespace App;

use App\Helpers\DataHelper;
use Illuminate\Database\Eloquent\Model;

class Impresso extends Model {
	protected $table = 'impressos';
	protected $primaryKey = 'id';
	protected $fillable = [
		'idprofissional_criador',
		'documento'
	];

	public function getCreatedAtAttribute( $value ) {
		return DataHelper::getPrettyDateTime( $value );
	}

	public function profissional() {
		return $this->belongsTo( 'App\Profissional', 'idprofissional_criador', 'idprofissional' );
	}

}
