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

    public function testSeededUserCount()
    {
        $this->loadDatabase();
        $this->assertEquals(3, count(User::all()));
    }

    public function testFindSeededUser()
    {
        $this->loadDatabase();
        $user = User::find(1);
        $username = $user->username;
        $this->assertEquals('joel', $username);
        $this->assertEquals(array('password'), User::find(1)->getHidden());

        $user = User::find(5);
        $this->assertNull($user);
    }

    public function testSeededUserQuestions()
    {
        $this->loadDatabase();
        $questions = User::find(1)->questions()->get();
        $this->assertEquals(2, count($questions));

        $questions = User::find(2)->questions()->get();
        $this->assertEquals(3, count($questions));
    }

    public function testSeededUserAnswers()
    {
        $this->loadDatabase();
        $answers = User::find(1)->answers()->get();
        $this->assertEquals(1, count($answers));

        $answers = User::find(2)->answers()->get();
        $this->assertEquals(1, count($answers));

        $answers = User::find(3)->answers()->get();
        $this->assertEquals(0, count($answers));
    }

    public function testValidate()
    {
        $user = new User;
        $validation = $user->validate(array('username'=>Null));
        $this->assertFalse($validation->passes());
        $e = $validation->getMessageBag();
        $this->assertEquals(3, count($e));
        // use this to see the actual messages
        var_dump($e->all(':message'));
    }

    public function testValidateField()
    {
        
    }

}

