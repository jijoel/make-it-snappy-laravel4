<?php
use \TestGuy;

class HomeCest
{

    public function _before()
    {
    }

    public function _after()
    {
    }

    public function testViewHomePage(TestGuy $I) 
    {
        $I->am('a user');
        $I->wantTo('see the home page');

        $I->amOnPage('/');
        $I->dontSee('The requested URL');
        $I->dontSee('Exception');

        // Show the page is being served
        $I->see('Make it Snappy Q&A', '#header');
        $I->see('Ask a question', 'h1');
        $I->see('Unsolved questions', 'h2');
        
        $I->seeLink('Home');
        $I->seeLink('Register');
        $I->seeLink('Login');
        $I->seeLink('2');

        // Show data is being delivered
        $I->dontSee('Does a solved question show up?');
        $I->dontSee('Does this work?');
        $I->see('Do questions work out of order?', 'li');
        $I->see('How many questions shall I ask?', 'li');

        // The TestGuy browser can't really handle pagination...
    }

    public function testSearch(TestGuy $I)
    {
        $I->amOnPage('/');
        $I->dontSee('Does it work for solved items?');
        $I->submitForm('#searchbar form', array(
            'keyword'=>'solved'
        ));

        $I->see('Does it work for solved items?', 'li');
        $I->see('Does a solved question show up?', 'li');

        // Look at a response
        $I->click('Does it work');
        $I->seeInCurrentUrl('questions/2');
        $I->see('Joel asks', 'h1');
        $I->see('Answers', 'h2');
    }

    public function testRegister(TestGuy $I)
    {
        $I->am('a tester');
        $I->wantTo('register');

        $I->amOnPage('/');
        $I->click('Register');
        $I->see('Register', 'h1');

        $I->dontSeeInDatabase('users', array('username'=>'new_user'));
        $I->submitForm('#content form', array(
            'username'=>'new_user',
            'password'=>'test',
            'password_confirmation'=>'test',
        ));
        $I->seeInDatabase('users', array('username'=>'new_user'));    

        $I->see('Thank you for registering');
        $I->see('You are now logged in as new_user');
        $I->click('Logout');
    }

    public function testFailToRegister(TestGuy $I)
    {
        $I->amOnPage('/');
        $I->click('Register');

        $I->click('#content input[type=submit]');  // Register button, not link
        $I->dontSeeInCurrentUrl('register');
        $I->dontSee('Thank you for registering');
    }

    public function testLogin(TestGuy $I)
    {
        $I->amOnPage('/');
        $I->click('Login');
        
        $I->submitForm('#content form', array(
            'username'=>'joel',
            'password'=>'test',
        ));
        $I->see('You are logged in as joel.');

        $I->click('Logout');
    }
    
    public function testAddItem(TestGuy $I) 
    {
        // $I->am('a tester');
        // $I->wantTo('add a todo');

        // $I->amOnPage('/');
        // $I->dontSeeInDatabase('todos', array('name'=>'new todo'));
        // $I->submitForm('#new-todo-form', array('new'=>'new todo'));
        // $I->seeInDatabase('todos', array('name'=>'new todo'));    
    }

}