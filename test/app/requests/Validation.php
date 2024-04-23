<?php
//check input validation in general 
//required - regex - unique

include_once __DIR__ . '\..\database\connection_db.php';

class Validation
{
    private $name;
    private $value;

    public function __construct($name,$value) {
        $this->name=$name;
        $this->value=$value;

    }
    public function required(): string
    {
        return (empty($this->value)) ? "$this->name is required" : "";
    }

    public function regex($pattern): string
    {
        return (preg_match($pattern, $this->value)) ? "" : "$this->name Is Invalid";
    }

}
