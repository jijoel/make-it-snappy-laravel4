<?php

Class AnswerTest extends TestCase
{
	public function testTesterWorks()
	{
		$opt = Config::get('app.load_failing_tests');
		if ($opt) {
			$this->assertTrue(False);			
		}
		$this->assertTrue(True);
	}
}