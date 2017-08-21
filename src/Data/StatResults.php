<?php

namespace Grummfy\Stathat\Data;

class StatResults
{
	/**
	 * @var StatResult[]
	 */
	protected $_results;

	public static function fromResponse(\stdClass ...$datas): StatResults
	{
		$stats = array();
		foreach ($datas as $data)
		{
			$stats[] = StatResult::fromResponse($data);
		}

		return new self(...$stats);
	}

	protected function __construct(StatResult ...$results)
	{
		$this->_results = $results;
	}

	/**
	 * @return StatResult[]
	 */
	public function getResults(): array
	{
		return $this->_results;
	}
}
