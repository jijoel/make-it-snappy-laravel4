<?php

class QuestionControllerTest extends TestCase {
	public function testIndex()
	{
		$response = $this->call('GET', 'questions');
		$this->assertTrue($response->isOk());
	}

	public function testShow()
	{
		$response = $this->call('GET', 'questions/1');
		$this->assertTrue($response->isOk());
	}

	// public function testEdit()
	// {
	// 	$auth = new Auth;
	// 	$response = $this->call('GET', 'questions/1/edit');
	// 	$this->assertTrue($response->isOk());
	// }
}
