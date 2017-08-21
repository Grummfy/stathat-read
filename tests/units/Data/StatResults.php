<?php

namespace tests\units\Grummfy\Stathat\Data;

class StatResults extends \atoum
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

		$this->given(
			$object = $this->getTestedClassName()::fromResponse(...[$std, $std])
		)
		->then(
			$this->array($object->getResults())->sizeOf(2)
		);
	}
}
