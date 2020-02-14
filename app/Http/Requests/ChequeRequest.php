<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Redirect;

class ChequeRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		switch ( $this->method() ) {
			case 'GET':
			case 'DELETE':
			{
				return [];
			}
			case 'POST':
			{
				return [
					'nome'      => 'required|min:1|max:100',
					'idplano'   => 'required|exists:plano',
					'data'      => 'required|date_format:d/m/Y',
					'valor'     => 'required',
					'banco'     => 'required|min:1|max:50',
					'numeracao' => 'required|min:1|max:100',
					'destino'   => 'required|min:1|max:100'
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'nome'      => 'required|min:1|max:100',
					'idplano'   => 'required|exists:plano',
					'data'      => 'required|date_format:d/m/Y',
					'valor'     => 'required',
					'banco'     => 'required|min:1|max:50',
					'numeracao' => 'required|min:1|max:100',
					'destino'   => 'required|min:1|max:100'
				];
			}
			default:
				break;
		}
	}

	/**
	 * Get the response that handle the request errors.
	 *
	 * @param array $errors
	 *
	 * @return array
	 */
	public function response( array $errors ) {
		return Redirect::back()->withErrors( $errors )->withInput();
	}
}
