<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'uploads', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->unsignedInteger( 'idprofissional_criador' );
			$table->string( 'nome', 50 );
			$table->string( 'descricao', 100 );
			$table->string( 'link', 100 );

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
		Schema::drop( 'uploads' );
	}
}
