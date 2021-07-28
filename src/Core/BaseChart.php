<?php


namespace xhulav\Charts\Core;


use xhulav\Charts\Core\Legend\Legend;
use InvalidArgumentException;
use Nette\Application\UI\Control;
use Nette\Bridges\ApplicationLatte\Template;

/**
 * @property-read Template $template
 * @method Template getTemplate()
 */
abstract class BaseChart extends Control
{
	const ASC = true;
	const DESC = false;

	protected $layoutTemplate;
	protected $chartTemplate;
	protected $legendTemplate;

	/** @var int */
	protected $width = 320;
	/** @var int */
	protected $height = 160;
	/** @var bool */
	protected $showPercentages = false;
	/** @var Legend */
	protected $legend;
	/** @var bool */
	protected $customLegend = false;
	/** @var string */
	protected $units;
	/** @var int */
	protected $chartWidth = 8;
	/** @var int */
	protected $legendWidth = 4;

	/**
	 * @var null|bool
	 * null: Do not sort
	 * true: Sort ASC
	 * false: Sort DESC
	 */
	protected $sortData = null;

	/**
	 * @var null|int
	 */
	protected $limit = null;

	/**
	 * @var bool
	 */
	protected $restNodeEnabled = false;

	/**
	 * @var string
	 */
	protected $restNodeLabel;

	/**
	 * @var string
	 */
	protected $restNodeColor;

	public function __construct()
	{
		$this->legend = new Legend();

		$this->legendOnBottom();
		$this->setChartTemplate(__DIR__ . '/templates/chart.latte');
		$this->setLegendTemplate(__DIR__ . '/templates/legend.latte');
	}

	abstract protected function getType() : string;

	abstract protected function getLabels() : array;

	abstract protected function getDataSets() : array;

	abstract protected function sortData();

	public function sort($sort = self::DESC)
	{
		$this->sortData = $sort;
	}

	public function legendOnBottom()
	{
		$this->layoutTemplate = __DIR__ . '/templates/layoutBottom.latte';
		$this->legend->setLayout(Legend::HORIZONTAL);
	}

	public function legendOnRight($chartWidth = 8, $legendWidth = 4)
	{
		$this->layoutTemplate = __DIR__ . '/templates/legendRight.latte';
		$this->legend->setLayout(Legend::VERTICAL);

		$this->chartWidth = $chartWidth;
		$this->legendWidth = $legendWidth;
	}

	/**
	 * @param string $units
	 */
	public function setUnits($units)
	{
		$this->units = $units;
	}

	/**
	 * @param bool $show
	 */
	public function setShowLegendPercentages($show = true)
	{
		$this->legend->setShowPercentages($show);
	}

	/**
	 * @param $templatePath
	 */
	public function setChartTemplate($templatePath)
	{
		$this->chartTemplate = $templatePath;
	}

	/**
	 * @param $templatePath
	 */
	public function setLegendTemplate($templatePath)
	{
		$this->legendTemplate = $templatePath;
	}

	/**
	 * @param bool $show
	 */
	public function showLegend($show = true)
	{
		$this->legend->show($show);
	}

	public function setChartDimensions($width, $height)
	{
		$this->width = $width;
		$this->height = $height;

		return $this;
	}

	public function createCustomLegend()
	{
		$this->customLegend = true;

		return $this->legend;
	}

	public function render()
	{
		/**
		 * Set template file
		 */
		$this->getTemplate()->setFile($this->layoutTemplate);

		/**
		 * Call beforeRender method to do additional stuff
		 */
		$this->beforeRender();

		/**
		 * Render component
		 */
		$this->getTemplate()->render();
	}

	protected function beforeRender()
	{
		$this->sortData();

		/**
		 * Pass templates paths
		 */
		$this->getTemplate()->add('chartTemplate', $this->chartTemplate);
		$this->getTemplate()->add('legendTemplate', $this->legendTemplate);

		/**
		 * Pass base params to template
		 */
		$this->getTemplate()->add('width', $this->width);
		$this->getTemplate()->add('height', $this->height);
		$this->getTemplate()->add('showPercentages', $this->showPercentages);
		$this->getTemplate()->add('legend', $this->legend);
		$this->getTemplate()->add('units', $this->units);
		$this->getTemplate()->add('type', $this->getType());
		$this->getTemplate()->add('data', $this->getChartData());
		$this->getTemplate()->add('chartWidth', $this->chartWidth);
		$this->getTemplate()->add('legendWidth', $this->legendWidth);
	}

	protected function getChartData()
	{
		$chartData = new ChartData();
		$chartData->setLabels($this->getLabels());
		$chartData->setDataSets($this->getDataSets());

		return json_encode($chartData);
	}

	protected function getRestDataColor()
	{
		return $this->restNodeColor;
	}

	protected static function getColor($index)
	{
		$index = $index % 32;       // after last color use first again

		$colors = [
			'#00c0ef', '#00a65a', '#f39c12', '#dd4b39', '#001f3f', '#39cccc', '#605ca8', "#dc8434",
			"#0053e0", "#54c83a", "#f400c5", "#6831bb", "#65a343", "#daa52d", "#49a5ad", "#7183d5",
			"#b4a442", "#62aed6", "#964127", "#d64728", "#b89e68", "#7c2d79", "#d64777", "#69b082",
			"#c354cf", "#40438a", "#633021", "#7d3346", "#3f5a2b", "#745525", "#59436a", "#d38d7e"
		];

		return $colors[$index];
	}

	public function setLimit($limit, $enableRestNode = true, $restNodeLabel = 'Others', $restNodeColor = '#d2d6de')
	{
		if ($limit < 1) {
			throw new InvalidArgumentException("Limit value must be greater than 0. {$limit} given.");
		}

		$this->limit = $limit;
		$this->restNodeEnabled = $enableRestNode;
		$this->restNodeLabel = $restNodeLabel;
		$this->restNodeColor = $restNodeColor;
	}
}