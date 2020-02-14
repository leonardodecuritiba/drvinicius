<?php

namespace App\Http\Controllers;

use App\Evolucao;
use App\Http\Controllers\PacientesController;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class EvolucaoController extends Controller {
	protected $Page;

	public function __construct() {
		$this->idprofissional_criador = Auth::user()->profissional->idprofissional;
		$this->Page                   = (object) [
			'link'    => 'evolucoes',
			'Targets' => 'Evoluções',
			'Target'  => 'Evolução',
			'Titulo'  => 'Evolução',
			'funcao'  => 'index'
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
		return 'update';
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
		$idpaciente                     = $request->get( 'idpaciente' );
		$data                           = $request->all();
		$data['idprofissional_criador'] = $this->idprofissional_criador;
		$Evolucao                       = Evolucao::create( $data );
		session()->forget( 'mensagem' );
		session( [ 'mensagem' => $this->Page->Target . ' cadastrada!' ] );
		$PacientesController = new PacientesController();

		return redirect()->route( 'pacientes.tab', [ $idpaciente, 'evolucoes' ] );
	}

	public function destroy( $id ) {
		$data       = Evolucao::find( $id );
		$idpaciente = $data->idpaciente;
		$data->delete();
		session()->forget( 'mensagem' );
		session( [ 'mensagem' => $this->Page->Target . ' removida!' ] );

		return redirect()->route( 'pacientes.show', $idpaciente );
	}
}
