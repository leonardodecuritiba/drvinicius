<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();
//Route::get('login', 'MasterController@login');
Route::group( [ 'middleware' => 'auth' ], function () {
	Route::get( '/', 'MasterController@home' );
	Route::get( 'home', 'MasterController@home' );
	Route::get( 'agenda', 'MasterController@agenda' );

//Financeiro
	Route::get( 'editar_perfil', 'MasterController@editar_perfil' );
	Route::get( 'clinica', 'MasterController@clinica' )->name( 'clinica' );
	Route::post( 'clinica/store', 'MasterController@clinica_store' )->name( 'clinica.store' );
	Route::post( 'clinica/{idclinica}/update', 'MasterController@clinica_update' )->name( 'clinica.update' );

//Financeiro
	Route::get( 'recebimentos', 'MasterController@recebimentos' )->name( 'recebimentos' );
	Route::get( 'recebimentos/imprimir', 'MasterController@recebimentosExportar' )->name( 'recebimentos.imprimir' );
	Route::get( 'recibos', 'MasterController@recibos' )->name( 'recibos' );
	Route::get( 'recibos/cancelar/{id}', 'MasterController@recibosCancelar' )->name( 'recibos.cancelar' );
	Route::get( 'recibos/imprimir', 'MasterController@recibosExportar' )->name( 'recibos.imprimir' );

//Ajustes
	Route::resource( 'planos', 'PlanoController' );
	Route::resource( 'plano_intervencao', 'PlanoIntervencaoController' );
	Route::resource( 'intervencoes', 'IntervencaoController' );
	Route::resource( 'caixas', 'CaixaController' );
	Route::resource( 'anamneses', 'AnamneseController' );
	Route::resource( 'perguntas', 'PerguntaController' );
	Route::resource( 'respostas', 'RespostaController' );
	Route::get( 'respostas/imprimir/{idpaciente},{idanamnese}', 'RespostaController@imprimir' )->name( 'anamnese.imprimir' );

	Route::resource( 'evolucoes', 'EvolucaoController' );
	Route::resource( 'retornos', 'RetornoController' );
	Route::resource( 'consultas', 'ConsultaController' );
	Route::post( 'consultas._update', 'ConsultaController@update' )->name( 'consultas._update' );
	Route::get( 'remove/consultas/{id}', 'ConsultaController@remove' )->name( 'consultas._remove' );
	Route::get( 'updateDateTime', 'ConsultaController@updateDateTime' );

	Route::resource( 'orcamentos', 'OrcamentoController' );
	Route::get( 'orcamento/aprovar/{idorcamento}', 'OrcamentoController@aprovar' )->name( 'orcamento.aprovar' );
	Route::get( 'remove/item_orcamento/{id}', 'OrcamentoController@destroy_item' )->name( 'item_orcamento.remove' );
	Route::get( 'orcamento/imprimir/{idorcamento}', 'OrcamentoController@imprimir' )->name( 'orcamento.imprimir' );
	Route::get( 'orcamento/enviar/{idorcamento}', 'OrcamentoController@sendByEmail' )->name( 'orcamento.enviar' );


	Route::post( 'receber/parcelas', 'PagamentoController@receber' )->name( 'parcelas.receber' );
	Route::post( 'alterar/parcelas', 'PagamentoController@alterarVencimento' )->name( 'parcelas.alterar_vencimento' );
//    Route::get('parcelas/estornar/{idparcela}', 'PagamentoController@estornar')->name('parcelas.estornar');

	Route::get( 'recebimento/estornar/{idparcela_pagamento}', 'PagamentoController@estornar' )->name( 'parcelas_pagamento.estornar' );
	Route::get( 'recebimento/imprimir/{idparcela_pagamento}', 'PagamentoController@imprimir' )->name( 'parcelas_pagamento.imprimir' );

	Route::get( 'json/parcelas-pagas/{idorcamento}', 'PagamentoController@parcelas_pagas' )->name( 'json.parcelas.pagas' );
	Route::get( 'json/parcelas-pendentes/{idorcamento}', 'PagamentoController@parcelas_pendentes' )->name( 'json.parcelas.pendentes' );


	Route::resource( 'pacientes', 'PacientesController' );
	Route::get( 'pacientes/{idparcela}/{tab}', 'PacientesController@show' )->name( 'pacientes.tab' );
	Route::post( 'documentos/pacientes/store', 'PacientesController@documentosStore' )->name( 'documentos.pacientes.store' );
	Route::delete( 'documentos/pacientes/destroy/{id}', 'PacientesController@documentosDestroy' )->name( 'documentos.pacientes.destroy' );
	Route::post( 'imagens/pacientes/store', 'PacientesController@imagensStore' )->name( 'imagens.pacientes.store' );
	Route::delete( 'imagens/pacientes/destroy/{id}', 'PacientesController@imagensDestroy' )->name( 'imagens.pacientes.destroy' );

	Route::get( 'alertas/{idpaciente}/pacientes', 'PacientesController@alertas_paciente' )->name( 'alertas.pacientes' );

	Route::resource( 'documentos', 'DocumentoController' );

	Route::resource( 'usuarios', 'UserController' );
	Route::post( 'pwd/{user}/usuarios', 'UserController@upd_pass' )->name( 'usuarios.upd_pass' );
	Route::get( 'active/{user}/ususuariosers', 'UserController@active' )->name( 'usuarios.active' );
	Route::get( 'destroy/{user}/usuarios', 'UserController@destroy' )->name( 'usuarios.destroy' );

	Route::get( 'imprimir/pagamento/{id}', 'PagamentoController@imprimir' )->name( 'pagamento.imprimir' );
	Route::get( 'imprimir/prontuario/{idpaciente}', 'PacientesController@imprimir' )->name( 'prontuario.imprimir' );


	Route::get( 'listar-backups', 'MasterController@backups' )->name( 'backups.index' );
	Route::get( 'function-backups/{option}', 'MasterController@functionBackup' )->name( 'backups.function' );
	Route::get( 'destroy-backups/{name}', 'MasterController@destroyBackup' )->name( 'backups.destroy' );


	Route::delete( 'pagamento/{id}', 'PagamentoController@destroy' )->name( 'pagamento.destroy' );
//Impressoes
//    Route::get('impressoes/imagem-orcamento', 'ImpressoesController@impressao_orcamento')->name('impressoes.imagem_orcamento');

	Route::resource( 'uploads_docs', 'UploadController' );


	Route::resource( 'cheques', 'ChequeController' );
	Route::get( 'imprimir/cheques', 'ChequeController@exportar' )->name( 'cheques.imprimir' );

	//valores
	Route::resource( 'valores', 'ValoresController' );
	Route::get( '{tipo}/valores', 'ValoresController@index' )->name( 'valores.index' );
	Route::get( '{tipo}/valores/create', 'ValoresController@create' )->name( 'valores.create' );
	Route::get( 'imprimir/{tipo}/valores', 'ValoresController@exportar' )->name( 'valores.imprimir' );

	Route::get( 'backupdatabase', function () {
		set_time_limit( 0 );
//        return Artisan::call('backup:list');
		Artisan::call( 'backup:run' );
	} );

	Route::get( 'ajax', 'AjaxController@ajax' );
	Route::get( 'total-paciente/{id}', function ( $id ) {
		return \App\Paciente::find( $id )->total_pentente();
//
//        $data = [
//            'foo' => 'bar'
//        ];
//        $pdf = \niklasravnsborg\LaravelPdf\Facades\Pdf::loadView('print.print', $data);
//        return $pdf->download('document.pdf');

//        $pdf = App::make('dompdf.wrapper');
//        $pdf->loadHTML('<h1>Test</h1>');
//        return $pdf->stream();
	} );

	/*---- teste email ----*/
	Route::get( 'sendemail', function () {

		$user = array(
			'email'    => "silva.zanin@gmail.com",
			'name'     => "LEO",
			'mensagem' => "olá",
		);

		Mail::raw( $user['mensagem'], function ( $message ) use ( $user ) {
			$message->to( $user['email'], $user['name'] )->subject( 'Welcome!' );
			$message->from( 'sac@restaurantesopeixe.com.br', 'Atendimento SÓPEIXE' );
		} );

		return "Your email has been sent successfully";

	} );

} );