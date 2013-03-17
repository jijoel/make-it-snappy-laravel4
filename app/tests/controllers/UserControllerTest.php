<?php

class UserControllerTest extends TestCase 
{

    public function __construct()
    {

    }

	public function testCreate()
	{
		$response = $this->call('GET', 'users/create');
		$this->assertTrue($response->isOk());
	}

}
