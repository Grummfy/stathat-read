<?php

namespace Grummfy\Stathat;

use Grummfy\Stathat\Data\Frequency;
use Grummfy\Stathat\Data\StatInfo;
use Grummfy\Stathat\Data\StatResult;
use Grummfy\Stathat\Data\StatResults;
use Grummfy\Stathat\HTTPAdapter\AdapterInterface;
use Grummfy\Stathat\HTTPAdapter\BadResponseException;
use Psr\Http\Message\ResponseInterface;

class StatHat
{
	const BASE_URL = 'https://www.stathat.com/x/';

	/**
	 * @var AdapterInterface
	 */
	protected $_adapter;

	/**
	 * @var string
	 */
	protected $_accessToken;

	public function __construct(AdapterInterface $adapter, string $accessToken)
	{
		$this->_adapter = $adapter;
		$this->_accessToken = $accessToken;
	}

	/**
	 * Get the list of all stats available.
	 * If you have more than 10,000 stats, you can specify an offset in your requests to get the next batch of stats.
	 *
	 * @var int $offset
	 * @return StatInfo[]
	 */
	public function listAllStats(int $offset = 0): array
	{
		$url = $this->_assembleUrl('statlist') . '?offset=' . $offset;
		$stats = $this->_adapter->send($this->_adapter->getRequest($url));
		$stats = $this->_explodeResponse($stats);
		$response = array();
		foreach ($stats as $stat)
		{
			$response[] = StatInfo::fromResponse($stat);
		}

		return $response;
	}

	/**
	 * Get information about the stat from the name
	 */
	public function getStatInfoByName(string $statName): StatInfo
	{
		$url = $this->_assembleUrl('stat') . '?name=' . $statName;
		$stat = $this->_adapter->send($this->_adapter->getRequest($url));
		return StatInfo::fromResponse($this->_explodeResponse($stat));
	}

	/**
	 * Get stats summary data from the ids of stats, starting at the given time (or 1 week ago, if null)
	 */
	public function getStatsSummaryById(Frequency $frequency, ?int $startTime = null, string ...$statId): StatResult
	{
		$url = $this->_assembleUrl('data', ...$statId) . '?summary=' . $frequency;
		$url .= $startTime ? ('&start=' . $startTime) : '';
		$stats = $this->_adapter->send($this->_adapter->getRequest($url));
		return StatResult::fromResponse($this->_explodeResponse($stats));
	}

	/**
	 * Get stats data from the ids of stats, starting at the given time (or 1 week ago, if null)
	 */
	public function getStatsById(Frequency $frequency, ?int $startTime = null, string ...$statId): StatResults
	{
		$url = $this->_assembleUrl('data', ...$statId) . '?t=' . $frequency;
		$url .= $startTime ? ('&start=' . $startTime) : '';
		$stats = $this->_adapter->send($this->_adapter->getRequest($url));

		return StatResults::fromResponse(...$this->_explodeResponse($stats));
	}

	/**
	 * Build the url to request on
	 * @param string[] ...$urlParts
	 *
	 * @return string
	 */
	protected function _assembleUrl(string ...$urlParts): string
	{
		return self::BASE_URL . $this->_accessToken . '/' . implode('/', $urlParts);
	}

	/**
	 * Check the response and transform it to data
	 * @param ResponseInterface $response
	 *
	 * @return \stdClass|array
	 * @throws BadResponseException
	 */
	protected function _explodeResponse(ResponseInterface $response)
	{
		if ($response->getStatusCode() !== 200 || !($data = json_decode($response->getBody())))
		{
			throw new BadResponseException($response);
		}

		return $data;
	}
}
