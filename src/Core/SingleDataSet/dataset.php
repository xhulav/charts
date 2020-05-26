<?php


namespace xhulav\Charts\Core\SingleDataSet;


use xhulav\Charts\Core\BaseDataSet;

class DataSet extends BaseDataSet
{
	/** @var array */
	protected $backgroundColor = [];
	/** @var array */
	protected $hoverBackgroundColor = [];

	/**
	 * @param Node $node
	 */
	public function addNode($node)
	{
		$this->data[] = $node->getValue();
		$this->backgroundColor[] = $node->getBackgroundColor();
		$this->hoverBackgroundColor[] = $node->getBackgroundHoverColor();
	}

}