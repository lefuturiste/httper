<?php

namespace Httper;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class Request implements RequestInterface
{
	/**
	 * @var StreamInterface
	 */
	private $body;
	/**
	 * @var string
	 */
	private $method;
	/**
	 * @var UriInterface
	 */
	private $uri;
	/**
	 * @var array
	 */
	private $headers = [];

	public function withJson($data)
	{
		$this->withBody((new Stream(json_encode($data))));
		return $this;
	}

	public function withBody(StreamInterface $body)
	{
		$this->body = $body;
		return $this;
	}

	public function withProtocolVersion($version)
	{
		// TODO: Implement withProtocolVersion() method.
	}

	public function withAddedHeader($name, $value)
	{
		$this->headers[$name] = $value;
		return $this;
	}

	public function withHeader($name, $value)
	{
		$this->headers[$name] = $value;
		return $this;
	}

	public function withUri(UriInterface $uri, $preserveHost = false)
	{
		$this->uri = $uri;
		return $this;
	}

	public function withMethod($method)
	{
		$this->method = $method;
		return $this;
	}

	public function withoutHeader($name)
	{
		unset($this->headers[$name]);
		return $this;
	}

	public function withRequestTarget($requestTarget)
	{
		// TODO: Implement withRequestTarget() method.
	}

	public function getProtocolVersion()
	{
		// TODO: Implement getProtocolVersion() method.
	}

	public function getHeaderLine($name)
	{
		// TODO: Implement getHeaderLine() method.
	}

	public function getHeaders()
	{
		return $this->headers;
	}

	public function getBody()
	{
		return $this->body;
	}

	public function getHeader($name)
	{
		if (isset($this->headers[$name]))
			return $this->headers[$name];
		else
			return NULL;
	}

	public function getMethod()
	{
		return $this->method;
	}

	public function getUri()
	{
		return $this->uri;
	}

	public function getRequestTarget()
	{
		// TODO: Implement getRequestTarget() method.
	}

	public function hasHeader($name)
	{
		return isset($this->headers[$name]);
	}

	public function parseHeaders()
	{
		$str = "";
		foreach ($this->headers as $headerKey => $headerValue){
			$str .= "{$headerKey}: {$headerValue}\r\n";
		}
		return $str;
	}
}