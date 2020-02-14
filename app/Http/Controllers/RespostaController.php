<?php

namespace App\Http\Controllers;

use App\Anamnese;
use App\Helpers\PrintHelper;
use App\Paciente;
use App\Pergunta;
use App\Resposta;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Validator;

class RespostaController extends Controller {
	public $tipo_perguntas;
	public $tipo_respostas;
	protected $Page;

	public function __construct() {
		$this->idprofissional_criador = Auth::user()->profissional->idprofissional;
		$this->Page                   = (object) [
			'link'    => 'respostas',
			'Targets' => 'Respostas',
			'Target'  => 'Resposta',
			'Titulo'  => 'Respostas',
			'funcao'  => 'index'
		];
	}

	public function imprimir( $idpaciente, $idanamese ) {
		$Paciente = Paciente::find( $idpaciente );

		return PrintHelper::anamnese( $Paciente->respostas_anamnse( $idanamese ) );
	}

	public function update( Request $request, $id ) {
		$data = $request->all();
		if ( $data['idanamnese'] > 0 ) {
			foreach ( $data['resposta'] as $idpergunta => $valor ) {
				$insere = 0;
				switch ( $valor['tipo_resposta'] ) {
					case 0:
					{ //SIM/NÃO/NÃO SEI
						if ( isset( $valor['resposta'] ) ) {
							$resposta['resposta'] = $valor['resposta'];
							$insere               = 1;
						}
						break;
					}
					case 1:
					{ //SIM/NÃO/NÃO SEI e TEXTO
						if ( isset( $valor['resposta'] ) ) {
							$resposta['resposta']       = $valor['resposta'];
							$resposta['texto_resposta'] = $valor['texto_resposta'];
							$insere                     = 1;
						}
						break;
					}
					case 2:
					{  //TEXTO
						$resposta['texto_resposta'] = $valor['texto_resposta'];
						$insere                     = 1;
						break;
					}
				}
				if ( $insere ) {
					$resposta['idpergunta'] = $idpergunta;
					$resposta['idpaciente'] = $id;

					if ( isset( $valor['idresposta'] ) ) {
						$data = Resposta::find( $valor['idresposta'] );
						$data->update( $resposta );
					} else {
						Resposta::create( $resposta );
					}
				}
			}

		}

		return response()->json( [
			'status'   => '1',
			'response' => 'Anamnese atualizada com sucesso'
		] );

	}

	public function store( Request $request ) {
		return 'store';
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
