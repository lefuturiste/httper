<?php

namespace Httper;

use Psr\Http\Message\StreamInterface;

class Stream implements StreamInterface
{
	private $content;

	public function __construct($content)
	{
		$this->content = $content;
	}

	public function getContents()
	{
		return $this->content;
	}

	public function getMetadata($key = NULL)
	{
		// TODO: Implement getMetadata() method.
	}

	public function getSize()
	{
		// TODO: Implement getSize() method.
	}

	public function __toString()
	{
		// TODO: Implement __toString() method.
	}

	public function read($length)
	{
		// TODO: Implement read() method.
	}

	public function rewind()
	{
		// TODO: Implement rewind() method.
	}

	public function eof()
	{
		// TODO: Implement eof() method.
	}

	public function close()
	{
		// TODO: Implement close() method.
	}

	public function write($string)
	{
		// TODO: Implement write() method.
	}

	public function isWritable()
	{
		// TODO: Implement isWritable() method.
	}

	public function detach()
	{
		// TODO: Implement detach() method.
	}

	public function isReadable()
	{
		// TODO: Implement isReadable() method.
	}

	public function isSeekable()
	{
		// TODO: Implement isSeekable() method.
	}

	public function seek($offset, $whence = SEEK_SET)
	{
		// TODO: Implement seek() method.
	}

	public function tell()
	{
		// TODO: Implement tell() method.
	}
}