<?php

namespace tests\units\Grummfy\Stathat\Data;

class StatInfo extends \atoum
{
	public function testAll()
	{
		$std = (object) [
			'id' => md5(uniqid()),
			'name' => 'Some Name',
			'public' => false,
			'counter' => true,
			'classic_key' => md5(uniqid()),
			'data_received_at' => time(),
			'embed_key' => base64_encode(uniqid()),
			'created_at' => time() - 123456,
		];

		$this->given(
			$this->newTestedInstance(
				$std->id,
				$std->name,
				$std->public,
				$std->counter,
				$std->classic_key,
				$std->data_received_at,
				$std->embed_key,
				$std->created_at
			),
			$object = $this->testedInstance::fromResponse($std)
		)
		->then(
			$this->string($this->testedInstance->getId())->isIdenticalTo($std->id),
			$this->string($object->getId())->isIdenticalTo($std->id),
			$this->string($this->testedInstance->getName())->isIdenticalTo($std->name),
			$this->string($object->getName())->isIdenticalTo($std->name),
			$this->boolean($this->testedInstance->isPublic())->isIdenticalTo($std->public),
			$this->boolean($object->isPublic())->isIdenticalTo($std->public),
			$this->boolean($this->testedInstance->isCounter())->isIdenticalTo($std->counter),
			$this->boolean($object->isCounter())->isIdenticalTo($std->counter),
			$this->string($this->testedInstance->getClassicKey())->isIdenticalTo($std->classic_key),
			$this->string($object->getClassicKey())->isIdenticalTo($std->classic_key),
			$this->integer($this->testedInstance->getDataReceivedAt())->isIdenticalTo($std->data_received_at),
			$this->integer($object->getDataReceivedAt())->isIdenticalTo($std->data_received_at),
			$this->string($this->testedInstance->getEmbedKey())->isIdenticalTo($std->embed_key),
			$this->string($object->getEmbedKey())->isIdenticalTo($std->embed_key),
			$this->integer($this->testedInstance->getDataReceivedAt())->isIdenticalTo($std->data_received_at),
			$this->integer($object->getDataReceivedAt())->isIdenticalTo($std->data_received_at)
		);
	}
}
