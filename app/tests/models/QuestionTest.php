<?php

/**
 * @group functional
 */
Class QuestionTest extends FunctionalTestCase
{
    public function testRelationships()
    {
        $test = Question::find(1);
        $this->assertEquals('joel', $test->user->username, 'belongs to seed user');
        $this->assertEquals('Yes, it does!', $test->answers->first()->answer, 
            'has correct answer');
    }

}