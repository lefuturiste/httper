<?php

class RequestTest extends \PHPUnit\Framework\TestCase
{
    public function testGetNotFoundGoogleRequest()
    {
        $client = new \Httper\Client();
        $response = $client->request((new \Httper\Request())
            ->withUri(new \Httper\Uri("https://google.com/impoverishment"))
            ->withMethod("GET")
            ->withHeader("Cache-Control", "no-cache")
        );
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('HTTP/1.0', $response->getProtocolVersion());
        $this->assertEquals('Not Found', $response->getReasonPhrase());
    }

    public function testGetNotFoundJsonPlaceholderRequest()
    {
        $client = new \Httper\Client();
        $response = $client->request((new \Httper\Request())
            ->withUri(new \Httper\Uri("https://jsonplaceholder.typicode.com/posts/888"))
            ->withMethod("GET")
            ->withHeader("Cache-Control", "no-cache")
        );
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('HTTP/1.1', $response->getProtocolVersion());
        $this->assertEquals('Not Found', $response->getReasonPhrase());
    }

    public function testGetOKCloudFlareRequest()
    {
        $client = new \Httper\Client();
        $response = $client->request((new \Httper\Request())
            ->withUri(new \Httper\Uri("https://www.cloudflare.com"))
            ->withMethod("GET")
        );
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('HTTP/1.1', $response->getProtocolVersion());
        $this->assertEquals('OK', $response->getReasonPhrase());
    }

    public function testGetJsonNpmApi()
    {
        $client = new \Httper\Client();
        $response = $client->request((new \Httper\Request())->withMethod("GET")->withUri(new \Httper\Uri("https://www.npmjs.com/search?q=docker"))->withHeader("x-spiferack", true));
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("application/json", $response->getHeader("Content-Type"));
        $this->assertInternalType('object', $response->getParsedBody());
    }

    public function testJsonEncode()
    {
//        $client = new \Httper\Client();
        $request = (new \Httper\Request())
            ->withMethod('POST')
            ->withUri(new \Httper\Uri('http://example.com'))
            ->withJson([
                'lel' => 'lel'
            ]);
        $this->assertInternalType("object", $request);
        $this->assertInternalType("string", $request->getUri()->getHost());
        $this->assertEquals('application/json', $request->getHeader('Content-Type'));
        $this->assertEquals(json_encode(['lel' => 'lel']), $request->getBody()->getContents());
    }

    public function testBasicAuth()
    {
//        $client = new \Httper\Client();
        $request = (new \Httper\Request())
            ->withMethod('GET')
            ->withUri(new \Httper\Uri('http://example.com'))
            ->withBasicAuth("username", "password");
        $this->assertInternalType("object", $request);
        $this->assertInternalType("string", $request->getUri()->getHost());
        $this->assertEquals('Basic ' . base64_encode('username:password'), $request->getHeader('Authorization'));
    }

}