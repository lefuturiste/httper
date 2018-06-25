<?php

namespace Httper;

class Client
{
	public function __construct($options = [])
	{

	}

	/**
	 * The main method of the system
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function request(Request $request): Response
	{
		$opts = [
			'http' => [
				'ignore_errors' => true,
				'method' => $request->getMethod(),
				'header' => $request->parseHeaders()
			]
		];
		if ($request->getMethod() == "POST" || $request->getMethod() == "PUT") {
			$opts['http']['content'] = $request->getBody();
		}

		$context = stream_context_create($opts);
		$result = file_get_contents($request->getUri(), false, $context);
		$response = new Response();
		$response->setHeaders($http_response_header);
		$response->setBody($result);

		return $response;
	}

	/**
	 * Alias of request() method for GET request
	 *
	 * @param $uri
	 * @return Response
	 */
	public function get($uri)
	{
		return $this->request((new Request())->withMethod("GET")->withUri($uri));
	}
}