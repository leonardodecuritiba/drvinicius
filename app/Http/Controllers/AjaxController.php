<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class AjaxController extends Controller {
	public function ajax() {
		$id     = Input::get( 'id' );
		$pk     = Input::get( 'pk' );
		$sk     = Input::get( 'sk' ); //status key
		$table  = Input::get( 'table' );
		$action = Input::get( 'action' );
		switch ( $action ) {
			case 'ativar':
				DB::table( $table )
				  ->where( $pk, $id )
				  ->update( [ $sk => 1 ] );

				return response()->json( [
					'status'   => '1',
					'response' => 'Status alterado com sucesso!',
					'valor'    => 1
				] );
			case 'desativar':
				DB::table( $table )
				  ->where( $pk, $id )
				  ->update( [ $sk => 0 ] );

				return response()->json( [
					'status'   => '1',
					'response' => 'Status alterado com sucesso!',
					'valor'    => 0
				] );
		}
	}
}
