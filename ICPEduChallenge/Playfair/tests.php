<?php
use PHPUnit\Framework\Testcase;
require './code.php';

class PlayfairTest extends TestCase {
	private $plainText = "test";
	private $cipherText = "VIKZ";
	private $plain = "show";
	private $encrypted = "ZSQV";
	private $encryptedSpecial = "1@#VIKZ!";
	
	public function testEncrypt()
	{
		$cipher = new PlayfairExample("playfair example");
		$this->assertEquals($this->cipherText, $cipher->encrypt($this->plainText));
	}

	public function testEncryptWithSpecial() 
	{
		$cipher = new PlayfairExample("example123, playfair!@#");
		$this->assertEquals($this->encrypted, $cipher->encrypt($this->plain));
	}

	public function testDecrypt()
	{
		$cipher = new PlayfairExample("playfair example");
		$this->assertEquals($this->plainText, $cipher->decrypt($this->cipherText));
	}

	public function testDecryptWithSpecial()
	{
		$cipher = new PlayfairExample("example123, playfair!@#");
		$this->assertEquals($this->plain, $cipher->decrypt($this->encrypted));
	}

	public function testEncryptWithSpecialInput()
	{
		$cipher = new PlayfairExample("playfair example");
		$this->assertEquals($this->encryptedSpecial, $cipher->encrypt("1@#test!")); 
	}

	public function testDecryptWithSpecialInput()
	{
		$cipher = new PlayfairExample("playfair example");
		$this->assertEquals("1@#test!", $cipher->decrypt($this->encryptedSpecial));
	}

}

?>
