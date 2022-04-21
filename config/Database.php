<?php

class Database{

    private $host= "localhost";
    private $dbname= "api_rest";
    private $user= "root";
    private $passwd= "";
    public $orm;

    public function setConnection(){

        $this->orm= null;
        try{

            $this->orm= new PDO("mysql:host=$this->post;dbname=$this->dbname", "$this->user", "$this->passwd");
            $this->orm->exec("set names utf8");
        }
        catch(PDOException $error){
            die($error->getMessage());
        }
        return $this->orm;
    }
}