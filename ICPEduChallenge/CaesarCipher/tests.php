<?php

require './code.php';

class CaesarCipherTest extends PHPUnit_Framework_TestCase
{
    public function testEncrypt()
    {
        $this->assertEquals("bcd", caesarEncrypt("abc", 1));
    }
}

?>
