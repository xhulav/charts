<?php


namespace xhulav\Charts\Core\Legend;


class Item
{
	/** @var string */
	protected $label;
	/** @var float */
	protected $value;
	/** @var string */
	protected $color;

	/** @var SumObject */
	protected $sumObject;

	/**
	 * Item constructor.
	 * @param string $label
	 * @param float $value
	 * @param string $color
	 * @param SumObject $sumObject
	 */
	public function __construct($label, $value, $color, SumObject $sumObject)
	{
		$this->label = $label;
		$this->value = $value;
		$this->color = $color;
		$this->sumObject = $sumObject;

		$this->sumObject->add($value);
	}

	/**
	 * @return string
	 */
	public function getLabel()
	{
		if (is_array($this->label)) {
			return implode(' ', $this->label);
		}

		return $this->label;
	}

	/**
	 * @return float
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @return string
	 */
	public function getColor()
	{
		return $this->color;
	}

	/**
	 * @param int $precision
	 * @return float
	 */
	public function getPercentages($precision = 0)
	{
		return $this->sumObject->toPercentages($this->value, $precision);
	}

}