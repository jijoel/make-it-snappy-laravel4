<?php

class InterfaceTest extends TestCase {

    public function __construct()
    {
        // set up and use a test database

    }

    public function testTesterWorks()
    {
        $this->assertTrue(True);
    }

    public function test_request_homepage()
    {
        $crawler = $this->client->request('GET', '/');
        $this->assertTrue($this->client->getResponse()->isOk(), 'should have OK response');
        $this->assertEquals('ask a question', strtolower($crawler->filterXPath('//h1')->text()),
            'should contain h1 header with "Ask a Question"');
        $this->assertCount(1, $crawler->filter('h1:contains("Ask a Question")'), 
                'should contain h1 header with "Ask a Question"');
        $this->assertCount(1, $crawler->filter('h2:contains("Unsolved Questions")'), 
                'should contain h2 header with "Unsolved Questions"');
        $this->assertCount(1, $crawler->filter('a:contains("Home")'),
                'should contain "Home" link');
        $this->assertCount(1, $crawler->filter('a:contains("Register")'),
                'should contain "Register" link');
        $this->assertCount(1, $crawler->filter('a:contains("Login")'),
                'should contain "Login" link');
    }

    public function test_homepage_search()
    {
        $crawler = $this->client->request('GET', '/');
        $this->assertTrue($this->client->getResponse()->isOk(), 'should have OK response');
        $content = $this->client->getResponse()->getContent();

        $form = $crawler->selectButton('Search')->form();
        $form['keyword'] = 'one';
//        var_dump($form);

//        $client->submit($form);

        // $crawler = $client->followRedirect();


        // $response = $this->call('GET', '/');
        // var_dump($response->getContent());

        // $document = new \DOMDocument();
        // $document->loadXml($crawler->getContent());
        // var_dump($response);
//        $a = $crawler->filter('input')->attr('type');
        // var_dump($a);
//        $a = $crawler->selectButton('Search')->form()->getValues();
        // var_dump($a);
//                $this->assertEquals(array('FooName' => 'FooBar'), $crawler->form(array('FooName' => 'FooBar'))->getValues(), '->form() takes an array of values to submit as its first argument');

//        $this->assertInstanceOf('Symfony\\Component\\DomCrawler\\Form', $crawler->form(), '->form() returns a Form instance');
    }

    public function test_request_login()
    {
        $crawler = $this->client->request('GET', '/login');
        $this->assertTrue($this->client->getResponse()->isOk(), 'should have an OK response');
        // $this->assertContains('Please Log In', $this->client->getResponse()->getContent(), 'should contain "Please Log In"');
        // $this->assertCount(1, $crawler->filter('h1:contains("Please Log In")'), 'should contain "Please Log In" in h1 tag (only once)');
    }

}