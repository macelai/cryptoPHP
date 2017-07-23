<?php
require './code.php';
use PHPUnit\Framework\TestCase;

class CertificateSolution extends TestCase {

    public function testCreateCACert()
    {
        $keyPair = new KeyPairExample();
        $caName = "Root Certification Authority";
        $caCert = createCACert($caName, $keyPair);
        $this->assertEquals($caName, openssl_x509_parse($caCert)["subject"]["CN"]);
	}

	public function testCreate()
	{
		$keyPair = new KeyPairExample();
		$caName = "Root Certification Authority";
		$caCert = createCACert($caName, $keyPair);
		$this->assertEquals("OpenSSL X.509", get_resource_type($caCert));
	}

	public function testIssueCert()
	{
		$keyPair0 = new KeyPairExample();
		$keyPair1 = new KeyPairExample();
		$caName = "Root Certification Authority";
		$name = "Vinicius Macelai";
		$caCert = createCACert($caName, $keyPair0);
		$cert = issueCert($name, $keyPair1, $caCert, $keyPair0);
		$this->assertEquals($name, openssl_x509_parse($cert)["subject"]["CN"]);
		$this->assertEquals($caName, openssl_x509_parse($cert)["issuer"]["CN"]);
	}
}

?>
