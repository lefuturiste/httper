<?php

namespace Httper;

use League\Uri\Parser;
use Psr\Http\Message\UriInterface;

class Uri implements UriInterface
{
	private $uri;
	private $scheme;
	private $host;
	private $query;
	private $port;
	private $fragment;
	private $path;
	private $userInfo;
	private $authority;

	public function __construct($uri = "")
	{
		$parser = (new Parser())->parse($uri);
		$this->scheme = $parser['scheme'];
		$this->host = strtolower($parser['host']);
		$this->port = $parser['port'];
		$this->path = $parser['path'];
		$this->query = $parser['query'];
		$this->authority = $parser['host'];
		$this->userInfo = $parser['user'];
		if ($parser['pass'] != NULL) {
			$this->userInfo .= $parser['pass'];
		}
		if ($this->userInfo != NULL) {
			$this->authority = $this->userInfo . '@' . $this->authority;
		}
		if ($this->port != NULL) {
			$this->authority .= $this->port;
		}
		$this->fragment = $parser['fragment'];
		$this->uri = $uri;
	}

	public function __toString()
	{
		return $this->uri;
	}

	public function getScheme()
	{
		return $this->scheme;
	}

	public function getFragment()
	{
		return $this->fragment;
	}

	public function getHost()
	{
		return $this->host;
	}

	public function getPath()
	{
		return $this->path;
	}

	public function getAuthority()
	{
		return $this->authority;
	}

	public function getPort()
	{
		return $this->port;
	}

	public function getQuery()
	{
		return $this->query;
	}

	public function getUserInfo()
	{
		return $this->userInfo;
	}

	public function withFragment($fragment)
	{
		// TODO: Implement withFragment() method.
	}

	public function withHost($host)
	{
		// TODO: Implement withHost() method.
	}

	public function withPath($path)
	{
		// TODO: Implement withPath() method.
	}

	public function withPort($port)
	{
		// TODO: Implement withPort() method.
	}

	public function withQuery($query)
	{
		// TODO: Implement withQuery() method.
	}

	public function withScheme($scheme)
	{
		// TODO: Implement withScheme() method.
	}

	public function withUserInfo($user, $password = NULL)
	{
		// TODO: Implement withUserInfo() method.
	}
}