<?php

require './code.php';

class CertificateSolution extends PHPUnit_Framework_TestCase
{  
    public function testCreateCACert()
    {
        $keyPair = new KeyPairExample();
        $caName = "Root Certification Authority";
        $caCert = createCACert($caName, $keyPair);
        $this->assertEquals($caName, openssl_x509_parse($caCert)["subject"]["CN"]);
    }
}

?>
