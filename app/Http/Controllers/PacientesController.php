<?php

namespace App\Http\Controllers;

use App\Documento;
use App\Helpers\ImageHelper;
use App\Helpers\PrintHelper;
use App\Intervencao;
use App\Orcamento;
use App\PacienteImages;
use App\Pagamento;
use App\Anamnese;
use App\Contato;
use App\Plano;
use App\Profissional;
use App\Paciente;
use App\Role;
use App\TipoPagamento;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Validator;

use Illuminate\Http\Request;

use App\Http\Requests;

class PacientesController extends Controller {
	private $idprofissional_criador;
	private $Page;

	public function __construct() {
		/*
		$this->middleware('role:empresa');
		if(Auth::check()){
			$this->empresa_id = (Auth::user()->empresa == "")?'*':Auth::user()->empresa->EMP_ID;
			$this->Empresa = (Auth::user()->empresa == "")?'*':Auth::user()->empresa;
		}
		*/
		$this->idprofissional_criador = Auth::user()->profissional->idprofissional;
		$this->Page                   = (object) [
			'link'              => "pacientes",
			'Target'            => "Paciente",
			'Targets'           => "Pacientes",
			'Titulo'            => "Pacientes",
			'Profissionais'     => Profissional::all(),
			'titulo_primario'   => "",
			'titulo_secundario' => "",
		];
	}

	public function index( Request $request ) {
		$titulo = "Busca de ";
		if ( isset( $request['busca'] ) ) {
			$busca  = $request['busca'];
			$Buscas = Paciente::where( 'nome', 'like', '%' . $busca . '%' )
			                  ->orwhere( 'cpf', 'like', '%' . $busca . '%' )
			                  ->orwhere( 'rg', 'like', '%' . $busca . '%' )
			                  ->get();
		} else {
			$Buscas = Paciente::all();
		}

		return view( 'pages.' . $this->Page->link . '.index' )
			->with( 'Page', $this->Page )
			->with( 'Title', $titulo )
			->with( 'Buscas', $Buscas );
	}

	public function create() {
		$this->Page->titulo_primario   = "Cadastrar ";
		$this->Page->titulo_secundario = "Dados Pessoais";
		$Planos                        = Plano::where( 'plano_status', 1 )->get();
		$Profissionais                 = Profissional::profissionais();

		return view( 'pages.' . $this->Page->link . '.master' )
			->with( 'Planos', $Planos )
			->with( 'Profissionais', $Profissionais )
			->with( 'Page', $this->Page );
	}

	public function imagensStore( Request $request ) {
		$rules      = array(
			'file' => 'image|max:3000',
		);
		$validation = Validator::make( $request->all(), $rules );
		if ( $validation->fails() ) {
			return Response::make( $validation->errors->first(), 400 );
		}

		$file           = $request->file( 'upload' );
		$img            = new ImageHelper();
		$upload_success = $img->store( $file, PacienteImages::DEFAULT_PATH );

		PacienteImages::create( [
			'idprofissional_criador' => $this->idprofissional_criador,
			'idpaciente'             => $request->get( 'idpaciente' ),
			'titulo'                 => $request->get( 'titulo' ),
			'descricao'              => $request->get( 'descricao' ),
			'link'                   => $upload_success
		] );
		session()->forget( 'mensagem' );
		session( [ 'mensagem' => utf8_encode( 'Imagem do paciente adicionada com sucesso!' ) ] );

		return Redirect::route( 'pacientes.show', $request->get( 'idpaciente' ) );
	}

	public function imagensDestroy( Request $request, $id ) {
		$Image      = PacienteImages::findOrFail( $id );
		$idpaciente = $Image->idpaciente;
		$img        = new ImageHelper();
		$img->remove( $Image->link, PacienteImages::DEFAULT_PATH );
		$Image->delete();
		session()->forget( 'mensagem' );
		session( [ 'mensagem' => utf8_encode( 'Imagem do paciente removida com sucesso!' ) ] );

		return Redirect::route( 'pacientes.show', $idpaciente );
	}

	public function documentosStore( Request $request ) {
		return 1;
	}

	public function documentosDestroy( Request $request ) {
		return 1;
	}

