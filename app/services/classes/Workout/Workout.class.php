<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/services/classes/Db.class.php';

class Workout extends Db{
    public function getWorkouts($id){
        $sql = "SELECT * FROM workout w INNER JOIN workout_cover_images wc ON wc.img_id = w.cover_img_id WHERE w.user_id = ?";
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
        $sql = "SELECT * FROM workout w JOIN workout_type wt ON wt.id = w.workout_type JOIN workout_cover_images wc ON wc.img_id = w.cover_img_id JOIN users u ON u.id = w.user_id WHERE w.id = ?";
        return $this->execute($sql, [$workout_id]);
    }

    public function getWorkoutExercises($workout_id) {
        $sql = "
                SELECT we.sets, we.reps, MAX(we.weight) AS weight, we.user_id, e.exercise_name, e.muscle_id, we.exercise_id, we.workout_id 
                FROM workout_exercise we
                JOIN exercise e ON e.id = we.exercise_id
                WHERE we.workout_id = ?
                GROUP BY we.sets, we.reps, we.user_id, e.exercise_name, e.muscle_id, we.exercise_id, we.workout_id";
        return $this->execute($sql, [$workout_id]);
    }

    public function getExerciseHistory($user_id, $workout_id, $exercise_id) {
        $sql = "
                SELECT we.sets, we.reps, we.weight AS weight, e.exercise_name, DATE_FORMAT( we.updated_at, '%d.%m.%Y') AS updated_at  
                FROM workout_exercise we
                JOIN exercise e ON e.id = we.exercise_id
                WHERE we.workout_id = ? AND we.exercise_id = ? AND we.user_id = ?";
        return $this->execute($sql, [$workout_id, $exercise_id, $user_id]);
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

    public function addWorkout($user, $workout_name, $workout_type, $desc, $img)
    {
        $sql = "INSERT INTO workout(user_id, workout_name, workout_type, workout_description, cover_img_id) VALUES (?,?,?,?, ?)";
        return $this->execute($sql, [$user, $workout_name, $workout_type, $desc, $img]);
    }

    public function getWorkoutTypes()
    {
        $sql = "SELECT * FROM workout_type";
        return $this->execute($sql);
    }

    public function getPaths()
    {
        $sql = "SELECT * FROM workout_cover_images";
        return $this->execute($sql);
    }

    public function deleteWorkout($workout_id)
    {
        $sql_workout_exercise = "DELETE FROM workout_exercise WHERE workout_id = ?";
        $this->execute($sql_workout_exercise, [$workout_id]);
        $sql = "DELETE FROM workout WHERE id = ?";
        $this->execute($sql, [$workout_id]);
    }

    public function getAllExercises()
    {
        $sql = "SELECT * FROM exercise e JOIN muscle_group mg on mg.id = e.muscle_id";
        return $this->execute($sql);
    }

    public function getMuscleGroups()
    {
        $sql = "SELECT * FROM muscle_group mg";
        return $this->execute($sql);
    }
}