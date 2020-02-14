<?php

namespace App\Helpers;

use Carbon\Carbon;

class DataHelper {

	// ******************** FERNANDO ******************************
	private $originalFontSize;
	private $fontSize;

	public function __construct( $originalFontSize = 40 ) {
		$this->originalFontSize = $originalFontSize;
	}

	static public function getReal2Float( $value ) {
		return floatval( str_replace( ',', '.', str_replace( '.', '', $value ) ) );
	}

	static public function getFloat2Real( $value ) {
		return number_format( $value, 2, ',', '.' );
	}

	static public function getFloat2RealMoney( $value ) {
		return 'R$ ' . number_format( $value, 2, ',', '.' );
	}

	// ******************** FUNCTIONS ******************************

	static public function getPrettyDateTime( $value ) {
		return ( $value != null ) ? Carbon::createFromFormat( 'Y-m-d H:i:s', $value )->format( 'H:i - d/m/Y' ) : $value;
	}

	static public function getPrettyDate( $value ) {
		return ( $value != null ) ? Carbon::createFromFormat( 'Y-m-d', $value )->format( 'd/m/Y' ) : $value;
	}

	static public function setDate( $value ) {
		return ( ( $value != null ) && ( $value != '' ) ) ? Carbon::createFromFormat( 'd/m/Y', $value )->format( 'Y-m-d' ) : null;
	}

	static public function setDateToDateTime( $value ) {
		if ( $value != null ) {
			$value = self::getOnlyNumbers( $value );
			if ( strlen( $value ) < 8 ) {
				$value = null;
			} else {
				$value = Carbon::createFromFormat( 'dmY', $value )->format( 'Y-m-d H:i:s' );
			}
		}

		return $value;
	}

	static public function getOnlyNumbers( $value ) {
		return ( $value != null ) ? preg_replace( "/[^0-9]/", "", $value ) : $value;
	}

	static public function getShortName( $value ) {
		$value = explode( ' ', $value );

		return ( count( $value ) > 1 ) ? ( $value[0] . " " . end( $value ) ) : $value[0];
	}

	static public function mask( $val, $mask ) {
		if ( $val != null || $val != "" ) {
			$maskared = '';
			$k        = 0;
			for ( $i = 0; $i <= strlen( $mask ) - 1; $i ++ ) {
				if ( $mask[ $i ] == '#' ) {
					if ( isset( $val[ $k ] ) ) {
						$maskared .= $val[ $k ++ ];
					}
				} else {
					if ( isset( $mask[ $i ] ) ) {
						$maskared .= $mask[ $i ];
					}
				}
			}
		} else {
			$maskared = null;
		}

		return $maskared;
	}

	static public function url( $str ) {
		$str = strtolower( utf8_decode( $str ) );
		$i   = 1;
		$str = strtr( $str, utf8_decode( 'àáâãäåæçèéêëìíîïñòóôõöøùúûýýÿ' ), 'aaaaaaaceeeeiiiinoooooouuuyyy' );
		$str = preg_replace( "/([^a-z0-9])/", '-', utf8_encode( $str ) );
		while ( $i > 0 ) {
			$str = str_replace( '--', '-', $str, $i );
		}
		if ( substr( $str, - 1 ) == '-' ) {
			$str = substr( $str, 0, - 1 );
		}

		return $str;
	}

	static public function extenso( $valor = 0, $maiusculas = false ) {

		$singular = array( "centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão" );
		$plural   = array(
			"centavos",
			"reais",
			"mil",
			"milhões",
			"bilhões",
			"trilhões",
			"quatrilhões"
		);

		$c   = array(
			"",
			"cem",
			"duzentos",
			"trezentos",
			"quatrocentos",
			"quinhentos",
			"seiscentos",
			"setecentos",
			"oitocentos",
			"novecentos"
		);
		$d   = array(
			"",
			"dez",
			"vinte",
			"trinta",
			"quarenta",
			"cinquenta",
			"sessenta",
			"setenta",
			"oitenta",
			"noventa"
		);
		$d10 = array(
			"dez",
			"onze",
			"doze",
			"treze",
			"quatorze",
			"quinze",
			"dezesseis",
			"dezesete",
			"dezoito",
			"dezenove"
		);
		$u   = array(
			"",
			"um",
			"dois",
			"três",
			"quatro",
			"cinco",
			"seis",
			"sete",
			"oito",
			"nove"
		);

		$z  = 0;
		$rt = "";

		$valor   = number_format( $valor, 2, ".", "." );
		$inteiro = explode( ".", $valor );
		for ( $i = 0; $i < count( $inteiro ); $i ++ ) {
			for ( $ii = strlen( $inteiro[ $i ] ); $ii < 3; $ii ++ ) {
				$inteiro[ $i ] = "0" . $inteiro[ $i ];
			}
		}

		$fim = count( $inteiro ) - ( $inteiro[ count( $inteiro ) - 1 ] > 0 ? 1 : 2 );
		for ( $i = 0; $i < count( $inteiro ); $i ++ ) {
			$valor = $inteiro[ $i ];
			$rc    = ( ( $valor > 100 ) && ( $valor < 200 ) ) ? "cento" : $c[ $valor[0] ];
			$rd    = ( $valor[1] < 2 ) ? "" : $d[ $valor[1] ];
			$ru    = ( $valor > 0 ) ? ( ( $valor[1] == 1 ) ? $d10[ $valor[2] ] : $u[ $valor[2] ] ) : "";

			$r = $rc . ( ( $rc && ( $rd || $ru ) ) ? " e " : "" ) . $rd . ( ( $rd &&
			                                                                  $ru ) ? " e " : "" ) . $ru;
			$t = count( $inteiro ) - 1 - $i;
			$r .= $r ? " " . ( $valor > 1 ? $plural[ $t ] : $singular[ $t ] ) : "";
			if ( $valor == "000" ) {
				$z ++;
			} elseif ( $z > 0 ) {
				$z --;
			}
			if ( ( $t == 1 ) && ( $z > 0 ) && ( $inteiro[0] > 0 ) ) {
				$r .= ( ( $z > 1 ) ? " de " : "" ) . $plural[ $t ];
			}
			if ( $r ) {
				$rt = $rt . ( ( ( $i > 0 ) && ( $i <= $fim ) &&
				                ( $inteiro[0] > 0 ) && ( $z < 1 ) ) ? ( ( $i < $fim ) ? ", " : " e " ) : " " ) . $r;
			}
		}

		if ( ! $maiusculas ) {
			return ( $rt ? $rt : "zero" );
		} else {
			if ( $rt ) {
				$rt = preg_replace( "/ E /", " e ", ucwords( $rt ) );
			}

			return ( ( $rt ) ? ( $rt ) : "Zero" );
		}
	}

