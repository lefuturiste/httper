<?php

class UriTest extends \PHPUnit\Framework\TestCase
{
	public function testCreateUri(){
		$uri = new \Httper\Uri("https://example.com");
		$this->assertEquals(NULL, $uri->getPort());
		$this->assertEquals(NULL, $uri->getUserInfo());
		$this->assertEquals("example.com", $uri->getAuthority());
		$this->assertEquals("example.com", $uri->getHost());
		$this->assertEquals("https", $uri->getScheme());
	}
}