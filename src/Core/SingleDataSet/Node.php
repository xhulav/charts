<?php


namespace xhulav\Charts\Core\SingleDataSet;


use xhulav\Charts\Core\BaseChartNode;

class Node extends BaseChartNode
{
	/** @var string */
	protected $backgroundColor;
	/** @var string */
	protected $backgroundHoverColor;
	/** @var bool */
	protected $preserveBackgroundColor = false;
	/** @var bool */
	protected $preserveBackgroundHoverColor = false;

	public function __construct($label, $value, $backgroundColor = null)
	{
		parent::__construct($label, $value);

		$this->backgroundColor = $backgroundColor;
	}


	/**
	 * @return string
	 */
	public function getBackgroundColor()
	{
		return $this->backgroundColor;
	}

	/**
	 * @param string $backgroundColor
	 * @return Node
	 */
	public function setBackgroundColor($backgroundColor)
	{
		$this->preserveBackgroundColor = true;

		$this->backgroundColor = $backgroundColor;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getBackgroundHoverColor()
	{
		return $this->backgroundHoverColor ?? $this->backgroundColor;
	}

	/**
	 * @param string $backgroundHoverColor
	 * @return Node
	 */
	public function setBackgroundHoverColor($backgroundHoverColor)
	{
		$this->preserveBackgroundHoverColor = true;

		$this->backgroundHoverColor = $backgroundHoverColor;
		return $this;
	}

	/**
	 * @return boolean
	 */
	public function isBackgroundColorPreserved()
	{
		return $this->preserveBackgroundColor;
	}

	/**
	 * @return boolean
	 */
	public function isBackgroundHoverColorPreserved()
	{
		return $this->preserveBackgroundHoverColor;
	}

}