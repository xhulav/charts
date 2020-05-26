<?php


namespace xhulav\Charts\Core\Legend;


class SumObject
{
	/** @var float */
	protected $sum;

	/**
	 * SumObject constructor.
	 * @param float|int $startValue
	 */
	public function __construct($startValue = 0)
	{
		$this->sum = $startValue;
	}

	/**
	 * @param $value
	 */
	public function add($value)
	{
		$this->sum += $value;
	}

	/**
	 * @return float|int
	 */
	public function getSum()
	{
		return $this->sum;
	}

	/**
	 * @param $value
	 * @param int $precision
	 * @return float
	 */
	public function toPercentages($value, $precision = 0)
	{
		if ($this->sum == 0) {
			return 0;
		}

		return round($value * 100 / $this->sum, $precision);
	}
}