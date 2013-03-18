<?php

/**
* 
*/
class BaseModel extends Eloquent 
{
    public function validate($data)
    {
        // return $this->validator->make($data, static::$rules);
        return Validator::make($data, static::$rules);
    } 
}

