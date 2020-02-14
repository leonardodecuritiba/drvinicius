<?php

namespace App\Http\Controllers;

use App\Impresso;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Orcamento;
use Illuminate\Http\Request;

class ImpressoController extends Controller {
	protected $Page;

	public function __construct() {
		$this->idprofissional_criador = Auth::user()->profissional->idprofissional;
		$this->Page                   = (object) [
			'link'    => 'impressos',
			'Targets' => 'Impressos',
			'Target'  => 'Impresso',
			'Titulo'  => 'Impresso',
			'funcao'  => 'index'
		];
	}

	public function update( Request $request ) {
		$data      = Orcamento::find( $request['idconsulta'] );
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
		$data      = $request->all();
		$validator = Validator::make( $data, [
			'idpaciente' => 'required',
			'file'       => 'image|max:3000',
		] );
		if ( $validator->fails() ) {
			return Response::make( $validator->errors->first(), 400 );
		} else {
			//fazer upload da imagem
			//store documentos
			$img               = new ImageHelper();
			$data['documento'] = $img->store( $request->file( 'file' ), 'documentos' );
			if ( $data['documento'] > 0 ) {
				$data['idprofissional_criador'] = $this->idprofissional_criador;
				$Impresso                       = Impresso::create( $data );

				return 1;
			} else {
				return Response::json( 'error', 400 );
			}
		}

	}

	public function destroy( $id ) {
		$data = Impresso::find( $id );
		$data->delete();

		return response()->json( [
			'status'   => '1',
			'response' => 'Impresso removido com sucesso'
		] );
	}
}
