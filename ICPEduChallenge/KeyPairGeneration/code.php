<?php

/*
KEY PAIR GENERATION
 
Your goal is to generate a key pair using php openssl functions.
 
You have to implement the constructor and all four functions of the class KeyPairExample.

PHP OpenSSL functions should be used. Information about those can be found on http://php.net/manual/en/ref.openssl.php
*/

class KeyPairExample
{
    public $keyPair;
   
    function __construct () {
		//should create a new key pair, and store it on $this->keyPair
		$this->keyPair = openssl_pkey_new();
    }
 
    public function getPublicKeyPem() {
		//returns the public key of the key pair on PEM format
		$pubKey = openssl_pkey_get_details($this->keyPair);
		$pubKey = $pubKey["key"];
		return $pubKey;
    }  
   
    public function getPrivateKeyPem() {
		//returns the private key of the key pair on PEM format
		$privateKey;
		openssl_pkey_export($this->keyPair, $privateKey);
		return $privateKey;
    }
   
    public function encryptWPublicKey($data) {
		//encrypts data with the public key
		$encrypted;
		openssl_public_encrypt($data, $encrypted, $this->getPublicKeyPem());
		return $encrypted;
    }
   
    public function decryptWPrivateKey($data) {
		//decrypts data with the private key
		$decrypted;
		openssl_private_decrypt($data, $decrypted, $this->getPrivateKeyPem());
		return $decrypted;
    }
 
}
