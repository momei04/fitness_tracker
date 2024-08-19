<?php 
	/**
	* Database Connection
	*/
	class DbConnect {

		protected $con;
		protected $server = 'localhost';
		protected $dbname = 'fitness_tracker';
		protected $user = 'root';
		protected $pass = '';

		public function __construct() {
			try {
				$this->con = new PDO('mysql:host=' .$this->server .';dbname=' . $this->dbname, $this->user, $this->pass);
				$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (\Exception $e) {
				echo "Database Error: " . $e->getMessage();
			}
		}

        //view data
		public function viewData($table){
			$query = "SELECT * FROM {$table}";
			$stmt = $this->con->query($query);
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}

        public function getLanguageString($language_key, $language_id){
			$query = "SELECT string FROM languages_strings WHERE language_key = '{$language_key}' AND language_id = '{$language_id}'";
			$stmt = $this->con->query($query);
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			echo $data[0]['string'];
		}

		public function searchData($name, $table, $column){
			$query = "SELECT {$column} FROM {$table} WHERE {$column} LIKE '%{$name}%'";
			$stmt = $this->con->prepare($query);
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}

        public function execute($query){
            $stmt = $this->con->prepare($query);
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
	}
?>