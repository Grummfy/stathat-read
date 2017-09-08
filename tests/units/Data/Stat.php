<?php

namespace tests\units\Grummfy\Stathat\Data;

class Stat extends \atoum
{
	public function testAll()
	{
		$this->given(
			$this->newTestedInstance(5, 42.42)
		)
		->then(
			$this->float($this->testedInstance->getValue())->isEqualTo(42.42),
			$this->integer($this->testedInstance->getTime())->isEqualTo(5)
		);

		$std = (object) [
			'time' => 6,
			'value' => 33.123,
		];

		$this->given($object = $this->testedInstance::fromResponse($std))
			->then(
				$this->float($object->getValue())->isEqualTo(33.123),
				$this->integer($object->getTime())->isEqualTo(6),
				$this->object($object)->isInstanceOfTestedClass()
			);

		$this->object($this->testedInstance)->isInstanceOf(\JsonSerializable::class);
	}
}
