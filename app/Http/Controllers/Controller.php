<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController {
	use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
	static public $Estados = array(
		"AC" => "Acre",
		"AL" => "Alagoas",
		"AM" => "Amazonas",
		"AP" => "Amapá",
		"BA" => "Bahia",
		"CE" => "Ceará",
		"DF" => "Distrito Federal",
		"ES" => "Espírito Santo",
		"GO" => "Goiás",
		"MA" => "Maranhão",
		"MT" => "Mato Grosso",
		"MS" => "Mato Grosso do Sul",
		"MG" => "Minas Gerais",
		"PA" => "Pará",
		"PB" => "Paraíba",
		"PR" => "Paraná",
		"PE" => "Pernambuco",
		"PI" => "Piauí",
		"RJ" => "Rio de Janeiro",
		"RN" => "Rio Grande do Norte",
		"RO" => "Rondônia",
		"RS" => "Rio Grande do Sul",
		"RR" => "Roraima",
		"SC" => "Santa Catarina",
		"SE" => "Sergipe",
		"SP" => "São Paulo",
		"TO" => "Tocantins"
	);
}
