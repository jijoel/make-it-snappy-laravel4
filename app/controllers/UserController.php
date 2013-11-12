<?php

class UserController extends BaseController {

    public function __construct(User $user) 
    {
        $this->user = $user;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('users.create')
            ->with('title', 'Make it Snappy Q&A - New');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validation = $this->user->validate(Input::all());
        if ($validation->passes()) {
            $this->user->create(array(
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password'))
            ));

            $user = $this->user->where('username', '=', Input::get('username'))->first();
            Auth::login($user);

            return Redirect::route('home')
                ->with('message', 'Thank you for registering. '
                    .'You are now logged in as '.Input::get('username').'.');
        }
        return Redirect::back()
            ->withErrors($validation)
            ->withInput();
    }



    /*********************************************************************************
     ** Actions
     **/

    /**
     * Show the login form
     */
    public function getLogin()
    {
        return View::make('users.login')
            ->with('title', 'Make it Snappy Q&A -- Login');
    }

    /**
     * Log a user in if they have submitted valid credentials 
     */
    public function postLogin()
    {
        $users = array(
                'username' => Input::get('username'),
                'password' => Input::get('password')
            );

        if (Auth::attempt($users)) {
            return Redirect::route('home')
                ->with('message', 'You are logged in as '.Input::get('username').'.');
        }
        return Redirect::route('login')
            ->with('message', 'Invalid credentials. Please try again.')
            ->withInput();
    }

    /**
     * log a user out
     */
    public function getLogout()
    {
        if (Auth::check()) {
            Auth::logout();
            return Redirect::route('login')->with('message', 'You are now logged out');
        }
        return Redirect::route('home');
    }

}

