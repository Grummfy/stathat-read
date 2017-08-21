<?php

namespace Grummfy\Stathat\Data;

class Frequency
{
	const MINUTE = 'm';
	const HOUR = 'h';
	const DAY = 'd';
	const WEEK = 'w';
	const MONTH = 'M';
	const YEAR = 'y';

	/**
	 * @var string
	 */
	protected $_frequency;

	public static function with(string $period, int $quantity = 1): self
	{
		return new self($quantity . $period);
	}

	public static function addWith(Frequency $frequency, string $period, int $quantity = 1): self
	{
		return new self($frequency . (new self($quantity . $period)));
	}

	public function __construct(string $period)
	{
		$this->_frequency = $period;
	}

	public function getFrequency(): string
	{
		return $this->_frequency;
	}

	public function __toString()
	{
		return $this->getFrequency();
	}
}
