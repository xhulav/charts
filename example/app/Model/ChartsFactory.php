<?php

declare(strict_types=1);

namespace App\Model;

use xhulav\Charts\DoughnutChart\DoughnutChart;
use xhulav\Charts\LineChart\LineChart;
use xhulav\Charts\PieChart\PieChart;
use xhulav\Charts\BarChart\BarChart;

class ChartsFactory
{
	public function createLineChart(): LineChart
	{
		$chart = new LineChart();
		$chart->legendOnRight();
		$chart->showLegend();

		$chart->setChartDimensions(1920, 360);

		$chart->setAxisX([1, 2, 3, 4, 5, 6, 7]);

		$dataSet1 = $chart->addDataSet('Data set 1');
		$dataSet1->addNode(5);
		$dataSet1->addNode(6);
		$dataSet1->addNode(7);
		$dataSet1->addNode(9);
		$dataSet1->addNode(1);
		$dataSet1->addNode(3);
		$dataSet1->addNode(4);

		$dataSet2 = $chart->addDataSet('Data set 2');
		$dataSet2->addNode(4);
		$dataSet2->addNode(9);
		$dataSet2->addNode(4);
		$dataSet2->addNode(3);
		$dataSet2->addNode(8);
		$dataSet2->addNode(5);
		$dataSet2->addNode(9);

		return $chart;
	}

	public function createBarChart(): BarChart
	{
		$chart = new BarChart();
		$chart->legendOnBottom();
		$chart->showLegend();
		$chart->addNode('Node 1', 5);
		$chart->addNode('Node 2', 2);
		$chart->addNode('Node 3', 7);
		$chart->addNode('Node 4', 3);
		$chart->addNode('Node 5', 9);

		return $chart;
	}

	public function createPieChart()
	{
		$chart = new PieChart();
		$chart->legendOnRight();
		$chart->showLegend();
		$chart->addNode('Node 1', 5);
		$chart->addNode('Node 2', 2);
		$chart->addNode('Node 3', 7);
		$chart->addNode('Node 4', 3);
		$chart->addNode('Node 5', 9);

		return $chart;

	}

	public function createDoughnutChart()
	{
		$chart = new DoughnutChart();
		$chart->legendOnRight();
		$chart->showLegend();
		$chart->addNode('Node 1', 5);
		$chart->addNode('Node 2', 2);
		$chart->addNode('Node 3', 7);
		$chart->addNode('Node 4', 3);
		$chart->addNode('Node 5', 9);

		return $chart;

	}

}