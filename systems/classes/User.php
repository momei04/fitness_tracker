<?php
    require_once('DbConnect.php');
    class User extends DbConnect{

        public $username;
        public $vorname;
        public $nachname;
        public $email;
        public $password;
        public $street;
        public $ort;
        public $plz;

        

        public function getAllUsers(){
            $query = "SELECT * FROM users";
			$data = $this->execute($query); 
			echo json_encode($data);
        }

        public function getUserById($id) {
            $query = "SELECT * FROM users WHERE user_id ={$id}";
			$data = $this->execute($query); 
			echo json_encode($data);
        }

        public function getUserNameById($id) {
            $query = "SELECT user_name FROM users WHERE user_id ={$id}";
			$data = $this->execute($query); 
			echo json_encode($data);
        }

        public function getUserIdByName($username){
            $query = "SELECT * FROM users WHERE user_name = '{$username}'";
			$stmt = $this->con->prepare($query);
			$stmt->execute();
			$data = $stmt->fetch();
			return intval($data['user_id']);
        }

        public function signUp($username, $vorname, $nachname, $email, $password, $street, $ort, $plz){
            $query = "INSERT INTO users (user_name, vorname, nachname, email, password, street, ort, plz) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            //$query = "INSERT INTO users(user_name, vorname, nachname, email, password, street, ort, plz) VALUES({$username}, {$vorname}, {$nachname}, {$email}, {$password}, {$street}, {$ort}, {$plz})";
			$stmt = $this->con->prepare($query);
            
			if($stmt->execute(array($username, $vorname, $nachname, $email, $password, $street, $ort, $plz))){
				return true;
			}else{
                return false;
            }
        }

        public function saveSettings($username, $vorname, $nachname, $email, $street, $ort, $plz, $language){
            $query = "UPDATE users 
            SET user_name = ?, vorname = ?, nachname = ?, email = ?, street = ?, ort = ?, plz = ?, user_language = ?
            WHERE user_name = ?";

            //$query = "INSERT INTO users(user_name, vorname, nachname, email, password, street, ort, plz) VALUES({$username}, {$vorname}, {$nachname}, {$email}, {$password}, {$street}, {$ort}, {$plz})";
			$stmt = $this->con->prepare($query);
            
			if($stmt->execute(array($username, $vorname, $nachname, $email, $street, $ort, $plz, $language, $username))){
				return true;
			}else{
                return false;
            }
        }

        public function getAllLanguages(){
            $query = "SELECT * FROM languages_languages";
            $stmt = $this->con->prepare($query);
			$stmt->execute();
			$data = $this->execute($query); 
			$data = $stmt->fetchAll();
			return $data;
        }

        
    }