<?php

return array( 
    'default' => 'codeception',
    'connections' => array(
        'codeception' => array(
            'driver'   => 'sqlite',
            'database' => __DIR__.'/../../tests/codeception/_data/db.sqlite',
            'prefix'   => '',
        ),
    )
);
