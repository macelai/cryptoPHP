<?php

class KeyPairExample
{
    public $keyPair;
   
    function __construct () {
		$this->keyPair = openssl_pkey_new();  
    }
 
	public function getPublicKey() {
		$pubKey = openssl_pkey_get_details($this->keyPair);
		$pubKey = $pubKey["key"];
		return $pubKey;
    }  
   
    public function getPrivateKey() {
		$privateKey;
		openssl_pkey_export($this->keyPair, $privateKey);
		return $privateKey;
    }
 
}

?>
