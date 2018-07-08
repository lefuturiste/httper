<?php

namespace Httper;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class Response implements ResponseInterface
{
	/**
	 * @var array
	 */
	private $headers = [];
	/**
	 * @var Stream
	 */
	private $body;
	/**
	 * @var integer
	 */
	private $statusCode;
	private $reasonPhrase;
	private $statusLine;
	private $protocolVersion;

	public function hasHeader($name): bool
	{
		return isset($this->headers[$name]);
	}

	public function getHeader($name)
	{
		if ($this->hasHeader($name))
			return $this->headers[$name];
		else
			return NULL;
	}

	public function getStatusCode(): int
	{
		return $this->statusCode;
	}

	public function getBody(): Stream
	{
		return $this->body;
	}

	public function getHeaders(): array
	{
		return $this->headers;
	}

	public function getHeaderLine($name)
	{
		// TODO: Implement getHeaderLine() method.
	}

	public function getProtocolVersion(): string
	{
		return $this->protocolVersion;
	}

	public function getReasonPhrase(): string
	{
		return $this->reasonPhrase;
	}

	public function withStatus($code, $reasonPhrase = '')
	{
	}

	public function withHeader($name, $value)
	{
	}

	public function withAddedHeader($name, $value)
	{
	}

	public function withBody(StreamInterface $body)
	{
	}

	public function withoutHeader($name)
	{
	}

	public function withProtocolVersion($version)
	{
	}

	public function setHeaders(array $headers)
	{
		$this->statusLine = $headers[0];
		//parse status line
		$re = [
			'/^(HTTPS|HTTP)\/\d.\d/m',
			'/\d{3}/m',
			'/[a-zA-Z ]{2,50}$/m'
		];
		$matches = [];
		preg_match_all($re[0], $this->statusLine, $matches[0], PREG_SET_ORDER, 0);
		preg_match_all($re[1], $this->statusLine, $matches[1], PREG_SET_ORDER, 0);
		preg_match_all($re[2], $this->statusLine, $matches[2], PREG_SET_ORDER, 0);

		$this->statusCode = $matches[1][0][0];
		$this->protocolVersion = $matches[0][0][0];
		$this->reasonPhrase = substr($matches[2][0][0], 1);

		//parse others headers
		unset($headers[0]);
		foreach ($headers as $header){
			$re = '/[a-z A-Z -]{3,50}: /m';

			preg_match_all($re, $header, $matches, PREG_SET_ORDER, 0);

			$name = substr($matches[0][0], 0, -2);
			$value = substr(str_replace($name, "", $header), 2);
			$this->headers[$name] = $value;
		}
	}

	public function setBody($result)
	{
		$this->body = new Stream($result);
	}

	/**
	 * @return string
	 */
	public function getStatusLine()
	{
		return $this->statusLine;
	}

    public function getParsedBody($assoc = false)
    {
        switch ($this->getHeader('Content-Type')){
            case "application/json" || "application/problem+json; charset=utf-8" || "application/json; charset=utf-8":
                return json_decode($this->getBody()->getContents(), $assoc);
                break;
        }
    }
}