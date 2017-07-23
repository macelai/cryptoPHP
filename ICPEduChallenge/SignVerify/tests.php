<?php

require './code.php';
use PHPUnit\Framework\TestCase;

class SignSolution extends TestCase
{
    private $message = "Cwm fjord bank glyphs vext quiz.";
   
    public function testSignAndVerifyNotNull()
    {
        $keyPair = new KeyPairExample();
		$signature = sign($this->message, $keyPair);
		$this->assertFalse(verify("", $signature, $keyPair));
        $this->assertTrue(verify($this->message, $signature, $keyPair));
	}

	public function testSignAndVerifyNull()
	{
		$keyPair = new KeyPairExample();
		$signature = sign("", $keyPair);
		$this->assertTrue(verify("", $signature, $keyPair));
	}

	public function testDifferentKeys()
	{
		$keyPair0 = new KeyPairExample();
		$keyPair1 = new KeyPairExample();
		$signature = sign($this->message, $keyPair0);
		$this->assertFalse(verify($this->message, $signature, $keyPair1));
	}

	public function testDifferentSignatures()
	{
		$keyPair = new KeyPairExample();
		$signature0 = sign($this->message, $keyPair);
		$signature1 = sign("The quick brown fox jumps over the lazy dog", $keyPair);
		$this->assertFalse(verify($this->message, $signature1, $keyPair));
	}
 
}

?>
