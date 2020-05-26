<?php


namespace xhulav\Charts\PolarAreaChart;

use xhulav\Charts\Core\SingleDataSet\SingleDataSetChart;

class PolarAreaChart extends SingleDataSetChart
{
	protected function getType() : string
	{
		return 'polarArea';
	}
}