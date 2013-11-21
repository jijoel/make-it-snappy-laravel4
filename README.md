make-it-snappy
==============

A port of the make-it-snappy app for Laravel 4.
I generally followed instructions from https://tutsplus.com/course/hands-on-building-a-practical-web-application-with-laravel/

The master branch contains the standard setup for Laravel 4. The dev branch includes codeception tests and controllers with injected models.

To run the codeception tests, make sure that these objects are world-writable:

    directory: /app/tests/codeception/_data
    file:      /app/tests/codeception/_data/db.sqlite

You'll also want to change the url for codeception tests in `app/tests/codeception/acceptance.suite.yml`

Run `bin/prepTestDB' to create a database for codeception tests. This will generate the test database, and run migrations and seeds.

