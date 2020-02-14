<?php

namespace App\Http\Controllers;

use App\Intervencao;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

class IntervencaoController extends Controller {
	protected $Page;

	public function __construct() {
		$this->Page = (object) [
			'link'    => 'intervencoes',
			'Targets' => 'Intervenções',
			'Target'  => 'Intervenção',
			'Titulo'  => 'Intervenções',
			'funcao'  => 'index'
		];
	}

	public function index( Request $request ) {
		$this->Page->Titulo = "Busca de Intervenções";
		if ( isset( $request['busca'] ) ) {
			$busca  = $request['busca'];
			$Buscas = Intervencao::where( 'nome', 'like', '%' . $busca . '%' )
			                     ->orderBy( 'nome', 'ASC' )
			                     ->get();
		} else {
			$Buscas = Intervencao::orderBy( 'nome', 'ASC' )->get();
		}

		return view( 'pages.ajustes.' . $this->Page->link . '.index' )
			->with( 'Buscas', $Buscas )
			->with( 'Page', $this->Page );
	}

	public function create() {
		$this->Page->Titulo = "Cadastro de Intervenções";
		$this->Page->funcao = "create";

		return view( 'pages.ajustes.' . $this->Page->link . '.master' )
			->with( 'Page', $this->Page );
	}

	public function store( Request $request ) {
		$validator = Validator::make( $request->all(), [
			'nome'  => 'required|unique:intervencao',
			'valor' => 'required',
		] );
		if ( $validator->fails() ) {
			return redirect( $this->Page->link . '/create' )
				->withErrors( $validator )
				->withInput();
		} else {
			$Intervencao = Intervencao::create( $request->all() );
			session()->forget( 'mensagem' );
			session( [ 'mensagem' => $this->Page->Target . ' cadastrada!' ] );

			return $this->edit( $Intervencao->idintervencao );
		}
	}

	public function edit( $id ) {
		$Intervencao        = Intervencao::find( $id );
		$this->Page->Titulo = "Edição de Intervenção";
		$this->Page->funcao = "edit";

		return view( 'pages.ajustes.' . $this->Page->link . '.master' )
			->with( 'Intervencao', $Intervencao )
			->with( 'Page', $this->Page );
	}

	public function update( Request $request, $id ) {
		$data      = Intervencao::find( $id );
		$validator = Validator::make( $request->all(), [
			'nome'  => 'required|unique:intervencao,nome,' . $id . ',idintervencao',
			'valor' => 'required',
		] );

		if ( $validator->fails() ) {
			return redirect( $this->Page->link . '/' . $id . '/edit' )
				->withErrors( $validator )
				->withInput();
		} else {
			//atualizar intervencao
			$dataUpdate = $request->all();
			$data->update( $dataUpdate );
			session()->forget( 'mensagem' );
			session( [ 'mensagem' => $this->Page->Target . ' atualizada!' ] );

			return $this->edit( $id );
		}
	}

	public function destroy( $id ) {
		$data = Intervencao::find( $id );
		$data->delete();

		return response()->json( [
			'status'   => '1',
			'response' => 'Removido com sucesso'
		] );
	}
}
