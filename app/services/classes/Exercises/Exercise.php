<?php

namespace Exercises;

class Exercise extends \Db
{

    public function addExercise($muscle_id, $exercise_name, $bg_img)
    {
        $sql = "INSERT INTO exercise (muscle_id, exercise_name, background_img) VALUES(?, ?, ?)";
        return $this->execute($sql, [$muscle_id, $exercise_name, $bg_img]);
    }

    public function getAllExercises(){
        $sql = "SELECT * FROM exercise";
        return $this->execute($sql);
    }


    public function getTotalRepetitionsByUserId($userId){
        $sql = "SELECT e.exercise_name, SUM(we.reps * we.sets) AS 'total_reps' 
                FROM workout_exercise we 
                INNER JOIN exercise e ON e.id = we.exercise_id 
                WHERE we.user_id = ? GROUP BY e.exercise_name";
        return $this->execute($sql, [$userId]);
    }

    public function getTotalRepetitionsByExercise($userId, $exerciseId){
        $sql = "SELECT e.exercise_name, SUM(we.reps * we.sets) AS 'total_reps' 
                FROM workout_exercise we INNER JOIN exercise e ON e.muscle_id = we.exercise_id 
                WHERE user_id = ? AND e.id = ? GROUP BY e.exercise_name";
        return $this->execute($sql, [$userId, $exerciseId]);
    }

    public function getMonthlyRepsByExercise($userId, $exerciseId){
        $sql = "SELECT e.exercise_name, SUM(we.reps * we.sets) AS 'total_reps' 
                FROM workout_exercise we JOIN exercise e ON e.id = we.exercise_id 
                WHERE we.user_id = ? AND we.exercise_id = ? 
                AND MONTH(we.updated_at) = MONTH(CURRENT_DATE())
                AND YEAR(we.updated_at) = YEAR(CURRENT_DATE())
                OR we.user_id = ? AND we.exercise_id = ? AND MONTH(we.created_at) = MONTH(CURRENT_DATE())
                AND YEAR(we.created_at) = YEAR(CURRENT_DATE())
                GROUP BY e.exercise_name";
        return $this->execute($sql, [$userId, $exerciseId, $userId, $exerciseId]);
    }

    function getMaxWeightByExerciseId($userId, $exerciseId){
        $sql = "SELECT e.exercise_name, MAX(we.weight) AS weight FROM workout_exercise we JOIN exercise e ON e.muscle_id = we.exercise_id WHERE user_id =? AND e.id = ? GROUP BY e.exercise_name;";
        return $this->execute($sql, [$userId, $exerciseId]);
    }
}