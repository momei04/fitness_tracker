<?php
session_start();
require_once('../../classes/DbConnect.php');
require_once('../../classes/Workout.php');
require_once('../../classes/Exercise.php');
	$action = $_REQUEST['action'];
	$con = new DbConnect();
	switch ($action) {
		case 'search':
			$name = isset($_POST['name']);
			$table = isset($_POST['table']);
			$column = isset($_POST['column']);
			$data = $con->searchData($name, $table, $column);
			echo json_encode($data);
			break;
		
		case 'insertWorkout':
            $workout = new Workout();
			$name = $_POST['title'];
            $user = $_SESSION['user_id'];
            $type = $_POST['type'];
            $description = $_POST['description'];
            $workoutCount = $workout->getRandomWorkoutImage();
			$data = $workout->insertWorkout($name, $type, $user, $description, $workoutCount);
			$workouts = $workout->getWorkoutsByUserId($user);
            echo json_encode($workouts);
            break;

        case 'deleteWorkout':
            $workout = new Workout();
            $workoutName = $_POST['title'];
            $user_id = $_SESSION['user_id'];
            $data = $workout->deleteWorkout($workoutName, $user_id);
            $workouts = $workout->getWorkoutsByUserId($user_id);
            echo json_encode($workouts);
            break;

		case 'getHistoryByWorkoutData':
            $exerciseClass = new Exercise();
			$workout = $_POST['workout'];
			$exercise = $_POST['exercise'];
			$data = $exerciseClass->getExerciseDataByWorkout($workout, $exercise);
			break;
        
        case 'addExercise':
            $exerciseClass = new Exercise();
            //Params
			$name = $_POST['exercise_name'];
			$muscle_group = $_POST['muscle_group'];

			$exerciseClass->addExercise($name, $muscle_group);
            $exercises = $exerciseClass->getAllExercises();
			echo json_encode($exercises);
            break;

        case 'insertExerciseToWorkout':
            $workoutClass = new Workout();
            $workout = intval($_POST['workout_id']);
            $user = $_POST['user_id'];
			$exercise = $_POST['exercise_id'];
            $sets = $_POST['sets'];
			$reps = $_POST['reps'];
            $weight = $_POST['weight'];
            $workoutClass->insertExerciseIntoWorkout($exercise, $workout, $user, $sets, $reps, $weight);
            $data = $workoutClass->getWorkoutInformationByID($user, $workout);
            echo json_encode($data);
            break;


        case 'delete_workout_item':
            $workoutClass = new Workout();
            $workout = intval($_POST['workout_id']);
            $user = $_POST['user_id'];
			$exercise = $_POST['exercise_id'];

            $workoutClass->deleteExerciseFromWorkout($workout, $exercise , $user);
            $data = $workoutClass->getWorkoutInformationByID($user, $workout);
            echo json_encode($data);
            break;

        case 'getMuscleGroups':
            $exerciseClass = new Exercise();
            $muscleGroups = $exerciseClass->getAllMuscleGroups();
            echo json_encode($muscleGroups);
            break;

        /* Settings */
        case 'saveSettings': 
        $user = new User();
        $username = $_POST['username'];
        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $email = $_POST['email'];
        $street = $_POST['street'];
        $ort = $_POST['ort'];
        $plz = $_POST['plz'];
        $language = $_POST['language_id'];
        $_SESSION['session_duration'] = $_POST['session_duration'] * 60;
        $user->saveSettings($username, $vorname, $nachname, $email, $street, $ort, $plz, $language);
            
        /* Setting the session variables again */
        $_SESSION['vorname'] = $_POST['vorname'];
        $_SESSION['nachname'] =$_POST['nachname'];
        $_SESSION['email'] =$_POST['email'];
        $_SESSION['plz'] = $_POST['plz'];
        $_SESSION['ort'] = $_POST['ort'];
        $_SESSION['street'] = $_POST['street'];
        $_SESSION['username'] = $_POST['username'];
        $_SESSION["last_regeneration"] = time();
        $_SESSION['language_id'] = $_POST['language_id'];

        /* Refreshing the page */
        echo "<meta http-equiv='refresh' content='0'>";
        break;
	}