<?php


namespace xhulav\Charts\Core;


use JsonSerializable;

abstract class BaseDataSet implements JsonSerializable
{
	protected $data = [];

	public abstract function addNode($node);

	/**
	 * Specify data which should be serialized to JSON
	 * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
	public function jsonSerialize()
	{
		return get_object_vars($this);
	}
}