	public function store( Request $request ) {
		$validator = Validator::make( $request->all(), [
//            'cpf'               => 'unique:paciente',
			'idplano'         => 'required|exists:plano',
			'rg'              => 'unique:paciente',
			'nome'            => 'required',
			'data_nascimento' => 'required',
			'foto'            => 'image'
		] );

		if ( $validator->fails() ) {
			return redirect( $this->Page->link . '/create' )
				->withErrors( $validator )
				->withInput( $request->all() );
		} else {
			$data = $request->all();
			//store CONTATO
			$Contato = Contato::create( $data );

			//store PACIENTE
			if ( $request->hasfile( 'foto' ) ) {
				$img          = new ImageHelper();
				$data['foto'] = $img->store( $request->file( 'foto' ), $this->Page->link );
			} else {
				$data['foto'] = null;
			}


			$data['idcontato']              = $Contato->idcontato;
			$data['idprofissional_criador'] = $this->idprofissional_criador;
			$Paciente                       = Paciente::create( $data );

			session()->forget( 'mensagem' );
			session( [ 'mensagem' => utf8_encode( $this->Page->Target . ' adicionado com sucesso!' ) ] );

			return $this->show( $Paciente->idpaciente );
		}
	}

	public function show( $id, $tab = 'sobre' ) {
		$this->Page->titulo_primario = "Visualização de ";
		$this->Page->tab             = $tab;
		$Paciente                    = Paciente::find( $id );
		$Planos                      = Plano::where( 'plano_status', 1 )->get();
		$Profissionais               = Profissional::all();
		$Intervencoes                = Intervencao::all();
		$Anamneses                   = Anamnese::all();
		$TipoPagamentos              = TipoPagamento::all();

		return view( 'pages.' . $this->Page->link . '.show' )
			->with( 'Page', $this->Page )
			->with( 'Planos', $Planos )
			->with( 'Anamneses', $Anamneses )
			->with( 'Profissionais', $Profissionais )
			->with( 'Intervencoes', $Intervencoes )
			->with( 'TipoPagamentos', $TipoPagamentos )
			->with( 'Paciente', $Paciente );
	}

	public function update( Request $request, $id ) {
		$Paciente  = Paciente::find( $id );
		$validator = Validator::make( $request->all(), [
//            'cpf'               => 'unique:paciente,cpf,'.$id.',idpaciente',
			'rg'   => 'unique:paciente,rg,' . $id . ',idpaciente',
			'nome' => 'required',
			'foto' => 'image',
		] );
		if ( $validator->fails() ) {
			return redirect( $this->Page->link . '/' . $id )
				->withErrors( $validator )
				->withInput();
		} else {

			$dataUpdate = $request->all();
			if ( $request->hasfile( 'foto' ) ) {
				$img                = new ImageHelper();
				$dataUpdate['foto'] = $img->update( $request->file( 'foto' ), $this->Page->link, $Paciente->foto );
			}

			$Paciente->update( $dataUpdate );
			$Paciente->contato->update( $dataUpdate );
			session()->forget( 'mensagem' );
			session( [ 'mensagem' => utf8_encode( $this->Page->Target . ' atualizado com sucesso!' ) ] );

			return redirect()->route( 'pacientes.show', $id );
		}
	}

	public function alertas_paciente( $idpaciente ) {
		$Paciente = Paciente::find( $idpaciente );
//        return json_encode($Paciente->respostas);
//        return response(array('status' => 1, 'response' => $Paciente));
		$status = 1;
		foreach ( $Paciente->respostas as $resposta ) {
//            print_r($resposta);
			if ( ( $resposta->pergunta->tipo_pergunta > 0 ) && ( $resposta->pergunta->tipo_pergunta == $resposta->resposta ) ) {
				$paciente_alertas[] = $resposta->pergunta->msg_alerta;
			}
		}
		if ( ! isset( $paciente_alertas ) ) {
			$status           = 0;
			$paciente_alertas = 'Esse paciente não possui nenhum alerta!';
		}

		return response(
			array(
				'status'   => $status,
				'response' => $paciente_alertas
			) );

	}

	public function destroy( $id ) {
		// Remover paciente
		$Paciente = Paciente::find( $id );
		$Paciente->retornos_todos()->delete();
		$Paciente->documentos()->delete();
		$Paciente->consultas()->delete();
		$Paciente->orcamentos()->delete();
		$Paciente->pagamentos()->delete();
		$Paciente->respostas()->delete();
		$Paciente->evolucoes()->delete();
		$Paciente->delete();
		$Paciente->contato()->delete();

		session()->forget( 'mensagem' );
		session( [ 'mensagem' => utf8_encode( $this->Page->Target . ' removido com sucesso!' ) ] );

		return Redirect::route( 'pacientes.index' );
	}


	public function imprimir( $idpaciente ) {
		return PrintHelper::prontuario( Paciente::findOrFail( $idpaciente ) );
	}
}
