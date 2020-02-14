<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValoresTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'valores', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->boolean( 'tipo' );
			$table->date( 'data' );
			$table->string( 'fonte', 100 );
			$table->string( 'documento', 30 );
			$table->decimal( 'valor', 10, 2 );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop( 'valores' );
	}
}
