<?php


namespace xhulav\Charts\PieChart;

use xhulav\Charts\Core\SingleDataSet\SingleDataSetChart;

class PieChart extends SingleDataSetChart
{
	protected function getType() : string
	{
		return 'pie';
	}
}