<?php

class UserControllerTest extends TestCase 
{

	public function testCreate()
	{
		$response = $this->call('GET', 'users/create');
		$this->assertTrue($response->isOk());
	}

}
