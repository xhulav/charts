<?php


namespace xhulav\Charts\Core\Legend;


class Legend
{
	const VERTICAL = false;
	const HORIZONTAL = true;

	/** @var SumObject */
	protected $sum;
	/** @var Item[] */
	protected $items = [];

	/** @var bool */
	protected $showPercentages = true;
	/** @var bool */
	protected $showValues = true;
	/** @var bool */
	protected $show;
	/** @var bool */
	protected $layout = self::VERTICAL;

	/**
	 * Legend constructor.
	 */
	public function __construct()
	{
		$this->sum = new SumObject();
	}

	/**
	 * @param $label
	 * @param $value
	 * @param $color
	 * @return $this
	 */
	public function addItem($label, $value, $color)
	{
		$this->items[] = new Item($label, $value, $color, $this->sum);

		return $this;
	}

	/**
	 * @return Item[]
	 */
	public function getItems()
	{
		return $this->items;
	}

	public function showPercentages()
	{
		return $this->showPercentages;
	}

	public function setShowPercentages($show = true)
	{
		$this->showPercentages = $show;

		return $this;
	}

	public function showValues()
	{
		return $this->showValues;
	}

	public function setShowValues($show = true)
	{
		$this->showValues = $show;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isLayoutHorizontal()
	{
		return $this->layout;
	}

	/**
	 * @param bool $layout
	 */
	public function setLayout($layout = self::VERTICAL)
	{
		$this->layout = $layout;
	}

	/**
	 * @param bool $show
	 */
	public function show($show = true)
	{
		$this->show = $show;
	}

	public function isShown()
	{
		return $this->show;
	}

}