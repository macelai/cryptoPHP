<?php

require './keypair.php';

/*
CERTIFICATE CHAIN
 
Your goal is to create a Certification Authority's certificate, and another certificate, issued by this CA.
 
You have to implement 2 functions that generate different certificates. The first one to generate a certificate for a Root Certification Authority, and the second one an end user certificate, issued by a CA.

$keyPair is an instance of the class KeyPairExample in ./keypair.php. You must complete this class with your code from previous tasks.
*/

//Generates a certificate for a Root Certification Authority, using given common name $caName and $keyPair
function createCACert($caName, $keyPair) {
	$privKey = $keyPair->getPrivateKey();
	$configs = array(
		"commonName" => $caName
	);
	$certCSR = openssl_csr_new($configs, $privKey);
	$cert = openssl_csr_sign($certCSR, null, $privKey, 365);
	return $cert;
}
 
//Generates a certificate for someone of common name $cn with $keyPair, issued by a certification authority identified by its x509.certificate $caCertificate and key pair $caKeyPair.
function issueCert($cn, $keyPair, $caCertificate, $caKeyPair) {
	$privKeyUser = $keyPair->getPrivateKey();
	$privKeyCA = $caKeyPair->getPrivateKey();
	$configs = array(
		"commonName" => $cn
	);
	$certCSR = openssl_csr_new($configs, $privKeyUser);
	$cert = openssl_csr_sign($certCSR, $caCertificate, $privKeyCA, 365);
	return $cert;
}
?>
