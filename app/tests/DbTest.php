<?php

/**
 * @group functional
 */
class DbTest extends TestCase
{
    public function testDbConnectionWorks()
    {
        $this->assertNotNull(DB::connection(), 
            'connection should not be null');
    }

    /**
     * @dataProvider getTableConstructors
     */
    public function testCreateAndDeleteTables($table, $constructor)
    {
        $constructor->up();
        $this->assertTrue(Schema::hasTable($table));
        $constructor->down();
        $this->assertFalse(Schema::hasTable($table));
    }

    public function getTableConstructors()
    {
        return array(
            array( 'users', new CreateUsersTable ),
            array( 'questions', new CreateQuestionsTable ),
            array( 'answers', new CreateAnswersTable ),
        );
    }

}
