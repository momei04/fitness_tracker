<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/services/classes/Db.class.php';

class Workout extends Db{
    public function getWorkouts($id){
        $sql = "SELECT * FROM workout w  JOIN workout_cover_images wc ON wc.id = w.cover_img_id  WHERE user_id = ?";
        return $this->execute($sql, [$id]);
    }

    public function getWorkoutDetails($id){
        $sql = "SELECT * FROM workout WHERE id = ?";
        return $this->execute($sql, [$id]);
    }

    public function getStats($id){
        $sql = "SELECT * FROM workout WHERE id = ?";
        return $this->execute($sql, [$id]);
    }

    public function getWorkoutDatails($workout_id) {
        $sql = "SELECT *  
                FROM workout w 
                JOIN workout_type wt ON wt.id = w.id 
                JOIN workout_cover_images wc ON wc.id = w.cover_img_id 
                JOIN users u ON u.id = w.user_id
                WHERE w.id = ?";
        return $this->execute($sql, [$workout_id]);
    }

    public function getWorkoutExercises($workout_id) {
        $sql = "
                SELECT * 
                FROM workout_exercise we
                JOIN exercise e ON e.id = we.exercise_id
                WHERE we.workout_id = ?";
        return $this->execute($sql, [$workout_id]);
    }

    public function getExerciseTypes() {
        $sql = "SELECT * FROM  exercise e";
        return $this->execute($sql);
    }


    public function insertExerciseInWorkout($sets, $reps, $weight, $workout_id, $exercise, $user_id)
    {
        $sql = "INSERT INTO workout_exercise(user_id, workout_id, exercise_id, sets, reps, weight) VALUES(?,?,?,?,?,?)";
        return $this->execute($sql, [$user_id, $workout_id, $exercise, $sets, $reps, $weight]);
    }

    public function delete($workout_id, $exercise, $user_id)
    {
        $sql = "DELETE FROM workout_exercise WHERE user_id = ? AND workout_id = ? AND exercise_id = ?";
        return $this->execute($sql, [$user_id, $workout_id, $exercise]);
    }

    public function getWorkoutExercise($workout_id, $exercise, $user_id)
    {
        $sql = "
                SELECT * 
                FROM workout_exercise we
                JOIN exercise e ON e.id = we.exercise_id
                WHERE we.workout_id = ? AND exercise_id = ? AND user_id = ?";
        return $this->execute($sql, [$workout_id, $exercise, $user_id]);
    }
}