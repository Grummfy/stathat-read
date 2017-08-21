<?php

namespace Grummfy\Stathat\Data;

class StatResult
{
	/**
	 * @var Stat[]
	 */
	protected $_points;

	/**
	 * @var string
	 */
	protected $_name;

	/**
	 * @var string
	 */
	protected $_timeframe;

	public static function fromResponse(\stdClass $data): self
	{
		$points = [];
		foreach ($data->points as $point)
		{
			$points[] = Stat::fromResponse($point);
		}

		$stat = new self(
			$data->name,
			$data->timeframe,
			$points
		);

		return $stat;
	}

	public function __construct(string $name, string $timeframe, array $points)
	{
		$this->_name = $name;
		$this->_timeframe = $timeframe;
		$this->_points = $points;
	}

	/**
	 * @return Stat[]
	 */
	public function getPoints(): array
	{
		return $this->_points;
	}

	public function getName(): string
	{
		return $this->_name;
	}

	public function getTimeframe(): string
	{
		return $this->_timeframe;
	}
}
