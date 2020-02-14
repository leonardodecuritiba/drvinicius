<?php

namespace App\Http\Controllers;

use App\Helpers\ExcelFile;
use App\Http\Requests\ChequeRequest;
use App\Models\Cheque;
use App\Plano;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ChequeController extends Controller {
	protected $Page;

	public function __construct() {
		$this->Page = (object) [
			'link'    => 'cheques',
			'Targets' => 'Cheques',
			'Target'  => 'Cheque',
			'Titulo'  => 'Cheque',
			'funcao'  => 'index',
			'extras'  => ''
		];
	}

	public function index( Request $request ) {
		$this->Page->Titulo = "Busca de Cheques";
		$this->Page->extras = [
			'Planos' => Plano::orderBy( 'nome', 'ASC' )->get(),
		];
		$Buscas             = Cheque::filter( $request->all() );

		return view( 'pages.' . $this->Page->link . '.index' )
			->with( 'Buscas', $Buscas )
			->with( 'Page', $this->Page );
	}

	public function create() {
		$this->Page->Titulo = "Cadastro de Cheques";
		$this->Page->funcao = "create";
		$this->Page->extras = [
			'Planos' => Plano::orderBy( 'nome', 'ASC' )->get(),
		];

		return view( 'pages.' . $this->Page->link . '.master' )
			->with( 'Page', $this->Page );
	}

	public function edit( $id ) {
		$Cheque             = Cheque::findOrFail( $id );
		$this->Page->Titulo = "Editar Cheque";
		$this->Page->funcao = "edit";
		$this->Page->extras = [
			'Planos' => Plano::orderBy( 'nome', 'ASC' )->get(),
		];

		return view( 'pages.' . $this->Page->link . '.master' )
			->with( 'Cheque', $Cheque )
			->with( 'Page', $this->Page );
	}

	public function store( ChequeRequest $request ) {
		//store Cheque
		$data = Cheque::create( $request->all() );
		session()->forget( 'mensagem' );
		session( [ 'mensagem' => $this->Page->Target . ' adicionado com sucesso!' ] );

		return Redirect::route( 'cheques.index' );

	}

	public function update( ChequeRequest $request, $id ) {
		$Cheque = Cheque::findOrFail( $id );
		$Cheque->update( $request->all() );
		session()->forget( 'mensagem' );
		session( [ 'mensagem' => $this->Page->Target . ' atualizado com sucesso!' ] );

		return Redirect::route( 'cheques.index' );

	}

	public function exportar( Request $request, ExcelFile $export ) {
		$Cheques = Cheque::filter( $request->all() );

		return $export->sheet( 'sheetName', function ( $sheet ) use ( $Cheques ) {
			$dados = array(
				'ID',
				'Data',
				'Nome',
				'Valor',
				'Banco',
				'Número',
				'Plano',
				'Destino'
			);

			$sheet->row( 1, $dados );
			$i = 2;
			foreach ( $Cheques as $sel ) {
				$sheet->row( $i, array(
					$sel->id,
					$sel->getData(),
					$sel->nome,
					$sel->getValor(),
					$sel->banco,
					$sel->numeracao,
					$sel->getNomePlano(),
					$sel->destino,
				) );
				$i ++;
			}
		} )->export( 'xls' );
	}

	public function destroy( $id ) {
		$data = Cheque::find( $id );
		$data->delete();

		return response()->json( [
			'status'   => '1',
			'response' => 'Removido com sucesso'
		] );
	}
}
