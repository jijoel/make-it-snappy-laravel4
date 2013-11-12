<?php

/**
 * @group functional
 */
Class AnswerTest extends FunctionalTestCase
{
    public function testRelationships()
    {
        $test = Answer::find(1);
        $this->assertEquals('test1', $test->user->username, 'belongs to seed user');
        $this->assertEquals('Does this work?', $test->question->question, 
            'for correct question');
    }
}