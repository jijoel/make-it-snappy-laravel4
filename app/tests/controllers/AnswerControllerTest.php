<?php

/**
 * @group functional
 */
class AnswerControllerTest extends FunctionalTestCase 
{

    public function testStoreSuccess()
    {
        Redirect::shouldReceive('back->with')->once();
        $data = array('question_id'=>1, 'answer'=>'foo');
        $this->be(User::find(1));

        $this->call('POST', 'answers', $data);
    }

    public function testStoreFails()
    {
        \Validator::shouldReceive('make->passes')
            ->once()->andReturn(False);
        \Redirect::shouldReceive('back->withErrors->withInput')
            ->once();

        $this->call('POST', 'answers');
    }

}
