<?php
use \WebGuy;

class WebHomeCest
{

    public function _before()
    {
    }

    public function _after()
    {
    }

    public function testViewHomePage(WebGuy $I) 
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
        $I->see('Do questions work out of order? by Test1 (0 answers)');
        $I->see('How many questions shall I ask? by Test2 (1 answers)');

        $I->click('2');
        $I->dontSee('How many questions', 'li');  
        $I->see('Does this work? by Joel (1 answers)');
    }

    public function testRegister(WebGuy $I)
    {
        $I->amOnPage('/');
        $I->click('Register');
        $I->see('Register', 'h1');
        $I->seeLink('Register');
        $I->click('#content input[type=submit]');  // Register button, not link
        $I->see('The username field is required');

        $I->fillField('Username', 'new_user');
        $I->fillField('Password', 'test');
        $I->fillField('Confirm Password', 'test');
        $I->click('#content input[type=submit]');
        $I->see('Thank you for registering');
        $I->see('You are now logged in as new_user');
        $I->click('Logout');
    } 

}