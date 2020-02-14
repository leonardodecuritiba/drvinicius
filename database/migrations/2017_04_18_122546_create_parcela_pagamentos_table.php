<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParcelaPagamentosTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'parcela_pagamentos', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->integer( 'idparcela' )->unsigned();
			$table->foreign( 'idparcela' )->references( 'idparcela' )->on( 'parcela' )
			      ->onDelete( 'cascade' );
			$table->integer( 'idtipo_pagamento' )->unsigned()->nullable();
			$table->foreign( 'idtipo_pagamento' )->references( 'idtipo_pagamento' )->on( 'tipo_pagamento' )
			      ->onDelete( 'cascade' );

			$table->date( 'data_pagamento' );
			$table->decimal( 'valor', 10, 2 );
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
		Schema::drop( 'parcela_pagamentos' );
	}
}
