<?php
require './code.php';
use PHPUnit\Framework\TestCase;

class KeyPairExampleSolution extends TestCase
{
	private $text = "The quick brown fox jumps over the lazy dog";

    public function testGenerateKeyPair()
    {
		$keyPair = new KeyPairExample();
        $this->assertEquals("OpenSSL key", get_resource_type($keyPair->keyPair));
	}

	public function testEncryptAndDecryptAndNotNull()
	{
		$keyPair = new KeyPairExample();
		$encrypted = $keyPair->encryptWPublicKey($this->text);
		$this->assertNotEquals("", $keyPair->decryptWPrivateKey($encrypted));
		$this->assertEquals($this->text, $keyPair->decryptWPrivateKey($encrypted));
	}

	public function testEncryptAndDecryptNull()
	{
		$keyPair = new KeyPairExample();
		$encrypted = $keyPair->encryptWPublicKey("");
		$this->assertEquals("", $keyPair->decryptWPrivateKey($encrypted));
	}

	public function testSizeKey()
	{
		$keyPair = new KeyPairExample();
		$array = openssl_pkey_get_details($keyPair->keyPair);
		$this->assertEquals(2048, $array["bits"]);
	}

	public function testEncryptAndDecryptWithDifferentKey()
	{
		$keyPair0 = new KeyPairExample();
		$keyPair1 = new KeyPairExample();
		$encrypted = $keyPair0->encryptWPublicKey($this->text);
		$this->assertEquals("", $keyPair1->decryptWPrivateKey($encrypted));
	}

	public function testDifferentKeys()
	{
		$keyPair0 = new KeyPairExample();
		$keyPair1 = new KeyPairExample();
		$this->assertNotEquals($keyPair0, $keyPair1);
	}
   
}

?>
