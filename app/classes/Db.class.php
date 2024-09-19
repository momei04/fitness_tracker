<?php
    class Db {
        protected $con;
		protected $server = 'db';
		protected $dbname = 'my_database';
		protected $user = 'root';
		protected $pass = 'root';
        
        function __construct() {
            try {
                $this->con = new PDO("mysql:host=$this->server;dbname=".$this->dbname, $this->user, $this->pass);
                // set the PDO error mode to exception
                $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                var_dump($this->con);
                return $this->con;
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        public function execute($query){
            $stmt = $this->con->prepare($query);
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
    }