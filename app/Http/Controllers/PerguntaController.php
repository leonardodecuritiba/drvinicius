<?php

namespace App\Http\Controllers;

use App\Anamnese;
use App\Pergunta;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Validator;

class PerguntaController extends Controller {
	public $tipo_perguntas;
	public $tipo_respostas;
	protected $Page;

	public function __construct() {
		$this->idprofissional_criador = Auth::user()->profissional->idprofissional;
		$this->Page                   = (object) [
			'link'    => 'perguntas',
			'Targets' => 'Perguntas',
			'Target'  => 'Pergunta',
			'Titulo'  => 'Perguntas',
			'funcao'  => 'index'
		];
		$this->tipo_perguntas         = (object) [
			'0' => 'Não crítica',
			'1' => 'Crítica para SIM',
			'2' => 'Crítica para NÃO'
		];
		$this->tipo_respostas         = (object) [
			'0' => 'SIM/NÃO/NÃO SEI',
			'1' => 'SIM/NÃO/NÃO SEI e texto',
			'2' => 'Apenas texto'
		];
	}

	/*
	public function index(Request $request)
	{
		$this->Page->Titulo = "Busca de Intervenções";
		if(isset($request['busca'])){
			$busca = $request['busca'];
			$Buscas = Intervencao::where('nome', 'like', '%'.$busca.'%')
				->orderBy('nome','ASC')
				->get();
		} else {
			$Buscas = Intervencao::orderBy('nome','ASC')->get();
		}

		return view('pages.ajustes.'.$this->Page->link.'.index')
			->with('Buscas', $Buscas)
			->with('Page', $this->Page);
	}

	public function create()
	{
		$this->Page->Titulo = "Cadastro de Intervenções";
		$this->Page->funcao = "create";
		return view('pages.ajustes.'.$this->Page->link.'.master')
			->with('Page', $this->Page);
	}

	public function edit($id)
	{
		$Intervencao = Intervencao::find($id);
		$this->Page->Titulo = "Edição de Intervenção";
		$this->Page->funcao = "edit";
		return view('pages.ajustes.'.$this->Page->link.'.master')
			->with('Intervencao', $Intervencao)
			->with('Page', $this->Page);
	}

	*/
	public function update( Request $request, $id ) {
		$data          = Pergunta::find( $id );
		$idanamnese    = $request->get( 'idanamnese' );
		$numeros_ordem = Pergunta::where( 'idanamnese', $idanamnese )
		                         ->where( 'numero_ordem', '<>', $data->numero_ordem )
		                         ->lists( 'numero_ordem' )->all();
		$validator     = Validator::make( $request->all(), [
			'numero_ordem'   => 'required|not_in:' . implode( ",", $numeros_ordem ),
			'tipo_pergunta'  => 'required',
			'tipo_resposta'  => 'required',
			'texto_pergunta' => 'required',
		] );

		if ( $validator->fails() ) {
			return redirect( 'anamneses/' . $idanamnese . '/edit' )
				->withErrors( $validator )
				->withInput();
		} else {
			//atualizar intervencao
			$dataUpdate = $request->all();
			$data->update( $dataUpdate );
			session()->forget( 'mensagem' );
			session( [ 'mensagem' => $this->Page->Target . ' atualizada!' ] );

			return redirect( 'anamneses/' . $idanamnese . '/edit' );
		}
	}

	public function store( Request $request ) {
		$id            = $request->get( 'idanamnese' ); //nao pode ter mesmo numero dentro da anamnese
		$numeros_ordem = Pergunta::where( 'idanamnese', $id )->lists( 'numero_ordem' )->all();
		$validator     = Validator::make( $request->all(), [
			'numero_ordem'   => 'required|not_in:' . implode( ",", $numeros_ordem ),
			'tipo_pergunta'  => 'required',
			'tipo_resposta'  => 'required',
			'texto_pergunta' => 'required',
		] );
		if ( $validator->fails() ) {
			return redirect( 'anamneses/' . $request->get( 'idanamnese' ) . '/edit' )
				->withErrors( $validator )
				->withInput();
		} else {
			$data                           = $request->all();
			$data['idprofissional_criador'] = $this->idprofissional_criador;
			$Pergunta                       = Pergunta::create( $data );
			session()->forget( 'mensagem' );
			session( [ 'mensagem' => $this->Page->Target . ' cadastrada!' ] );

			return redirect( 'anamneses/' . $request->get( 'idanamnese' ) . '/edit' );
		}
	}

	public function destroy( $id ) {
		$data = Pergunta::find( $id );
		$data->delete();

		return response()->json( [
			'status'   => '1',
			'response' => 'Removido com sucesso'
		] );
	}
}
