<?php

class QuestionController extends BaseController {

	public function __construct()
	{
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
            ->with('questions', Question::unsolved());
 	}

 	/**
 	 * Display a listing of the questions for the active user
 	 */
 	public function indexYourQuestions()
 	{
 		return View::make('questions.your_questions')
 			->with('title', 'Make it Snappy Q&A -- Your Questions')
 			->with('username', Auth::user()->username)
 			->with('questions', Question::yourQuestions());
 	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = Question::validate(Input::all());

		if ($validation->passes()) {
			Question::create(array(
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
			->with('question', Question::find($id));
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
			->with('question', Question::find($id));		
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

		$validation = Question::validate(Input::all());
		if ($validation->passes()) {
			Question::where('id','=',$id)->update(array(
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
			->with('questions', Question::search($keyword));
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
		$question = Question::find($id);
		$user = Auth::user();

		if (!isset($question) or !isset($user)) {
			return False;
		}
		return ($question->user_id == Auth::user()->id);
	}

}