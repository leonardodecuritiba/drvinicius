<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Validator;
use App\Anamnese;
use Illuminate\Http\Request;
use App\Http\Requests;

class AnamneseController extends Controller {

	protected $Page;

	public function __construct() {
		$this->idprofissional_criador = Auth::user()->profissional->idprofissional;
		$this->Page                   = (object) [
			'link'    => 'anamneses',
			'Targets' => 'Anamneses',
			'Target'  => 'Anamnese',
			'Titulo'  => 'Anamneses',
			'funcao'  => 'index'
		];
	}

	public function index( Request $request ) {
		$this->Page->Titulo = "Busca de Anamneses";
		if ( isset( $request['busca'] ) ) {
			$busca     = $request['busca'];
			$Anamneses = Anamnese::where( 'nome', 'like', '%' . $busca . '%' )
			                     ->orderBy( 'nome', 'ASC' )
			                     ->paginate( 10 );
		} else {
			$Anamneses = Anamnese::orderBy( 'nome', 'ASC' )->paginate( 10 );
		}

		return view( 'pages.ajustes.' . $this->Page->link . '.index' )
			->with( 'Buscas', $Anamneses )
			->with( 'Page', $this->Page );
	}

	public function create() {
		$this->Page->Titulo = "Cadastro de Anamneses";
		$this->Page->funcao = "create";

		return view( 'pages.ajustes.' . $this->Page->link . '.master' )
			->with( 'Page', $this->Page );
	}

	public function store( Request $request ) {
		$validator = Validator::make( $request->all(), [
			'nome' => 'required|unique:anamnese',
		] );
		if ( $validator->fails() ) {
			return redirect( $this->link . '/create' )
				->withErrors( $validator )
				->withInput();
		} else {
			//atualizar plano
			//atualizar plano_intervencao
			$data                           = $request->all();
			$data['idprofissional_criador'] = $this->idprofissional_criador;
			$Anamnese                       = Anamnese::create( $data );
			session()->forget( 'mensagem' );
			session( [ 'mensagem' => utf8_encode( $this->Page->Target . ' adicionado com sucesso!' ) ] );

			return $this->edit( $Anamnese->idanamnese );
		}
	}

	public function edit( $id ) {
		$Anamnese           = Anamnese::find( $id );
		$this->Page->Titulo = "Edição de Anamneses";
		$this->Page->funcao = "edit";
		$Perguntas          = new PerguntaController();

		return view( 'pages.ajustes.' . $this->Page->link . '.master' )
			->with( 'Anamnese', $Anamnese )
			->with( 'tipo_perguntas', $Perguntas->tipo_perguntas )
			->with( 'tipo_respostas', $Perguntas->tipo_respostas )
			->with( 'Page', $this->Page );
	}

	public function update( Request $request, $id ) {
		$data      = Anamnese::find( $id );
		$validator = Validator::make( $request->all(), [
			'nome' => 'required|unique:anamnese,nome,' . $id . ',idanamnese',
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
		$data = Anamnese::find( $id );
		$data->delete();

		return response()->json( [
			'status'   => '1',
			'response' => 'Removido com sucesso'
		] );
	}
}
