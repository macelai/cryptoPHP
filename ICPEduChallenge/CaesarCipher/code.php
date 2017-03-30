<?php

/*
CAESAR CIPHER

Your goal is to implement the encrypt and decrypt methods of a caesar cipher.

You have to implement 2 methods, one to encrypt a message, and another to decrypt an encrypted message. Both of them will receive a string, that is the message, and an integer, which is the key that represents how much the alphabet will be shifted.
*/

function caesarEncrypt($plainText, $key) {
	$alphabet = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o',
		'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');

	//verifica maisculas e armazena
	$textSplit = str_split($plainText);
	$n = count($textSplit);
	$array = array();
	for ($i = 0; $i < $n; $i++) {
		if (ctype_upper($textSplit[$i])) {
			array_push($array, $i);
		}
	}

	//trata chaves negativas
	if ($key < 0) {
		$key = ($key%26) + 26;
	}
	
	$plainText = strtolower($plainText);
	$flip = array_flip($alphabet);
	$plain_split = str_split($plainText);
	$num_letters = count($plain_split);
	$encrypted_text = '';
	for ($i = 0; $i < $num_letters; $i++) {
		if (!ctype_alpha($plain_split[$i])) {
				$encrypted_text.=$plain_split[$i];
		} else {
			$encrypted_text.=$alphabet[($flip[$plain_split[$i]]+$key)%26];
		}
	}
	//transforma em maisculas novamente
	for ($i = 0; $i < sizeof($array); $i++) {
		$encrypted_text[$array[$i]] = strtoupper($encrypted_text[$array[$i]]);
	}

	return $encrypted_text;

}
 
function caesarDecrypt($cipherText, $key) {
    $alphabet = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o',
		'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');

    //verifica maisculas e armazena
	$textSplit = str_split($cipherText);
    $n = count($textSplit);
    $array = array();
    for ($i = 0; $i < $n; $i++) {
        if (ctype_upper($textSplit[$i])) {
            array_push($array, $i);
        }
	}

	//trata chaves negativas
	if ($key < 0) {
		$key = ($key%26) + 26;
	}

	$cipherText = strtolower($cipherText);
    $flip = array_flip($alphabet);
	$encrypted_text = str_split($cipherText);
	$num_letters = count($encrypted_text);
	$decrypted_text='';
	for ($i=0; $i < $num_letters; $i++) {
		if (!ctype_alpha($encrypted_text[$i])) {
			$decrypted_text.=$encrypted_text[$i];
		} else {
			$decrypted_text.=$alphabet[(26+$flip[$encrypted_text[$i]]-$key%26)%26];
		}
	}

    //transforma em maisculas novamente
    for ($i = 0; $i < sizeof($array); $i++) {
        $decrypted_text[$array[$i]] = strtoupper($decrypted_text[$array[$i]]);
    }

	return $decrypted_text;
}
?>
