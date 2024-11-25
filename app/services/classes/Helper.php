<?php


use Exercises\Exercise;
use Relay\Event;

include_once 'Db.class.php';
include_once 'Workout/Workout.class.php';
include_once 'Exercises/Exercise.php';
include_once 'Event/Event.php';
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

    public function getWeekdays($language_id)
    {
        if ($language_id == 1){
            $err = ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag'];
        }else{
            $err = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        }
        return $err;
    }

    public function getRepeatPatterns($language_id)
    {
        if ($language_id == 1){
            $err = ['Täglich', 'Wöchentlich', 'alle 2 Wochen', 'alle 4 Wochen', 'jeden 2. Tag', 'einmalig'];
        }else{
            $err = ['daily', 'weekly', 'every 2 Weeks', 'monthly', 'every other day', 'once'];
        }
        return $err;
    }

    public function getEvents($user_id)
    {
        $event = new \Event();
        return $event->getEvents($user_id);
    }

    public function getDoneWorkoutPercentageCurrentMonth($user_id)
    {
        $workout = new Workout();
        return $workout->getDoneWorkoutPercentageCurrentMonth($user_id);
    }

    public function getMostDoneExercises($user_id)
    {
        $exercise = new Exercise();
        return $exercise->getMostDoneExercises($user_id);
    }

    public function getNextEvent($user_id)
    {
        $event = new \Event();
        return $event->getNextEvent($user_id);
    }

    public function getMostWorkedMuscleGroups($user_id)
    {
        $workout = new Exercise();
        return $workout->getMostWorkedMuscleGroups($user_id);
    }


}