<?php

declare(strict_types=1);

namespace xhulav\Charts\BarChart;

use xhulav\Charts\Core\SingleDataSet\SingleDataSetChart;

class BarChart extends SingleDataSetChart
{
	protected function getType() : string
	{
		return 'bar';
	}
}