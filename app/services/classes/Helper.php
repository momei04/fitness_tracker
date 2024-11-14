<?php


use Exercises\Exercise;

include_once 'Db.class.php';
include_once 'Workout/Workout.class.php';
include_once 'Exercises/Exercise.php';
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

    public function getExerciseHistory($user_id, $workout_id, $exercise_id){
        $workout = new Workout();
        return $workout->getExerciseHistory($user_id, $workout_id, $exercise_id);
    }

    public function getMonthlyRepsByExercise($user_id, $exercise_id){
        $exercise  = new Exercise();
        return $exercise->getMonthlyRepsByExercise($user_id, $exercise_id);
    }

    public function getTotalRepetitionsByUserId($userId){
        $exercise = new Exercises\Exercise();
        return $exercise->getTotalRepetitionsByUserId($userId);
    }

    public function getTotalRepetitionsByExercise($userId, $exerciseId){
        $exercise = new Exercises\Exercise();
        return $exercise->getTotalRepetitionsByExercise($userId, $exerciseId);
    }

    function getMaxWeightByExerciseId($userId, $exerciseId){
        $exercise = new Exercises\Exercise();
        return $exercise->getMaxWeightByExerciseId($userId, $exerciseId);
    }

    public function getExerciseTypes() {
        $workout = new Workout();
        return $workout->getExerciseTypes();
    }

    public function getWorkoutTypes()
    {
        $workout = new Workout();
        return $workout->getWorkoutTypes();
    }

    public function getPaths(){
        $workout = new Workout();
        return $workout->getPaths();
    }

    public function getAllExercises()
    {
        $workout = new Workout();
        return $workout->getAllExercises();
    }

    public function getMuscleGroups() {
        $workout = new Workout();
        return $workout->getMuscleGroups();
    }


}