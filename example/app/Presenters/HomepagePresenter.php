<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\ChartsFactory;
use Nette\Application\UI\Presenter;


final class HomepagePresenter extends Presenter
{
	/** @var ChartsFactory */
	protected $factory;

	/**
	 * HomepagePresenter constructor.
	 * @param $factory
	 */
	public function __construct(ChartsFactory $factory)
	{
		parent::__construct();

		$this->factory = $factory;
	}

	public function beforeRender()
	{
		$path = __DIR__ . '/../../../assets/chart-factory.js';

		$this->template->add('chartFactory', file_get_contents($path));
	}

	public function createComponentLineChart()
	{
		return $this->factory->createLineChart();
	}

	public function createComponentBarChart()
	{
		return $this->factory->createBarChart();
	}

	public function createComponentPieChart()
	{
		return $this->factory->createPieChart();
	}

	public function createComponentDoughnutChart()
	{
		return $this->factory->createDoughnutChart();
	}

}
