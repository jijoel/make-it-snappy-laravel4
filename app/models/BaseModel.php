<?php

/**
* 
*/
class BaseModel extends Eloquent 
{
//    private $validator;

    // public function __construct(ValidationServiceProvider $validator)
    // {
    //     parent::construct();
    //     $this->validator = $validator;
    // }

    public static function validate($data)
    {
        // return $this->validator->make($data, static::$rules);
        return Validator::make($data, static::$rules);
    } 

}

