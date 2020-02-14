<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChequesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'cheques', function ( Blueprint $table ) {
			$table->increments( 'id' );
//            $table->unsignedInteger('idpaciente');
//            $table->foreign('idpaciente')->references('idpaciente')->on('paciente')
//                ->onDelete('cascade');
//            $table->unsignedInteger('idprofissional');
//            $table->foreign('idprofissional')->references('idprofissional')->on('profissional')
//                ->onDelete('cascade');

			$table->unsignedInteger( 'idplano' );
			$table->foreign( 'idplano' )->references( 'idplano' )->on( 'plano' )
			      ->onDelete( 'cascade' );
			$table->string( 'nome', 100 );
			$table->date( 'data' );
			$table->decimal( 'valor', 10, 2 );
			$table->string( 'banco', 50 );
			$table->string( 'numeracao', 100 );
			$table->string( 'destino', 100 );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop( 'cheques' );
	}
}
