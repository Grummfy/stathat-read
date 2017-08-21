<?php

namespace tests\units\Grummfy\Stathat;

use Grummfy\Stathat\HTTPAdapter\AdapterInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class StatHat extends \atoum
{
	public function testListAllStats(AdapterInterface $adapter, ResponseInterface $response, RequestInterface $request)
	{
		$token = uniqid();
		$this->calling($response)->getStatusCode = 200;
		$this->calling($request)->withHeader = $request;
		$tester = $this;
		$this->calling($adapter)->getRequest = function($url) use ($request, $tester, $token)
		{
			$tester->string($url)->isEqualTo($tester->testedInstance::BASE_URL . $token . '/statlist?offset=0');
			return $request;
		};
		$this->calling($response)->getBody = json_encode([
			[
				'id' => md5(uniqid()),
				'name' => 'Some Name',
				'public' => false,
				'counter' => true,
				'classic_key' => md5(uniqid()),
				'data_received_at' => time(),
				'embed_key' => base64_encode(uniqid()),
				'created_at' => time() - 123456,
			],
		]);
		$this->calling($adapter)->send = $response;

		$this->newTestedInstance($adapter, $token);

		$this->array($this->testedInstance->listAllStats())
			->sizeOf(1);
	}
}
