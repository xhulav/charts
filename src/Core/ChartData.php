<?php


namespace xhulav\Charts\Core;


use JsonSerializable;

class ChartData implements JsonSerializable
{
	/**
	 * @var array
	 */
	protected $labels = [];
	/**
	 * @var array
	 */
	protected $datasets = [];

	/**
	 * @return array
	 */
	public function getLabels() : array
	{
		return $this->labels;
	}

	/**
	 * @param array $labels
	 */
	public function setLabels(array $labels)
	{
		$this->labels = $labels;
	}

	/**
	 * @return array
	 */
	public function getDataSets() : array
	{
		return $this->datasets;
	}

	/**
	 * @param array $dataSets
	 */
	public function setDataSets(array $dataSets)
	{
		$this->datasets = $dataSets;
	}

	/**
	 * Specify data which should be serialized to JSON
	 * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
	function jsonSerialize()
	{
		return get_object_vars($this);
	}
}