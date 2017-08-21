<?php

namespace tests\units\Grummfy\Stathat\Data;

class Frequency extends \atoum
{
	public function testAll()
	{
		$this->newTestedInstance('2m');
		$this->object($this->testedInstance::with($this->testedInstance::MINUTE, 2))
			->isEqualTo($this->testedInstance);

		$this->castToString($this->testedInstance::with($this->testedInstance::MINUTE, 2))
			->isEqualTo('2m');

		$this->object($this->testedInstance::addWith($this->testedInstance::with($this->testedInstance::WEEK, 3), $this->testedInstance::MINUTE, 2))
			->isEqualTo($this->newTestedInstance('3w2m'));
	}
}
