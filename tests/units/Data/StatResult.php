<?php

namespace tests\units\Grummfy\Stathat\Data;

use Grummfy\Stathat\Data\Stat;

class StatResult extends \atoum
{
	public function testAll()
	{
		$std = (object) [
			'name' => 'Some Name',
			'timeframe' => '' . time(),
			'points' => [
				(object)[
					'time' => time() - 36,
					'value' => 123.456
				],
				(object)[
					'time' => time() - 24,
					'value' => 456.123
				],
				(object)[
					'time' => time() - 12,
					'value' => 789.123
				],
			],
		];

		$points = array();
		foreach ($std->points as $point)
		{
			$points[] = Stat::fromResponse($point);
		}

		$this->given(
			$this->newTestedInstance(
				$std->name,
				$std->timeframe,
				$points
			),
			$object = $this->testedInstance::fromResponse($std)
		)
		->then(
			$this->string($this->testedInstance->getName())->isIdenticalTo($std->name),
			$this->string($object->getName())->isIdenticalTo($std->name),
			$this->string($this->testedInstance->getTimeframe())->isIdenticalTo($std->timeframe),
			$this->string($object->getTimeframe())->isIdenticalTo($std->timeframe),
			$this->array($this->testedInstance->getPoints())->isEqualTo($points),
			$this->array($object->getPoints())->isEqualTo($points)
		);
	}
}
