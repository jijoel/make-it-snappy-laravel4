<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase 
{

	/**
	 * Creates the application.
	 *
	 * @return Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'test-foo';

		return require __DIR__.'/../../bootstrap/start.php';
	}

	public function tearDown()
	{
		\Mockery::close();
	}
}
