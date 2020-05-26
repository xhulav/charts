<?php


namespace xhulav\Charts\LineChart;


use xhulav\Charts\Core\BaseDataSet;

class DataSet extends BaseDataSet
{
	/** @var string */
	protected $label;
	/** @var string */
	protected $borderColor;
	/** @var bool */
	protected $fill = false;
	/** @var string */
	protected $backgroundColor;

	protected $preserveBorderColor = false;
	protected $preserveBackgroundColor = false;

	/**
	 * DataSet constructor.
	 * @param string $label
	 */
	public function __construct($label)
	{
		$this->label = $label;
	}

	/**
	 * @param string $borderColor
	 * @return DataSet
	 */
	public function setBorderColor($borderColor)
	{
		$this->preserveBorderColor = true;

		$this->borderColor = $borderColor;
		return $this;
	}

	/**
	 * @param boolean $fill
	 * @return DataSet
	 */
	public function setFill($fill = true)
	{
		$this->fill = $fill;
		return $this;
	}

	/**
	 * @param string $backgroundColor
	 * @return DataSet
	 */
	public function setBackgroundColor($backgroundColor)
	{
		$this->preserveBackgroundColor = true;

		$this->backgroundColor = $backgroundColor;
		return $this;
	}

	public function addNode($value)
	{
		$this->data[] = $value;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getLabel()
	{
		return $this->label;
	}

	/**
	 * @return string
	 */
	public function getBackgroundColor()
	{
		return $this->backgroundColor;
	}

	/**
	 * @return array
	 */
	public function getValues()
	{
		return $this->data;
	}

	public function getLastValue()
	{
		$lastValue = end($this->data);
		reset($this->data);
		return $lastValue;
	}

	public function isBorderColorPreserved()
	{
		return $this->preserveBorderColor;
	}

	public function isBackgroundColorPreserved()
	{
		return $this->preserveBackgroundColor;
	}
}