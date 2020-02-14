<?php

namespace App\Http\Controllers;

use App\TipoPagamento;
use Validator;
use Illuminate\Http\Request;

class CaixaController extends Controller {
	protected $Page;

	public function __construct() {
		$this->Page = (object) [
			'link'    => 'caixas',
			'Targets' => 'Caixas',
			'Target'  => 'Caixa',
			'Titulo'  => 'Caixa',
			'funcao'  => 'index'
		];
	}

	public function create() {
		$this->Page->Titulo = "Cadastro de Caixas";
		$this->Page->funcao = "create";

		return view( 'pages.ajustes.' . $this->Page->link . '.master' )
			->with( 'Page', $this->Page );
	}

	public function store( Request $request ) {
		$validator = Validator::make( $request->all(), [
			'nome' => 'required|unique:tipo_pagamento',
		] );
		if ( $validator->fails() ) {
			return redirect( $this->Page->link . '.create' )
				->withErrors( $validator )
				->withInput();
		} else {
			//store TipoPagamento
			$data = TipoPagamento::create( $request->all() );
			session()->forget( 'mensagem' );
			session( [ 'mensagem' => $this->Page->Target . ' adicionado com sucesso!' ] );

			return $this->index( $request );
		}
	}

	public function index( Request $request ) {
		$this->Page->Titulo = "Busca de Caixas";
		if ( isset( $request['busca'] ) ) {
			$busca  = $request['busca'];
			$Caixas = TipoPagamento::where( 'nome', 'like', '%' . $busca . '%' )
			                       ->orderBy( 'nome', 'ASC' )
			                       ->paginate( 10 );
		} else {
			$Caixas = TipoPagamento::orderBy( 'nome', 'ASC' )->paginate( 10 );
		}

		return view( 'pages.ajustes.' . $this->Page->link . '.index' )
			->with( 'Buscas', $Caixas )
			->with( 'Page', $this->Page );
	}

	public function update( Request $request, $id ) {

		$tipo_pagamento = TipoPagamento::find( $id );
		$validator      = Validator::make( $request->all(), [
			'nome' => 'required|unique:tipo_pagamento,nome,' . $id . ',idtipo_pagamento'
		] );
		if ( $validator->fails() ) {
			return redirect( $this->Page->link . '/' . $tipo_pagamento->idtipo_pagamento . '/edit' )
				->withErrors( $validator )
				->withInput();
		} else {
			//store tipo_pagamento
			$tipo_pagamento->update( $request->all() );

			session()->forget( 'mensagem' );
			session( [ 'mensagem' => $this->Page->Target . ' atualizado com sucesso!' ] );

			return $this->index( $request );
		}
	}

	public function destroy( $id ) {
		$data = TipoPagamento::find( $id );
		$data->delete();

		return response()->json( [
			'status'   => '1',
			'response' => 'Removido com sucesso'
		] );
	}
}