	static public function convert_number_to_words( $number ) {

		$hyphen      = '-';
		$conjunction = ' e ';
		$separator   = ', ';
		$negative    = 'menos ';
		$decimal     = ' ponto ';
		$dictionary  = array(
			0                   => 'zero',
			1                   => 'um',
			2                   => 'dois',
			3                   => 'três',
			4                   => 'quatro',
			5                   => 'cinco',
			6                   => 'seis',
			7                   => 'sete',
			8                   => 'oito',
			9                   => 'nove',
			10                  => 'dez',
			11                  => 'onze',
			12                  => 'doze',
			13                  => 'treze',
			14                  => 'quatorze',
			15                  => 'quinze',
			16                  => 'dezesseis',
			17                  => 'dezessete',
			18                  => 'dezoito',
			19                  => 'dezenove',
			20                  => 'vinte',
			30                  => 'trinta',
			40                  => 'quarenta',
			50                  => 'cinquenta',
			60                  => 'sessenta',
			70                  => 'setenta',
			80                  => 'oitenta',
			90                  => 'noventa',
			100                 => 'cento',
			200                 => 'duzentos',
			300                 => 'trezentos',
			400                 => 'quatrocentos',
			500                 => 'quinhentos',
			600                 => 'seiscentos',
			700                 => 'setecentos',
			800                 => 'oitocentos',
			900                 => 'novecentos',
			1000                => 'mil',
			1000000             => array( 'milhão', 'milhões' ),
			1000000000          => array( 'bilhão', 'bilhões' ),
			1000000000000       => array( 'trilhão', 'trilhões' ),
			1000000000000000    => array( 'quatrilhão', 'quatrilhões' ),
			1000000000000000000 => array( 'quinquilhão', 'quinquilhões' )
		);

		if ( ! is_numeric( $number ) ) {
			return false;
		}

		if ( ( $number >= 0 && (int) $number < 0 ) || (int) $number < 0 - PHP_INT_MAX ) {
			// overflow
			trigger_error(
				'convert_number_to_words só aceita números entre ' . PHP_INT_MAX . ' à ' . PHP_INT_MAX,
				E_USER_WARNING
			);

			return false;
		}

		if ( $number < 0 ) {
			return $negative . convert_number_to_words( abs( $number ) );
		}

		$string = $fraction = null;

		if ( strpos( $number, '.' ) !== false ) {
			list( $number, $fraction ) = explode( '.', $number );
		}

		switch ( true ) {
			case $number < 21:
				$string = $dictionary[ $number ];
				break;
			case $number < 100:
				$tens   = ( (int) ( $number / 10 ) ) * 10;
				$units  = $number % 10;
				$string = $dictionary[ $tens ];
				if ( $units ) {
					$string .= $conjunction . $dictionary[ $units ];
				}
				break;
			case $number < 1000:
				$hundreds  = floor( $number / 100 ) * 100;
				$remainder = $number % 100;
				$string    = $dictionary[ $hundreds ];
				if ( $remainder ) {
					$string .= $conjunction . convert_number_to_words( $remainder );
				}
				break;
			default:
				$baseUnit     = pow( 1000, floor( log( $number, 1000 ) ) );
				$numBaseUnits = (int) ( $number / $baseUnit );
				$remainder    = $number % $baseUnit;
				if ( $baseUnit == 1000 ) {
					$string = convert_number_to_words( $numBaseUnits ) . ' ' . $dictionary[1000];
				} elseif ( $numBaseUnits == 1 ) {
					$string = convert_number_to_words( $numBaseUnits ) . ' ' . $dictionary[ $baseUnit ][0];
				} else {
					$string = convert_number_to_words( $numBaseUnits ) . ' ' . $dictionary[ $baseUnit ][1];
				}
				if ( $remainder ) {
					$string .= $remainder < 100 ? $conjunction : $separator;
					$string .= convert_number_to_words( $remainder );
				}
				break;
		}

		if ( null !== $fraction && is_numeric( $fraction ) ) {
			$string .= $decimal;
			$words  = array();
			foreach ( str_split( (string) $fraction ) as $number ) {
				$words[] = $dictionary[ $number ];
			}
			$string .= implode( ' ', $words );
		}

		return $string;
	}
}