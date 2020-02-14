<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImpressosTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'impressos', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'idprofissional_criador' )->unsigned();
			$table->string( 'documento', 100 );

			$table->foreign( 'idprofissional_criador' )->references( 'idprofissional' )->on( 'profissional' );
			$table->timestamps();
			$table->softDeletes();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop( 'impressos' );
	}
}
