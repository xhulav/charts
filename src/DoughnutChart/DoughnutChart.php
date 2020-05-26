<?php


namespace xhulav\Charts\DoughnutChart;

use xhulav\Charts\Core\SingleDataSet\SingleDataSetChart;

class DoughnutChart extends SingleDataSetChart
{
	protected function getType() : string
	{
		return 'doughnut';
	}
}