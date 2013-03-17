<?php

Interface UserRepositoryInterface
{
    function validate($input);
    public static function create(array $newUserArray);
    function withName($name);
}
