<?php

namespace App\Helpers;

use Mail;
use App\Clinica;
use App\Orcamento;
use App\Paciente;
use App\Parcela;
use App\ParcelaPagamento;
use App\Resposta;
use Carbon\Carbon;
use \Barryvdh\DomPDF\Facade as PDF;

class PrintHelper {

	static public function recibo( ParcelaPagamento $ParcelaPagamento ) {
//		return view('print.recibo')->with('ParcelaPagamento', $ParcelaPagamento)->with('clinica', Clinica::find(1));
		$pdf      = PDF::loadView( 'print.recibo', [
			'ParcelaPagamento' => $ParcelaPagamento,
			'clinica'          => Clinica::find( 1 )
		] );
		$hora     = Carbon::now()->format( 'HidmY' );
		$filename = 'recibo-' . $hora;

		return $pdf->stream( $filename . '.pdf' );
	}

	static public function prontuario( Paciente $paciente ) {
//        return view('print.prontuario')->with('paciente',$paciente);
		$pdf      = PDF::loadView( 'print.prontuario', [ 'paciente' => $paciente, 'clinica' => Clinica::find( 1 ) ] );
		$hora     = Carbon::now()->format( 'HidmY' );
		$filename = 'prontuario-' . $paciente->nome . '-' . $paciente->idpaciente . '-' . $hora;

		return $pdf->stream( $filename . '.pdf' );
	}

	static public function anamnese( $respostas ) {
		$paciente = $respostas[0]->paciente;
		$pdf      = PDF::loadView( 'print.anamnese', [
			'paciente'  => $paciente,
			'clinica'   => Clinica::find( 1 ),
			'respostas' => $respostas
		] );
		$hora     = Carbon::now()->format( 'HidmY' );
		$filename = 'anamnese-' . $paciente->nome . '-' . $paciente->idpaciente . '-' . $hora;

		return $pdf->stream( $filename . '.pdf' );
	}

	static public function orcamento( Orcamento $orcamento ) {
		$paciente = $orcamento->paciente;
		$clinica  = Clinica::find( 1 );
//        view('print.orcamento')
//            ->with('paciente',$paciente)
//            ->with('clinica',$clinica)
//            ->with('orcamento',$orcamento);
		$pdf      = PDF::loadView( 'print.orcamento', [
			'paciente'  => $paciente,
			'clinica'   => $clinica,
			'orcamento' => $orcamento
		] );
		$hora     = Carbon::now()->format( 'HidmY' );
		$filename = 'orcamento-' . str_slug( $paciente->nome ) . '-' . $paciente->idpaciente . '-' . $hora;

		return $pdf->stream( $filename . '.pdf' );
	}

	static public function sendByEmail( Orcamento $orcamento ) {
		$paciente = $orcamento->paciente;
		$Clinica  = Clinica::first();
		$pdf      = PDF::loadView( 'print.orcamento', [
			'paciente'  => $paciente,
			'clinica'   => Clinica::find( 1 ),
			'orcamento' => $orcamento
		] );
		$hora     = Carbon::now()->format( 'HidmY' );

		$filename = 'orcamento-' . $hora . '.pdf';
		$filePath = '';//'../app/storage/';
		$pdf->save( $filePath . $filename );
		$mailAttachment = $filePath . $filename;
		$msg            = "Este email é automático e não deve ser respondido.
		\nPara respostas utilizar o vinicius@drviniciussilva.com.br";

		Mail::raw( $msg, function ( $message ) use ( $mailAttachment, $paciente, $Clinica ) {
			$message->to( $paciente->getEmail(), $paciente->nome )->subject( $Clinica->nome );
			$message->attach( $mailAttachment );

		} );
		unlink( $filePath . $filename );

		return 'Orçamento enviado com sucesso!';

	}
}