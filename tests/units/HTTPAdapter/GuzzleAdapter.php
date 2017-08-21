<?php

namespace tests\units\Grummfy\Stathat\HTTPAdapter;

use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GuzzleAdapter extends \atoum
{
	public function testAll(Client $client, RequestInterface $request, ResponseInterface $response)
	{
		$this->newTestedInstance($client);
		$this->calling($client)->send = $response;
		$this->calling($request)->withHeader = $request;
		$this->object($this->testedInstance->send($request))
			->isEqualTo($response);

		$this->mock($request)->call('withHeader')->once;
		$this->mock($client)->call('send')->once;
	}
}
