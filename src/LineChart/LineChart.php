<?php


namespace xhulav\Charts\LineChart;

use xhulav\Charts\Core\BaseChart;

class LineChart extends BaseChart
{
	/** @var array */
	protected $labels = [];
	/** @var DataSet[] */
	protected $dataSets = [];
	/** @var bool */
	protected $fill = false;

	public function __construct()
	{
		parent::__construct();

		$this->setShowLegendPercentages(false);
		$this->legend->setShowValues(false);
	}


	/**
	 * @return string
	 */
	protected function getType() : string
	{
		return 'line';
	}

	/**
	 * @param array $labels
	 * @return $this
	 */
	public function setAxisX(array $labels)
	{
		$this->labels = $labels;

		return $this;
	}

	/**
	 * @param $label
	 * @return DataSet
	 */
	public function addDataSet($label)
	{
		$dataSet = new DataSet($label);
		$dataSet->setBorderColor(self::getColor(count($this->dataSets)));
		$dataSet->setBackgroundColor(self::getColor(count($this->dataSets)));

		$this->dataSets[] = $dataSet;
		return $dataSet;
	}

	/**
	 * @param bool $fill
	 * @return $this
	 */
	public function setFill($fill = true)
	{
		$this->fill = $fill;

		return $this;
	}

	/**
	 * @return array
	 */
	protected function getLabels() : array
	{
		return $this->labels;
	}

	/**
	 * @return DataSet[]
	 */
	protected function getDataSets() : array
	{
		if ($this->limit !== null) {
			/** @var DataSet[] $restDataSets */
			$restDataSets = array_splice($this->dataSets, $this->limit);
			if ($this->restNodeEnabled) {
				$values = [];
				foreach ($restDataSets as $dataSet) {
					$iterator = 0;
					foreach ($dataSet->getValues() as $value) {
						if (isset($values[$iterator])) {
							$values[$iterator] += $value;
						} else {
							$values[$iterator] = $value;
						}
						$iterator++;
					}
				}

				$restDataSet = new DataSet($this->restNodeLabel);
				$restDataSet->setBackgroundColor($this->getRestDataColor());
				$restDataSet->setBorderColor($this->getRestDataColor());

				foreach ($values as $value) {
					$restDataSet->addNode($value);
				}

				$this->dataSets[] = $restDataSet;
			}
		}

		foreach ($this->dataSets as $dataSet) {
			if (!$this->customLegend) {
				$this->legend->addItem($dataSet->getLabel(), $dataSet->getLastValue(), $dataSet->getBackgroundColor());
			}
			$dataSet->setFill($this->fill);
		}

		return $this->dataSets;
	}

	protected function sortData()
	{
		if ($this->sortData === null) {
			return;
		} elseif ($this->sortData === self::DESC) {
			usort($this->dataSets, [$this, 'sortDataSetsDESC']);
		} else {
			usort($this->dataSets, [$this, 'sortDataSetsASC']);
		}

		$index = 0;
		foreach ($this->dataSets as $dataSet) {
			if (!$dataSet->isBorderColorPreserved()) {
				$dataSet->setBorderColor(null);
			}

			if (!$dataSet->isBackgroundColorPreserved()) {
				$dataSet->setBackgroundColor(self::getColor($index));
			}

			$index++;
		}
	}

	protected function sortDataSetsDESC(DataSet $a, DataSet $b)
	{
		return $b->getLastValue() <=> $a->getLastValue();
	}

	protected function sortDataSetsASC(DataSet $a, DataSet $b)
	{
		return $a->getLastValue() <=> $b->getLastValue();
	}
}