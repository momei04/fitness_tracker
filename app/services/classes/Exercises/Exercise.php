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
}