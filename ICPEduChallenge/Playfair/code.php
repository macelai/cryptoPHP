<?php
class PlayfairExample
{
	public $matrix = array();

	function __construct ($key) {
		$alphabet="ABCDEFGHIKLMNOPQRSTUVWXYZ";

		//format string
		$key = strtoupper($key);
		$key = str_replace(" ", "", $key);
	
		//delete repetitive letters and special caracters
		for ($i = 0; $i < strlen($key); $i++) {
			if (!ctype_alpha($key[$i])) {
				$key = substr_replace($key, "", $i, 1);
				$i--;
			}
			if (substr_count($key, $key[$i]) > 1) {
				for ($j = $i + 1; $j < strlen($key); $j++) {
					if ($key[$i] == $key[$j]) {
						$key = substr_replace($key, "", $j, 1);
					}
				}
			}
		}
		//build matrix
		for ($i = 0; $i < strlen($key); $i++) {
			$matrix[$i] = $key[$i];
		}
		for ($i = 0; $i < strlen($alphabet); $i++) {
			if (substr_count($key, $alphabet[$i]) == 0) {
				array_push($matrix, $alphabet[$i]);
			}
		}
		$this->matrix = $matrix;
	}

	public function encrypt($plainText) {
		//format string
		$plainText = strtoupper($plainText);
		$plainText = str_replace(" ","", $plainText);
		$special = array();
		$index = array();
		//get special caracters
		for ($i = 0; $i < strlen($plainText); $i++) {
			if (!ctype_alpha($plainText[$i])) {
				array_push($special, $plainText[$i]);
				array_push($index, $i);
			}	
		}
		//remove special caracters
		for ($i = 0; $i < strlen($plainText); $i++) {
			if (!ctype_alpha($plainText[$i])) {
				$plainText = substr_replace($plainText, "", $i, 1);
				$i--;
			}
		}
		//insert 'x' if there are two identical letters in pairs
		for ($i = 0; $i < strlen($plainText)/2; $i += 2) {
			if ($plainText[$i] == $plainText[$i+1]) {
				$str0 = substr($plainText, 0, $i + 1);
				$str1 = substr($plainText, $i + 1, strlen($plainText));
				$plainText = $str0.'X'.$str1;
			}
		}
		
		//insert 'x' if odd
		if (strlen($plainText) % 2) {
			$plainText .= 'X';
		}
		//encrypt
		$encrypted = "";
		for ($i = 0; $i < strlen($plainText); $i += 2) {
			//compute coords
			$x0 = array_search($plainText[$i], $this->matrix) % 5;
			$y0 = intval(array_search($plainText[$i], $this->matrix) / 5);
			$x1 = array_search($plainText[$i + 1], $this->matrix) % 5;
			$y1 = intval(array_search($plainText[$i + 1], $this->matrix) / 5);

			if ($y0 == $y1) {
				//same line
				$encrypted .= $this->matrix[5 * $y0 + (($x0 + 1) % 5)];
				$encrypted .= $this->matrix[5 * $y1 + (($x1 + 1) % 5)];
			} elseif ($x0 == $x1) {
				//same column
				$encrypted .= $this->matrix[5 * (($y0 + 1) % 5) + $x0];
				$encrypted .= $this->matrix[5 * (($y1 + 1) % 5) + $x1];
			} else {
				//line and column are different
				$encrypted .= $this->matrix[(5 * $y0 + $x1)];
				$encrypted .= $this->matrix[(5 * $y1 + $x0)];
			}
		}
		//put special back
		$encrypted = str_split($encrypted);
		for ($i = 0; $i < sizeof($special); $i++) {
			$aux = implode(array_slice($encrypted, 0, $index[$i]));
			$aux1 = implode(array_slice($encrypted, $index[$i], sizeof($encrypted)));
			$encrypted = $aux.$special[$i].$aux1;
			$encrypted = str_split($encrypted);
		}
		$encrypted = implode($encrypted);
		return($encrypted);
	}  
   
	public function decrypt($cipherText) {
		$decrypted = "";
		$index = array();
		$special = array();
		//get special caracters
		for ($i = 0; $i < strlen($cipherText); $i++) {
			if (!ctype_alpha($cipherText[$i])) {
				array_push($special, $cipherText[$i]);
				array_push($index, $i);
			}	
		}
		//remove special caracters
		for ($i = 0; $i < strlen($cipherText); $i++) {
			if (!ctype_alpha($cipherText[$i])) {
				$cipherText = substr_replace($cipherText, "", $i, 1);
				$i--;
			}
		}
		for($i = 0; $i < strlen($cipherText); $i += 2) {
			//compute coords
			$x0 = array_search($cipherText [$i], $this->matrix) % 5;
			$y0 = intval(array_search($cipherText[$i], $this->matrix) / 5);
			$x1 = array_search($cipherText [$i + 1], $this->matrix) % 5;
			$y1 = intval(array_search($cipherText[$i + 1], $this->matrix) / 5);
			if ($y0 == $y1) {
				//same line
				$decrypted .= $this->matrix[5 * $y0 + (($x0 + 4) % 5)];
				$decrypted .= $this->matrix[5 * $y1 + (($x1 + 4) % 5)];
			} elseif ($x0 == $x1) {
				//same column
				$decrypted .= $this->matrix[5 * (($y0 + 4) % 5) + $x0];
				$decrypted .= $this->matrix[5 * (($y1 + 4) % 5) + $x1];
			} else {
				//line and column are different
				$decrypted .= $this->matrix[(5 * $y0 + $x1)];
				$decrypted .= $this->matrix[(5 * $y1 + $x0)];
			}
		}
		//put special back
		$decrypted = str_split($decrypted);
		for ($i = 0; $i < sizeof($special); $i++) {
			$aux = implode(array_slice($decrypted, 0, $index[$i]));
			$aux1 = implode(array_slice($decrypted, $index[$i], sizeof($decrypted)));
			$decrypted = $aux.$special[$i].$aux1;
			$decrypted = str_split($decrypted);
		}
		$decrypted = implode($decrypted);
		$decrypted = strtolower($decrypted);
		return $decrypted;
	}
}
$class = new PlayfairExample("playfair example");
$class->decrypt("12VIKZ");
?>
