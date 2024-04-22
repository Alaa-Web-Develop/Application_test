<?php

//connect to db with mysqli method
class connection_db{
    private $hostname ="localhost";
    private $username="root";
    private $password ="";
    private $databaseName="user-crud";
    private $con;

    //mysqli obj in constructor to fire just take instance
    public function __construct()
    {
        $this->con = new mysqli($this->hostname,$this->username,$this->password,$this->databaseName);

        //Test Connection : connect_errno:Return the error description from the last connection error, if any
        if ($this->con -> connect_errno) {
            echo "Failed to connect to MySQL: " . $this->con -> connect_error;
            exit();
          }
    }

    //Run DML Queries
    public function runDML(string $query):bool{
        $result = $this->con->query($query);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
    //Run DQL Queries:returned result object has num_rows to check if it was return data or not.
    public function runDQL(string $query){
        $result = $this->con->query($query);
        if($result->num_rows > 0 ){
            return $result;
        }
        return [];
    }
}

//test_connection
$x=new connection_db;
$x->runDQL("select * from `users` where `email` = 'alaa'");