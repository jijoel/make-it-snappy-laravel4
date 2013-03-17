<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/*

Don't forget to add this command to start/artisan.php

Artisan::add(
	new RoutesCommand($app->router->getRoutes()->all())
);

 */

class RoutesCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'routes';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'List all registered routes';

	/**
	 * All registered routes
	 *
	 * @var array
	 */
	protected $routes;

	/**
	 * Only desired route info
	 *
	 * @var array
	 */
	protected $routesInfo;

	/**
	 * Leerrrrroy Jenkins
	 * @param Array $routes List of registered routes
	 */
	public function __construct(Array $routes)
	{
		$this->routes = $routes;

		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		if ( empty($this->routes) )
		{
			return $this->info('Please register a route first.');
		}

		$this->setRoutesInfo();
		$this->outputRoutes();
	}

	/**
	 * Compile all the desired route information,
	 * including route name, URI, and Controller@Method
	 *
	 * @return array
	 */
	protected function setRoutesInfo()
	{
		$this->routesInfo = array();

		// Let's filter through the registered routes
		// and extract our desired info.
		foreach($this->routes as $route => $info)
		{
			$methodArr = $info->getMethods();
			$this->routesInfo[] = array(
				'uri' => $methodArr[0] . ' ' . $info->getPath(),
				'name' => $this->getNamedRoute($route),
				'action' => $this->getAction($info)
			);
		}
	}

	/**
	 * Echo routes to user
	 *
	 * @return void
	 */
	protected function outputRoutes()
	{
		$widths = $this->getCellWidths();

		// Let's first echo the headings
		$this->comment(
			str_pad('URI', $widths['uris']) .
			str_pad('Name', $widths['names']) .
			str_pad('Action', $widths['actions'])
		);

		// And now echo the desired info for each route
		foreach($this->routesInfo as $route)
		{
			$this->info(
				str_pad($route['uri'], $widths['uris']) .
				str_pad($route['name'], $widths['names']) .
				str_pad($route['action'], $widths['actions'])
			);
		}
	}

	/**
	 * A pretty shoddy attempt at a pseudo table-based layout
	 * Determines correct spacing for each column.
	 *
	 * TODO: Does the Symfony console component offer any solution?
	 *
	 * @return array
	 */
	protected function getCellWidths($padding = 10)
	{
		$widths = array();

		$cols = array(
			'uris' => array_pluck($this->routesInfo, 'uri'),
			'actions' => array_pluck($this->routesInfo, 'action'),
			'names' => array_pluck($this->routesInfo, 'name')
		);

		foreach($cols as $key => $col)
		{
			$width = 0;

			foreach($col as $item)
			{
				if ( strlen($item) > $width )
				{
					$width = strlen($item);
				}
			}

			$widths[$key] = $width + $padding;
		}

		return $widths;
	}

	/**
	 * Gets the name of the route, if any.
	 * TODO: Must be a more official way.
	 *
	 * @param string $route
	 * @return string
	 */
	protected function getNamedRoute($route)
	{
		return strpos($route, ' ') !== false
			? ''
			: $route;
	}

	/**
	* Get the action for the passed route
	*
	* @param object $info
	* @return string
	*/
	protected function getAction($info)
	{
		$optionArr = $info->getOptions();
		$option = $optionArr['_uses'];
		return isset($option) ? $option : 'Closure';
	}

}