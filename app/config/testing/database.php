<?php
// application/config/testing/database.php
// from http://forums.laravel.io/viewtopic.php?id=2521
    
return array(

    'default' => 'sqlite',

    'connections' => array(

        'sqlite' => array(
            'driver'   => 'sqlite',
            'database' => ':memory:', // this will do the trick ;)
            'prefix'   => '',
        ),
    ),
);