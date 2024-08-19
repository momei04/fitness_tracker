<?php
    require_once('DbConnect.php');
    class Workout extends DbConnect{
    

        public function getWorkoutInformationByID($user, $workout_id){
			$query = "SELECT MAX(we.weight) AS 'weight', w.workout_name, u.user_name, u.user_id, w.workout_id,  MAX(we.sets) AS 'sets',  MAX(we.reps) AS 'reps', we.updated_at AS 'updated_at', e.exercise_name, e.exercise_id 
					FROM workout w 
					JOIN users u ON u.user_id = w.user_id 
					JOIN workout_exercise we ON we.workout_id = w.workout_id 
					JOIN exercise e ON e.exercise_id = we.exercise_id 
					WHERE u.user_id = {$user} AND w.workout_id = '{$workout_id}'
                    GROUP BY e.exercise_name
                    ORDER BY we.weight desc";
			$data = $this->execute($query); 
			return $data;
		}
        
		public function getWorkoutTitle($workout_id){
			$query = "SELECT w.workout_name FROM workout w WHERE w.workout_id = {$workout_id}";
			$stmt = $this->con->prepare($query);
			$stmt->execute();
			$data = $stmt->fetch();
			return $data['workout_name'];
		}

        public function getAllWorkouts($workout_id){
			$query = "SELECT w.workout_name FROM workout w WHERE w.workout_id = {$workout_id}";
			$stmt = $this->con->prepare($query);
			$stmt->execute();
			$data = $stmt->fetch();
			return $data;
		}

        public function getWorkoutTypes(){
			$query = "SELECT * FROM workout_type";
			$stmt = $this->con->prepare($query);
			$stmt->execute();
			$data = $stmt->fetchAll();
			return $data;
		}

		public function getWorkoutDescByName($workout_id){
			$query = "SELECT w.workout_description FROM workout w WHERE w.workout_id = {$workout_id}";
			$stmt = $this->con->prepare($query);
			$stmt->execute();
			$data = $stmt->fetch();
			return $data['workout_description'];
		}

		public function getWorkoutUserName($user_id, $workout_id){
			$query = "SELECT u.user_name 
					FROM workout w
					JOIN users u ON u.user_id = w.user_id 
					WHERE u.user_id = {$user_id} AND w.workout_id = {$workout_id}";
			$stmt = $this->con->prepare($query);
			$stmt->execute();
			$data = $stmt->fetch();
			return $data['user_name'];
		}

        public function getWorkoutTitlesByUser($user_id){
            $query = "SELECT w.workout_name, w.workout_id
                    FROM workout w
                    WHERE w.user_id = {$user_id}";
			$data = $this->execute($query); 
			return $data;
        }

        public function getWorkoutImg($workout_id, $userId){
            $query = "SELECT path
                    FROM workout w 
                    LEFT JOIN workout_cover_images wci ON wci.image_id = w.cover_img_id
                    WHERE w.workout_id = {$workout_id} AND w.user_id = {$userId}";
			$data = $this->execute($query); 
			return $data[0]['path'];
        }

        public function getRandomWorkoutImage(){
            $query = "SELECT image_id
                    FROM  workout_cover_images wci";
			$stmt = $this->con->prepare($query);
			$stmt->execute();
			$data = $stmt->fetchAll();
			$key = array_rand($data);
            return $data[$key];
        }

        public function getWorkoutsByUserId($userId){
            $query = "SELECT * 
                    FROM workout w 
                    LEFT JOIN workout_cover_images wci ON wci.image_id = w.cover_img_id
                    WHERE w.user_id = {$userId}";
			$stmt = $this->con->prepare($query);
			$data = $this->execute($query); 
			return $data;
        }

		public function insertWorkout($title, $type, $user, $description, $workoutCount){
            /* var_dump($workoutCount); */
			$query = "INSERT INTO workout(workout_name, workout_type, user_id, workout_description, cover_img_id) VALUES(?, ?, ?, ?, ?)";
			$stmt = $this->con->prepare($query);
			if($stmt->execute(array($title, $type, $user, $description, $workoutCount['image_id']))){
				$lastID = $this->con->lastInsertId();
			}
		}

        public function insertExerciseIntoWorkout($exercise_id, $workout_id, $user_id, $sets = 3, $reps = 10, $weight= 0){
            $query = "INSERT INTO fitness_tracker.workout_exercise
                    (user_id, exercise_id, workout_id, `sets`, reps, weight, created_at, updated_at)
                    VALUES(?, ?, ?, ?, ?, ?, current_timestamp(), current_timestamp())
                    ON DUPLICATE KEY
                    UPDATE reps={$reps}, sets={$sets}, weight={$weight}, updated_at=current_timestamp();";
			$stmt = $this->con->prepare($query);
            $stmt->execute(array($user_id, $exercise_id, $workout_id, $sets, $reps, $weight));
        }

        public function deleteExerciseFromWorkout($workout_id, $exercise_id, $user_id){
            $query = "DELETE FROM fitness_tracker.workout_exercise
                    WHERE user_id = ? AND exercise_id = ? AND workout_id= ?";
			$stmt = $this->con->prepare($query);
            $stmt->execute(array($user_id, $exercise_id, $workout_id));
        }

        public function deleteWorkout($workout_name, $user_id){
            $query = "DELETE FROM workout
                    WHERE user_id = ? AND workout_name= ?";
			$stmt = $this->con->prepare($query);
            $stmt->execute(array($user_id, $workout_name));
        }
    }