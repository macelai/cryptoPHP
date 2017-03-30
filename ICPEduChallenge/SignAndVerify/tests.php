<?php

require './code.php';

class SignSolution extends PHPUnit_Framework_TestCase
{
    private $message = "Cwm fjord bank glyphs vext quiz.";
   
    public function testSignAndVerify()
    {
        $keyPair = new KeyPairExample();
        $signature = sign($this->message, $keyPair);
        $this->assertTrue(verify($this->message, $signature, $keyPair));
    }
 
}

?>
