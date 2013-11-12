<?php

class AnswerController extends BaseController 
{
	protected $answer;

	public function __construct(Answer $answer)
	{
		$this->beforeFilter('auth', array('only' => array('store')));
		$this->answer = $answer;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = $this->answer->validate(Input::all());

		$question_id = Input::get('question_id');
		if ($validation->passes()) {
			$this->answer->create(array(
				'answer' => Input::get('answer'),
				'question_id' => $question_id,
				'user_id' => Auth::user()->id
			));
			return Redirect::back()
				->with('message', 'Your answer has been posted');
		}
		return Redirect::back()
			->withErrors($validation)
			->withInput();
	}

}