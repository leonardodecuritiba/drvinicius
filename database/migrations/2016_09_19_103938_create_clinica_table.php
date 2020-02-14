<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicaTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'clinica', function ( Blueprint $table ) {
			$table->increments( 'idclinica' );
			$table->unsignedInteger( 'idresponsavel' );
			$table->unsignedInteger( 'idcontato' );
			$table->string( 'nome', 100 )->unique();
			$table->string( 'email', 100 )->unique();
			$table->string( 'foto', 100 );
			$table->string( 'cnpj' )->nullable();

			$table->foreign( 'idresponsavel' )->references( 'idprofissional' )->on( 'profissional' );
			$table->foreign( 'idcontato' )->references( 'idcontato' )->on( 'contato' );
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
		Schema::drop( 'clinica' );
	}
}
