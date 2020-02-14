<?php

namespace App\Http\Controllers;

use App\Helpers\ExcelFile;
use App\Http\Requests\ValoresRequest;
use App\Models\Valores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ValoresController extends Controller {
	protected $Page;

	public function __construct() {
		$this->Page = (object) [
			'link'    => 'valores',
			'Targets' => 'Valores',
			'Target'  => 'Valor',
			'Titulo'  => 'Valor',
			'funcao'  => 'index',
			'extras'  => ''
		];
	}

	public function index( Request $request, $tipo ) {
		$request->merge( [ 'tipo' => $tipo ] );
		$this->Page->Titulo  = "Busca de " . Valores::getTipo( $tipo );
		$this->Page->Targets = Valores::getTipo( $tipo );
		$this->Page->Target  = $this->Page->Targets;
		$this->Page->extras  = [ 'tipo' => $tipo ];
		$Buscas              = Valores::filter( $request->all() );

		return view( 'pages.' . $this->Page->link . '.index' )
			->with( 'Buscas', $Buscas )
			->with( 'Page', $this->Page );
	}

	public function create( $tipo ) {
		$this->Page->Targets = Valores::getTipo( $tipo );
		$this->Page->Target  = $this->Page->Targets;
		$this->Page->Titulo  = "Cadastro de " . $this->Page->Target;
		$this->Page->extras  = [ 'tipo' => $tipo ];
		$this->Page->funcao  = "create";

		return view( 'pages.' . $this->Page->link . '.master' )
			->with( 'Page', $this->Page );
	}

	public function edit( $id ) {
		$Data                = Valores::findOrFail( $id );
		$this->Page->Targets = $Data->getTipoText();
		$this->Page->Target  = $this->Page->Targets;
		$this->Page->Titulo  = "Editar " . $this->Page->Target;
		$this->Page->extras  = [ 'tipo' => $Data->getTipoName() ];
		$this->Page->funcao  = "edit";

		return view( 'pages.' . $this->Page->link . '.master' )
			->with( 'Data', $Data )
			->with( 'Page', $this->Page );
	}

	public function store( ValoresRequest $request ) {
		//store Cheque
		$Data                = Valores::create( $request->all() );
		$this->Page->Targets = $Data->getTipoText();
		$this->Page->Target  = $this->Page->Targets;
		session()->forget( 'mensagem' );
		session( [ 'mensagem' => $this->Page->Target . ' adicionado com sucesso!' ] );

		return Redirect::route( 'valores.index', $Data->getTipoName() );

	}

	public function update( ValoresRequest $request, $id ) {
		$Data = Valores::findOrFail( $id );
		$Data->update( $request->all() );
		$this->Page->Targets = $Data->getTipoText();
		$this->Page->Target  = $this->Page->Targets;
		session()->forget( 'mensagem' );
		session( [ 'mensagem' => $this->Page->Target . ' atualizado com sucesso!' ] );

		return Redirect::route( 'valores.index', $Data->getTipoName() );

	}

	public function exportar( Request $request, $tipo, ExcelFile $export ) {
		$request->merge( [ 'tipo' => $tipo ] );
		$Valores = Valores::filter( $request->all() );
		$Targets = Valores::getTipo( $tipo );

		return $export->sheet( 'sheetName', function ( $sheet ) use ( $Valores, $Targets ) {
			$sheet->row( 1, array( $Targets ) );
			$dados = array(
				'ID',
				'Data',
				'Fonte',
				'Valor',
				'CNPJ/CPF'
			);
			$sheet->row( 2, $dados );
			$i = 3;
			foreach ( $Valores as $sel ) {
				$sheet->row( $i, array(
					$sel->id,
					$sel->getData(),
					$sel->fonte,
					$sel->getValor(),
					$sel->documento
				) );
				$i ++;
			}
		} )->export( 'xls' );
	}

	public function destroy( $id ) {
		$data = Valores::find( $id );
		$data->delete();

		return response()->json( [
			'status'   => '1',
			'response' => 'Removido com sucesso'
		] );
	}
}
