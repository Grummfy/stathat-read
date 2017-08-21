<?php

namespace Grummfy\Stathat\HTTPAdapter;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleAdapter implements AdapterInterface
{
	/**
	 * @var Client
	 */
	protected $_client;

	public function __construct(Client $client)
	{
		$this->_client = $client;
	}

	public function send(RequestInterface $request): ResponseInterface
	{
		$request = $request->withHeader('Accept', 'application/json');
		return $this->_client->send($request);
	}

	public function getRequest(string $uri): RequestInterface
	{
		return new Request('GET', $uri);
	}
}
