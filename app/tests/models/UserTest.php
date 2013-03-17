<?php

Class UserTest extends TestCase
{
	public function testTesterWorks()
	{
		$opt = Config::get('app.load_failing_tests');
		if ($opt) {
			$this->assertTrue(False);			
		}
		$this->assertTrue(True);
	}

	public function testAuthIdentifierAndPassword()
	{
		// before mocking, the AuthIdentifier and AuthPassword should be Null
		$user = new User;
		$this->assertNull($user->getAuthIdentifier());
        $this->assertNull($user->getAuthPassword());

        $user = new User(array('id'=>1, 'username'=>'joel','password'=>'test','email'=>'test@test.com'));
        $this->be($user);
        $this->assertEquals(1, $user->getAuthIdentifier());
        $this->assertEquals('test', $user->getAuthPassword());
        $this->assertEquals('test@test.com', $user->getReminderEmail());
	}

    public function testValidation()
    {
        // $m = Mockery::mock('ValidationServiceProvider');
        // $m->shouldReceive('make')->with(1, 2)->once()->andReturn(False);
        // $this->app->instance('ValidationServiceProvider', $m);

        // $user = new User;
        // $this->assertFalse($user->validate(array('test')));
    }

    public function testQuestions()
    {
     //    $user = new User;
    	// $d = $user->find(1)->questions();
//        var_dump($d);
    }
}

