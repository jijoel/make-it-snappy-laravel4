<?php

/**
 * @group functional
 */
Class UserTest extends FunctionalTestCase
{
    public function testRelationships()
    {
        $test = User::find(1);
        $this->assertCount(2, $test->questions, 'user 1 has 2 questions');
        $this->assertCount(1, $test->answers, 'user 1 has answered 1 question');

        $test = User::find(3);
        $this->assertCount(1, $test->questions, 'User 3 has 1 question');
        $this->assertCount(0, $test->answers, 'user 3 has answered 0 questions');
    }

}

