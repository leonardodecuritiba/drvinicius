<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Upload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Http\Request;

class UploadController extends Controller {
	protected $Page;
	protected $idprofissional_criador;

	public function __construct() {
		$this->idprofissional_criador = Auth::user()->profissional->idprofissional;
		$this->Page                   = (object) [
			'link'    => 'uploads_docs',
			'Targets' => 'Impressão PDFs',
			'Target'  => 'Impressão PDF',
			'Titulo'  => 'Impressão PDF',
			'funcao'  => 'index'
		];
	}

	public function index( Request $request ) {
		$this->Page->Titulo = "Busca de Documentos PDF";
		if ( isset( $request['busca'] ) ) {
			$busca  = $request['busca'];
			$Buscas = Upload::where( 'nome', 'like', '%' . $busca . '%' )
			                ->orWhere( 'descricao', 'like', '%' . $busca . '%' )
			                ->orderBy( 'nome', 'ASC' )
			                ->paginate( 10 );
		} else {
			$Buscas = Upload::orderBy( 'nome', 'ASC' )->paginate( 10 );
		}

		return view( 'pages.ajustes.' . $this->Page->link . '.index' )
			->with( 'Buscas', $Buscas )
			->with( 'Page', $this->Page );
	}

	public function create() {
		$this->Page->Titulo = "Cadastro de Documentos PDF";
		$this->Page->funcao = "create";

		return view( 'pages.ajustes.' . $this->Page->link . '.master' )
			->with( 'Page', $this->Page );
	}

	public function edit( $id ) {
		$this->Page->Titulo = "Editar Documento PDF";
		$this->Page->funcao = "edit";
		$Upload             = Upload::find( $id );

		return view( 'pages.ajustes.' . $this->Page->link . '.master' )
			->with( 'Upload', $Upload )
			->with( 'Page', $this->Page );
	}

	public function store( Request $request ) {
		$validator = Validator::make( $request->all(), [
			'nome'      => 'required|min:1|max:50',
			'descricao' => 'required|min:1|max:100',
			'link'      => 'required|file',
		] );
		if ( $validator->fails() ) {
			return redirect( $this->Page->link . '.create' )
				->withErrors( $validator )
				->withInput();
		} else {
			//store TipoPagamento
			$data = $request->all();
			if ( $request->hasfile( 'link' ) ) {
				$ImageHelper  = new ImageHelper();
				$data['link'] = $ImageHelper->store( $request->file( 'link' ), 'documentos' );
			}
			$data['idprofissional_criador'] = $this->idprofissional_criador;
			Upload::create( $data );
			session()->forget( 'mensagem' );
			session( [ 'mensagem' => $this->Page->Target . ' adicionado com sucesso!' ] );

			return Redirect::route( 'uploads_docs.index' );
		}
	}

	public function update( Request $request, $id ) {
		$validator = Validator::make( $request->all(), [
			'nome'      => 'required|min:1|max:50',
			'descricao' => 'required|min:1|max:100',
		] );
		if ( $validator->fails() ) {
			return redirect( $this->Page->link . '/' . $id . '/edit' )
				->withErrors( $validator )
				->withInput();
		} else {
			//store tipo_pagamento
			$Upload     = Upload::find( $id );
			$dataUpload = $request->all();
			if ( $request->hasfile( 'link' ) ) {
				$ImageHelper        = new ImageHelper();
				$dataUpload['link'] = $ImageHelper->update( $request->file( 'link' ), 'documentos', $Upload->link );
			}
			$Upload->update( $dataUpload );
			session()->forget( 'mensagem' );
			session( [ 'mensagem' => $this->Page->Target . ' atualizado com sucesso!' ] );

			return Redirect::route( 'uploads_docs.index' );
		}
	}

	public function destroy( $id ) {
		$Upload             = Upload::find( $id );
		$ImageHelper        = new ImageHelper();
		$dataUpload['link'] = $ImageHelper->remove( $Upload->link, 'documentos' );
		$Upload->delete();

		return response()->json( [
			'status'   => '1',
			'response' => 'Removido com sucesso'
		] );
	}
}
