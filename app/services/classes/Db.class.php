<?php

    //only this class interacts with the Database
class Db{
    public $con;
    private $host = 'db';
    private $database = 'php_docker';
    private $user = 'php_docker';
    private $password = 'password';

    public function __construct() {
        try {
            $this->con = new PDO('mysql:host=' .$this->host .';dbname=' . $this->database, $this->user, $this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            echo "Database Error: " . $e->getMessage();
        }
    }

    //view data
    public function getLanguageString($language_key, $language_id){
        $query = "SELECT language_string FROM language_strings WHERE language_key = '{$language_key}' AND language_id = '{$language_id}'";
        $stmt = $this->con->query($query);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(isset($data[0]['language_string'])){
            return $data[0]['language_string'];
        }else{
            return $language_key;
        }

    }

    public function execute($query, $options = []){
        try{
            $stmt = $this->con->prepare($query);
            $stmt->execute($options);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }catch (PDOException $e) {
            var_dump($e->getMessage());
        }

    }

    public function getDate($timestamp){
        return date('d.m.Y', (strtotime($timestamp)));
    }

    public function getTime($timestamp){
        return date('H:i:s', (strtotime($timestamp)));
    }


}