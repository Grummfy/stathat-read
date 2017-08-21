<?php

namespace Grummfy\Stathat\HTTPAdapter;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface AdapterInterface
{
	public function send(RequestInterface $request): ResponseInterface;

	public function getRequest(string $uri): RequestInterface;
}
