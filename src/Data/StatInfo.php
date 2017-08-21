<?php

namespace Grummfy\Stathat\Data;

class StatInfo
{
	/**
	 * @var string
	 */
	protected $_id;

	/**
	 * @var string
	 */
	protected $_name;

	/**
	 * @var bool
	 */
	protected $_public;

	/**
	 * @var bool
	 */
	protected $_counter;

	/**
	 * @var string
	 */
	protected $_classic_key;

	/**
	 * @var int
	 */
	protected $_data_received_at;

	/**
	 * @var string
	 */
	protected $_embed_key;

	/**
	 * @var int
	 */
	protected $_created_at;

	public static function fromResponse(\stdClass $data): self
	{
		$stat = new self(
			$data->id,
			$data->name,
			$data->public,
			$data->counter,
			$data->classic_key,
			$data->data_received_at,
			$data->embed_key,
			$data->created_at
		);

		return $stat;
	}

	/**
	 * @param string $id
	 * @param string $name
	 * @param bool $public
	 * @param bool $counter
	 * @param string $classic_key
	 * @param int $data_received_at
	 * @param string $embed_key
	 * @param int $created_at
	 */
	public function __construct(string $id, string $name, bool $public, bool $counter, string $classic_key, int $data_received_at, string $embed_key, int $created_at)
	{
		$this->_id = $id;
		$this->_name = $name;
		$this->_public = $public;
		$this->_counter = $counter;
		$this->_classic_key = $classic_key;
		$this->_data_received_at = $data_received_at;
		$this->_embed_key = $embed_key;
		$this->_created_at = $created_at;
	}

	public function getId(): string
	{
		return $this->_id;
	}

	public function getName(): string
	{
		return $this->_name;
	}

	public function isPublic(): bool
	{
		return $this->_public;
	}

	public function isCounter(): bool
	{
		return $this->_counter;
	}

	public function getClassicKey(): string
	{
		return $this->_classic_key;
	}

	public function getDataReceivedAt(): int
	{
		return $this->_data_received_at;
	}

	public function getEmbedKey(): string
	{
		return $this->_embed_key;
	}

	public function getCreatedAt(): int
	{
		return $this->_created_at;
	}
}
