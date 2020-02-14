<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Redirect;

class ValoresRequest extends Request {

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
					'tipo'      => 'required',
					'data'      => 'required|date_format:d/m/Y',
					'valor'     => 'required',
					'fonte'     => 'required|min:1|max:100',
					'documento' => 'required|min:1|max:30',
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'tipo'      => 'required',
					'data'      => 'required|date_format:d/m/Y',
					'valor'     => 'required',
					'fonte'     => 'required|min:1|max:100',
					'documento' => 'required|min:1|max:30',
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
