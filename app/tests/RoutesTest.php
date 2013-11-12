<?php

/**
 * @group functional
 */
class RoutesTest extends FunctionalTestCase 
{
    public function testRouteMethodsExist()
    {
        $missing = '';
        $routes = App::make('router')->getRoutes();
        foreach ($routes as $key=>$route) {
            $action = $route->getAction();
            if (! $action || strpos($action, '@')===False) {
                continue;
            }

            list($class, $method) = explode('@', $action);
            if (! method_exists($class, $method)) {
                $missing = $missing . "Method $class::$method does not exist" . PHP_EOL;
            }
        }
        $this->assertEquals('', $missing);
    }

}
