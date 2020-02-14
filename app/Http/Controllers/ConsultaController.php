<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Validator;
use App\Consulta;
use App\Http\Controllers\PacientesController;
use Illuminate\Http\Request;
use App\Http\Requests;

class ConsultaController extends Controller {
	protected $Page;

	public function __construct() {
		$this->idprofissional_criador = Auth::user()->profissional->idprofissional;
		$this->Page                   = (object) [
			'link'    => 'consultas',
			'Targets' => 'Consultas',
			'Target'  => 'Consulta',
			'Titulo'  => 'Consulta',
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
	public function update( Request $request ) {
		$data      = Consulta::find( $request['idconsulta'] );
		$validator = Validator::make( $request->all(), [
			'idpaciente'    => 'required',
			'dia_inteiro'   => 'required',
			'data_consulta' => 'required',
			'tipo_consulta' => 'required',
		] );

		if ( $validator->fails() ) {
			return redirect( 'agenda' )
				->withErrors( $validator )
				->withInput();
		} else {

			//atualizar intervencao
			$dataUpdate = $request->all();

			if ( $dataUpdate['dia_inteiro'] ) {
				$dataUpdate["hora_inicio"]  = '00:00';
				$dataUpdate["hora_termino"] = '23:59';
			}
//            return $dataUpdate;
			$data->update( $dataUpdate );
			session()->forget( 'mensagem' );
			session( [ 'mensagem' => $this->Page->Target . ' atualizada!' ] );

			return redirect( 'agenda' );
		}
	}

	public function store( Request $request ) {
		$data  = $request->all();
		$rules = [
			'dia_inteiro'   => 'required',
			'data_consulta' => 'required',
			'hora_inicio'   => 'required',
			'hora_termino'  => 'required',
			'tipo_consulta' => 'required',
		];
		if ( $request->has( 'anonimo' ) ) {
			unset( $data['idpaciente'] );
			$rules = array_merge( $rules, [
				'nome'     => 'required',
				'telefone' => 'required'
			] );
		} else {
			$rules = array_merge( $rules, [
				'idpaciente' => 'required'
			] );

		}
		$validator = Validator::make( $request->all(), $rules );
		if ( $validator->fails() ) {
			return redirect( 'agenda' )
				->withErrors( $validator )
				->withInput();
		} else {
			$data['idprofissional_criador'] = $this->idprofissional_criador;
			Consulta::create( $data );
			session()->forget( 'mensagem' );
			session( [ 'mensagem' => $this->Page->Target . ' cadastrada!' ] );

			return redirect( 'agenda' );
		}

	}

	public function updateDateTime( Request $request ) {
		$data       = Consulta::find( $request['idconsulta'] );
		$dataUpdate = $request->all();
		$data->update( $dataUpdate );

		return response()->json( [
			'status'   => '1',
			'response' => 'Atualizado com sucesso'
		] );
	}

	public function destroy( $id ) {
		return 'ok';
		$data = Consulta::find( $id );
		$data->delete();

		return response()->json( [
			'status'   => '1',
			'response' => 'Removido com sucesso'
		] );
	}

	public function remove( $id ) {
		$data = Consulta::find( $id );
		$data->delete();
		session()->forget( 'mensagem' );
		session( [ 'mensagem' => $this->Page->Target . ' removida!' ] );

		return redirect( 'agenda' );
	}
}
