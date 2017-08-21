<?php

namespace Grummfy\Stathat\Data;

class Stat
{
	/**
	 * @var int
	 */
	protected $_time;

	/**
	 * @var float
	 */
	protected $_value;

	public static function fromResponse(\stdClass $data): self
	{
		return new self($data->time, $data->value);
	}

	public function __construct(int $time, float $value)
	{
		$this->_time = $time;
		$this->_value = $value;
	}

	public function getTime(): int
	{
		return $this->_time;
	}

	public function getValue(): float
	{
		return $this->_value;
	}
}
