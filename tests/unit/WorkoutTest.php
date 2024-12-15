<?php

require 'app/services/classes/Workout/Workout.class.php';
require 'app/services/classes/Db.class.php';
class WorkoutTest extends \PHPUnit\Framework\TestCase
{

    /** @test*/
    public function testAddWorkout(){
        // Given that the User submitted the Create Workout Form
        $workout = new Workout();
        // when we call the insertExerciseInWorkout Method
        $workout->addWorkout(1, 'test', 1, 'test description', 'https://assets.goal.com/images/v3/bltf578ca9b686aef3f/Bukayo_Saka_Arsenal_2023-24_(2).jpg?auto=webp&format=pjpg&width=3840&quality=60');

        // the workout is inserted in the db
        $this->assertArrayHasKey('user_id', $workout);
    }
}