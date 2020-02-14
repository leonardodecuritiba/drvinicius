<?php

namespace App\Http\Controllers;

use App\PlanoIntervencao;
use Validator;
use App\Plano;
use App\Intervencao;
use Illuminate\Http\Request;
use App\Http\Requests;

class PlanoController extends Controller {

	protected $Page;

	public function __construct() {
		$this->Page = (object) [
			'link'    => 'planos',
			'Targets' => 'Planos',
			'Target'  => 'Plano',
			'Titulo'  => 'Planos',
			'funcao'  => 'index'
		];
	}

	public function index( Request $request ) {
		$this->Page->Titulo = "Busca de Planos";
		if ( isset( $request['busca'] ) ) {
			$busca  = $request['busca'];
			$Planos = Plano::where( 'nome', 'like', '%' . $busca . '%' )
			               ->orderBy( 'nome', 'ASC' )
			               ->paginate( 10 );
		} else {
			$Planos = Plano::orderBy( 'nome', 'ASC' )->paginate( 10 );
		}

		return view( 'pages.ajustes.planos.index' )
			->with( 'Buscas', $Planos )
			->with( 'Page', $this->Page );
	}

	public function create() {
		$this->Page->Titulo = "Cadastro de Planos";
		$this->Page->funcao = "create";
		$Planos             = Plano::all();

		return view( 'pages.ajustes.planos.master' )
			->with( 'Planos', $Planos )
			->with( 'Page', $this->Page );
	}

	public function store( Request $request ) {
		$validator = Validator::make( $request->all(), [
			'nome' => 'required|unique:plano',
		] );
		if ( $validator->fails() ) {
			return redirect( $this->link . '/create' )
				->withErrors( $validator )
				->withInput();
		} else {
			//CRIAR plano
			$Plano = Plano::create( [
				'nome'         => $request['nome'],
				'plano_status' => 1,
			] );

			//atualizar plano_intervencao (fazer cópia)
			if ( $request['plano_padrao'] == '1' ) {
				$PlanoPadrao = Plano::find( $request['idplano'] );
				foreach ( $PlanoPadrao->plano_intervencao as $intervencao ) {
					$novoIntervencao          = $intervencao->replicate();
					$novoIntervencao->idplano = $Plano->idplano;
					$novoIntervencao->save();
				}
			}

			session()->forget( 'mensagem' );
			session( [ 'mensagem' => utf8_encode( $this->Page->Target . ' adicionado com sucesso!' ) ] );

			return $this->edit( $Plano->idplano );
		}
	}

	public function edit( $id ) {
		$Plano              = Plano::find( $id );
		$Intervencoes       = Intervencao::whereNotIn( 'idintervencao', $Plano->plano_intervencao->lists( 'idintervencao' ) )->get();
		$this->Page->Titulo = "Edição de Planos";
		$this->Page->funcao = "edit";

		return view( 'pages.ajustes.planos.master' )
			->with( 'Intervencoes', json_encode( $Intervencoes ) )
			->with( 'Plano', $Plano )
			->with( 'Page', $this->Page );
	}

	public function update( Request $request, $id ) {
		$data      = Plano::find( $id );
		$validator = Validator::make( $request->all(), [
			'nome' => 'required|unique:plano,nome,' . $id . ',idplano',
		] );

		if ( $validator->fails() ) {
			return redirect( $this->Page->link . '/' . $id . '/edit' )
				->withErrors( $validator )
				->withInput();
		} else {
			//atualizar plano
			//atualizar plano_intervencao
			$dataUpdate = $request->all();
			$data->update( $dataUpdate );

			session()->forget( 'mensagem' );
			session( [ 'mensagem' => utf8_encode( $this->Page->Target . ' atualizado com sucesso!' ) ] );

			return $this->edit( $id );
		}
	}

	public function destroy( $id ) {
		$data = Plano::find( $id );
		$data->delete();

		return response()->json( [
			'status'   => '1',
			'response' => 'Removido com sucesso'
		] );
	}
}
