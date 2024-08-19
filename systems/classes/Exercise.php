<?php
    require_once('DbConnect.php');
    class Exercise extends DbConnect{

        public function getAllExercises(){
            $query = "SELECT e.exercise_id, e.exercise_name, e.background_image AS background_image, mg.label_color AS label_color, mg.muscle_name AS muscle_name
                FROM exercise e
                JOIN muscle_group mg ON e.muscle_id = mg.muscle_id
                ";
			$data = $this->execute($query); 
			return $data;
        }

        public function getExerciseById($id) {
            $query = "SELECT * FROM exercise e WHERE exercise_id ={$id}";
			$data = $this->execute($query); 
			return $data;
        }

        // getting all exercises in a workout
        public function getExerciseDataByWorkout($workout_id, $exercise){
			$query = "SELECT e.exercise_name, we.sets, we.reps , we.weight, we.updated_at 
						FROM workout_exercise we 
						JOIN exercise e on e.exercise_id = we.exercise_id 
						where we.workout_id = {$workout_id} AND we.exercise_id = {$exercise}";
			$data = $this->execute($query); 
			return $data;
		}

        public function addExercise( $exercise_name, $muscle_id , $background_image=null){
            $query = "INSERT INTO fitness_tracker.exercise (exercise_name, muscle_id, background_image)
                        VALUES(?, ?, ?);";
			$stmt = $this->con->prepare($query);
			if($stmt->execute(array($exercise_name, $muscle_id, $background_image))){
				$lastID = $this->con->lastInsertId();
				//echo json_encode(array("message"=> 'Erfolgreich hinzugefügt', "type"=> 'sucess'));
			}
        }

        public function getAllMuscleGroups(){
            $query = "SELECT * FROM muscle_group";
			$data = $this->execute($query); 
			return $data;
        }
    }