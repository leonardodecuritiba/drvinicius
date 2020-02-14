<?php

namespace App\Http\Controllers;

use App\Contato;
use App\Profissional;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {
	private $Page;

	public function __construct() {
		/*
		$this->middleware('role:empresa');
		if(Auth::check()){
			$this->empresa_id = (Auth::user()->empresa == "")?'*':Auth::user()->empresa->EMP_ID;
			$this->Empresa = (Auth::user()->empresa == "")?'*':Auth::user()->empresa;
		}
		*/
		$this->Page = (object) [
			'Target'            => "Usuário",
			'Targets'           => "Usuários",
			'link'              => "usuarios",
			'Titulo'            => "Usuários",
			'titulo_primario'   => "",
			'titulo_secundario' => "",
			'extras'            => "",
			'Estados'           => parent::$Estados,
		];
	}

	public function index( Request $request ) {
		$titulo = "Busca de ";
		if ( isset( $request['busca'] ) ) {
			$busca  = $request['busca'];
			$Buscas = Profissional::where( 'nome', 'like', '%' . $busca . '%' )
			                      ->orwhere( 'cpf', 'like', '%' . $busca . '%' )
			                      ->withTrashed()
			                      ->paginate( 10 );
		} else {
			$Buscas = Profissional::withTrashed()->paginate( 10 );
		}

		return view( 'pages.' . $this->Page->link . '.index' )
			->with( 'Page', $this->Page )
			->with( 'Title', $titulo )
			->with( 'Buscas', $Buscas );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$this->Page->titulo_primario = "Cadastro de ";
		$this->Page->Titulo          = "Cadatrar Usuário";
		$this->Page->funcao          = "create";
		$this->Page->extras          = [ 'Role' => Role::all() ];

		return view( 'pages.' . $this->Page->link . '.master' )
			->with( 'Page', $this->Page );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		$validator = Validator::make( $request->all(), [
			'cpf'   => 'unique:profissional',
			'nome'  => 'unique:profissional',
			'email' => 'unique:users',
		] );

		if ( $validator->fails() ) {
			return Redirect::route( $this->Page->link . '.create' )
			               ->withErrors( $validator )
			               ->withInput();
		} else {

			$data             = $request->all();
			$data['password'] = bcrypt( '123' );

			$Contato = Contato::create( $data );
			$User    = User::create( $data );
			$role    = Role::find( $data['tipo'] );
			$User->attachRole( $role );
			$data['idcontato'] = $Contato->idcontato;
			$data['idusers']   = $User->idusers;
			$Profissional      = Profissional::create( $data );

			session()->forget( 'mensagem' );
			session( [ 'mensagem' => utf8_encode( $this->Page->Target . ' cadastrado com sucesso!' ) ] );

			return Redirect::route( $this->Page->link . '.index' );
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		$User                          = User::find( $id );
		$this->Page->titulo_primario   = "Visualização de ";
		$this->Page->titulo_secundario = "Editar";
		$this->Page->Titulo            = "Edição de Usuário";
		$this->Page->funcao            = "edit";

		return view( 'pages.' . $this->Page->link . '.master' )
			->with( 'User', $User )
			->with( 'Page', $this->Page );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
		$User      = User::find( $id );
		$validator = Validator::make( $request->all(), [
			'cpf'   => 'unique:profissional,cpf,' . $User->profissional->idprofissional . ',idprofissional',
			'nome'  => 'unique:profissional,nome,' . $User->profissional->idprofissional . ',idprofissional',
			'email' => 'unique:users,email,' . $id . ',idusers',
		] );

		if ( $validator->fails() ) {
			return Redirect::to( [ $this->Page->link . '.edit', $id ] )
			               ->withErrors( $validator )
			               ->withInput();
		} else {

			$data = $request->all();
			$User->update( $data );
			$User->profissional->update( $data );
			$User->profissional->contato->update( $data );

			session()->forget( 'mensagem' );
			session( [ 'mensagem' => utf8_encode( $this->Page->Target . ' atualizado com sucesso!' ) ] );

			return Redirect::route( $this->Page->link . '.edit', [ 'idusers' => $id ] );
		}
	}


	public function upd_pass( Request $request, $id ) {
//        return $request->all();
		$validator = Validator::make( $request->all(), [ 'password' => 'required|confirmed|min:6|max:20' ] );
		if ( $validator->fails() ) {
			return redirect()->to( $this->getRedirectUrl() )
			                 ->withErrors( $validator )
			                 ->withInput( $request->all() );
		} else {
			if ( env( 'APP_DEMO' ) ) {
				$msg = $this->Page->Target . ' atualizado com sucesso! Obs: A versão demonstrativa não altera a senha!';
			} else {
				$msg  = $this->Page->Target . ' atualizado com sucesso!';
				$User = User::find( $id );
				$User->update( [
					'password' => bcrypt( $request->get( 'password' ) )
				] );
			}
			session()->forget( 'mensagem' );
			session( [ 'mensagem' => $msg ] );

			return Redirect::route( $this->Page->link . '.edit', [ 'idusers' => $id ] );
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		$data = Profissional::find( $id );
		$data->delete();

		return Redirect::route( $this->Page->link . '.index' );
	}

	/**
	 * Set Status the specified resource from storage.
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function active( $id ) {
		$data = Profissional::withTrashed()->find( $id );
		$data->restore();

		return Redirect::route( $this->Page->link . '.index' );
	}
}
