<?php

class QuestionController extends BaseController 
{
	protected $question;

	public function __construct(Question $question)
	{
		$this->question = $question;

		$this->beforeFilter('auth', array(
			'only' => array(
				'edit', 
				'indexYourQuestions', 
				'store', 
				'update'
		)));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('questions.index')
            ->with('title', 'Make it Snappy Q&A -- Home')
            ->with('questions', $this->question->unsolved());
 	}

 	/**
 	 * Display a listing of the questions for the active user
 	 */
 	public function indexYourQuestions()
 	{
 		return View::make('questions.your_questions')
 			->with('title', 'Make it Snappy Q&A -- Your Questions')
 			->with('username', Auth::user()->username)
 			->with('questions', $this->question->yourQuestions());
 	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = $this->question->validate(Input::all());

		if ($validation->passes()) {
			$this->question->create(array(
				'question' => Input::get('question'),
				'user_id' => Auth::user()->id
			));
			return Redirect::route('home')
				->with('message', 'Your question has been posted');
		}
		return Redirect::route('home')
			->withErrors($validation)
			->withInput();
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('questions.show')
			->with('title', 'Make it Snappy - View Question')
			->with('question', $this->question->find($id));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		if (!$this->questionBelongsToUser($id)) {
			return Redirect::route('your_questions')
				->with('message', 'Invalid question');
		}
		return View::make('questions.edit')
			->with('title', 'Make it Snappy - Edit Question')
			->with('question', $this->question->find($id));		
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		$id == Input::get('question_id');
		if (!$this->questionBelongsToUser($id)) {
			return Redirect::route('your_questions')
				->with('message', 'Invalid question');
		}

		$validation = $this->question->validate(Input::all());
		if ($validation->passes()) {
			$this->question->where('id','=',$id)->update(array(
				'question' => Input::get('question'),
				'solved' => Input::get('solved'),
			));
			return Redirect::back()
				->with('message', 'Your question has been saved');
		}
		return Redirect::back()
			->withErrors($validation)
			->withInput();
	}


	public function getResults($keyword)
	{
		return View::make('questions.results')
			->with('title', 'Make it Snappy - Search Results')
			->with('questions', $this->question->search($keyword));
	}

	public function postSearch()
	{
		$keyword = Input::get('keyword');
		if (empty($keyword)) {
			 return Redirect::back()
			 	->with('message', 'No keyword entered, please try again');
		}
		return Redirect::to('results/'.$keyword);
	}

	/**
	 * Determine whether given question was asked by logged-in user
	 *  
	 * @param  integer $id  question id
	 * @return boolean      True if the question belongs to this user
	 */
	private function questionBelongsToUser($id)
	{
		$question = $this->question->find($id);
		$user = Auth::user();

		if (!isset($question) or !isset($user)) {
			return False;
		}
		return ($question->user_id == Auth::user()->id);
	}

}