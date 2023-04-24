<?php

namespace core;

class Errors
{
    private $errors = array();
    public function getErrors()
    {
        return $this->errors;
    }
    public function addError($err)
    {
        $this->errors[] = $err;
    }
    public function isEmpty()
    {
        return count($this->errors) == 0;
    }
    public function empty()
    {
        $this->errors = array();
    }
}
