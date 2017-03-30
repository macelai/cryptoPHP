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

    public function encryptWPublicKey($data) {
		$encrypted;
		openssl_public_encrypt($data, $encrypted, $this->getPublicKeyPem());
		return $encrypted;
    }

    public function decryptWPrivateKey($data) {
		$decrypted;
		openssl_private_decrypt($data, $decrypted, $this->getPrivateKeyPem());
		return $decrypted;
    }
   
    public function getHash($data) {
        return openssl_digest($data, openssl_get_md_methods()[4]);
    }
   
    public function encryptWPrivateKey($data)
    {
        openssl_private_encrypt($data, $encrypted, $this->getPrivateKey());
        return base64_encode($encrypted);
    }
 
    public function decryptWPublicKey($data)
    {
        openssl_public_decrypt(base64_decode($data), $decrypted, $this->getPublicKey());
        return $decrypted;
    }
 
}

?>
