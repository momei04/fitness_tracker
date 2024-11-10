<?php
include_once 'Db.class.php';
include_once 'Workout/Workout.class.php';
class Helper extends Db{
    public function getWorkouts($id){
        $workout = new Workout();
        return $workout->getWorkouts($id);
    }

    public function getWorkoutDetails($id){
        $workout = new Workout();
        return $workout->getWorkoutDetails($id);
    }

    public function getStats($id){
        $workout = new Workout();
        return $workout->getStats($id);
    }

    public function getWorkoutDatails($workout_id) {
        $workout = new Workout();
        return $workout->getWorkoutDatails($workout_id);
    }

    public function getWorkoutExercises($workout_id) {
        $workout = new Workout();
        return $workout->getWorkoutExercises($workout_id);
    }

    public function getExerciseTypes() {
        $workout = new Workout();
        return $workout->getExerciseTypes();
    }


}