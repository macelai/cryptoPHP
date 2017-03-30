<?php
require './code.php';
class KeyPairExampleSolution extends PHPUnit_Framework_TestCase
{
   
    public function testGenerateKeyPair()
    {
        $keyPair = new KeyPairExample();
        $this->assertEquals("OpenSSL key", get_resource_type($keyPair->keyPair));
    }
   
}

?>
