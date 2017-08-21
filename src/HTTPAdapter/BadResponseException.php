<?php

namespace Grummfy\Stathat\HTTPAdapter;

use Psr\Http\Message\ResponseInterface;
use Throwable;

class BadResponseException extends \RuntimeException
{
	public function __construct(ResponseInterface $response, Throwable $previous = null)
	{
		parent::__construct($response->getReasonPhrase(), $response->getStatusCode(), $previous);
	}
}
