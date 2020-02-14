<?php

namespace App\Http\Controllers;

use App\PlanoIntervencao;
use Validator;
use Illuminate\Http\Request;

class PlanoIntervencaoController extends Controller {
	protected $Page;

	public function __construct() {
		$this->Page = (object) [
			'link'    => 'plano_intervencao',
			'Targets' => 'Intervenções do plano',
			'Target'  => 'Intervenção do plano',
			'Titulo'  => 'Intervenção do plano',
			'funcao'  => 'index'
		];
	}

	public function store( Request $request ) {
		$validator = Validator::make( $request->all(), [
			'idplano'     => 'required',
			'valor_plano' => 'required',
//            'valor_paciente'    => 'required',
		] );
		if ( $validator->fails() ) {
			return redirect( 'planos/' . $request->get( 'idplano' ) . '/edit' )
				->withErrors( $validator )
				->withInput();
		} else {
			//store plano_intervencao
			$Plano = PlanoIntervencao::create( $request->all() );

			session()->forget( 'mensagem' );
			session( [ 'mensagem' => $this->Page->Target . ' adicionado com sucesso!' ] );

			return redirect( 'planos/' . $request->get( 'idplano' ) . '/edit' );
		}
	}

	public function update( Request $request, $id ) {
		$plano_intervencao = PlanoIntervencao::find( $id );
		$validator         = Validator::make( $request->all(), [
			'idplano'     => 'required',
			'valor_plano' => 'required',
//            'valor_paciente'    => 'required',
		] );
		if ( $validator->fails() ) {
			return redirect( 'planos/' . $request->get( 'idplano' ) . '/edit' )
				->withErrors( $validator )
				->withInput();
		} else {
			//store plano_intervencao
			$data = $plano_intervencao->update( $request->all() );

			session()->forget( 'mensagem' );
			session( [ 'mensagem' => $this->Page->Target . ' atualizado com sucesso!' ] );

			return redirect( 'planos/' . $request->get( 'idplano' ) . '/edit' );
		}
	}

	public function destroy( $id ) {
		$data = PlanoIntervencao::find( $id );
		$data->delete();

		return response()->json( [
			'status'   => '1',
			'response' => 'Removido com sucesso'
		] );
	}
}
