<?php


namespace xhulav\Charts\Core;


abstract class BaseChartNode
{
	/** @var  string */
	protected $label;
	/** @var  float */
	protected $value;

	/**
	 * BaseChartNode constructor.
	 * @param $label
	 * @param $value
	 */
	public function __construct($label, $value)
	{
		$this->label = $label;
		$this->value = $value;
	}

	/**
	 * @return string
	 */
	public function getLabel()
	{
		return $this->label;
	}

	/**
	 * @return float
	 */
	public function getValue()
	{
		return $this->value;
	}

	public function addValue($value)
	{
		$this->value += $value;

		return $this;
	}
}