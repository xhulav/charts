<?php


namespace xhulav\Charts\Core\SingleDataSet;


use xhulav\Charts\Core\BaseChart;
use xhulav\Charts\Core\BaseDataSet;

abstract class SingleDataSetChart extends BaseChart
{
	/**
	 * @var Node[]
	 */
	protected $nodes = [];

	public function showPercentages($show = true)
	{
		$this->showPercentages = $show;

		return $this;
	}

	/**
	 * @return array
	 */
	protected function getLabels() : array
	{
		$labels = [];
		foreach ($this->nodes as $node) {
			$labels[] = $node->getLabel();
		}

		return $labels;
	}

	protected function getDataSets() : array
	{
		if ($this->limit !== null) {
			/** @var Node $restNodes */
			$restNodes = array_splice($this->nodes, $this->limit);
			if ($this->restNodeEnabled) {
				$restSum = 0;
				foreach ($restNodes as $node) {
					$restSum += $node->getValue();
				}
				$this->addNode($this->restNodeLabel, $restSum)
					->setBackgroundColor($this->getRestDataColor())
					->setBackgroundHoverColor($this->getRestDataColor());
			}
		}

		$dataSet = $this->createDataSet();
		foreach ($this->nodes as $node) {
			if (!$this->customLegend) {
				$this->legend->addItem($node->getLabel(), $node->getValue(), $node->getBackgroundColor());
			}
			$dataSet->addNode($node);
		}

		return [$dataSet];
	}

	/**
	 * @param string $label
	 * @param float $value
	 * @return Node
	 */
	public function addNode($label, $value)
	{
		$color = self::getColor(count($this->nodes));
		$node = new Node($label, $value, $color);

		$this->nodes[] = $node;
		return $node;
	}

	protected function createDataSet() : BaseDataSet
	{
		return new DataSet();
	}

	protected function sortData()
	{
		if ($this->sortData === null) {
			return;
		} elseif ($this->sortData === self::DESC) {
			usort($this->nodes, [$this, 'sortNodesDESC']);
		} else {
			usort($this->nodes, [$this, 'sortNodesASC']);
		}

		$index = 0;
		foreach ($this->nodes as $node) {
			if (!$node->isBackgroundHoverColorPreserved()) {
				$node->setBackgroundHoverColor(null);
			}

			if (!$node->isBackgroundColorPreserved()) {
				$node->setBackgroundColor(self::getColor($index));
			}

			$index++;
		}
	}

	protected function sortNodesDESC(Node $a, Node $b)
	{
		return $b->getValue() <=> $a->getValue();
	}

	protected function sortNodesASC(Node $a, Node $b)
	{
		return $a->getValue() <=> $b->getValue();
	}


}