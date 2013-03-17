<?php 

// application/library/tests/helper.php

/*
 The test helper
*/
class TestHelper {

    /*
     Run the migrations in the test database
    */
    public static function migrate()
    {

        // If there is not a declaration that migrations have been run'd
        if(!isset($GLOBALS['migrated_test_database']))
        {
            // Run migrations
            require path('sys').'cli/dependencies'.EXT;
            \Laravel\CLI\Command::run(array('migrate:install'));
            \Laravel\CLI\Command::run(array('migrate'));

            // Declare that migrations have been run'd
            $GLOBALS['migrated_test_database'] = true;
        }
    }

    /*
     Enable sessions to be used in tests. For
     authentication purposes.
    */
    public static function use_sessions()
    {
        \Session::started() or \Session::load();
    }

    /*
     Simulates a request to the router re-setting
     the Method
    */
    public static function http_request($method, $route)
    {
        $request = \Router::route($method, 'users/signup');
        \Request::setMethod($method);

        return $request->call();
    }
}
