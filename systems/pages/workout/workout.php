<?php
    include('../includes/header.php');
    require_once('../../classes/Workout.php');
    require_once('../../classes/Exercise.php');
    $workout = new Workout();
    $exercise = new Exercise();
?>
    <link rel="stylesheet" href="../../style/workout.css">
    <div class="content">
        <div class="grid-container">
            <div class="workout">
                <div class="workout-header" style="background-image: url('<?php echo($workout->getWorkoutImg($_GET['workout_id'], $_SESSION['user_id'])) ?>');">
                    <div class="layer"></div>
                    <h1>
                        <?php echo $workout->getWorkoutTitle($_GET['workout_id']);?>
                    </h1>

                    <button class="add_exercise_button">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
                <div class="content">
                    <table class="workoutTable">
                        <thead>
                            <tr>
                                <td><?php $workout->getLanguageString('EXERCISE', $_SESSION['language_id']); ?></td>
                                <td><?php $workout->getLanguageString('SETS', $_SESSION['language_id']); ?></td>
                                <td><?php $workout->getLanguageString('REPS', $_SESSION['language_id']); ?></td>
                                <td><?php $workout->getLanguageString('WEIGHT', $_SESSION['language_id']); ?></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $workoutInfor = $workout->getWorkoutInformationByID($_SESSION['user_id'], $_GET['workout_id']);
                            foreach ($workoutInfor as $workouts) {
                                echo
                                "<tr>
                                    <td>" . $workouts['exercise_name'] . "</td>
                                    <td>" . $workouts['sets'] . "</td>
                                    <td>" . $workouts['reps'] . "</td>
                                    <td>" . $workouts['weight'] . "</td>
                                    <td><button class='delete_btn'><i class='fa-solid fa-trash' data-user_id=".$_SESSION['user_id']." data-exercise_id =" . $workouts['exercise_id'] . " data-workout_id =" . $_GET['workout_id'] . "></i></button></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="infoContainer">
                        <div class="additionalInfos">
                            <div class="item desc">
                                <h3><?php $workout->getLanguageString('DESCRIPTION', $_SESSION['language_id']); ?></h3>
                                <p class="description"><?php echo $workout->getWorkoutDescByName($_GET['workout_id']); ?></p>
                            </div>
                            <div class="item stat">
                            <!-- TODO: get the user id in session variable instead of hard coded -->
                                <h3><?php echo $workout->getWorkoutUserName($_SESSION['user_id'], $_GET['workout_id']); ?></h3>
                                <p><?php $workout->getLanguageString('USER', $_SESSION['language_id']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="../formValidation/formHandler.php" method="post" class="insertExerciseToWorkout">
        <h3><?php $workout->getLanguageString('USER_NAME', $_SESSION['language_id']); ?></h3>
        <select id="edit_workout_exercise_id" name="exercise_id">
            <?php 
                $exercises = $exercise->getAllExercises(); 
                foreach ($exercises as $exercise) {
                    echo "<option value=".$exercise['exercise_id'].">".$exercise['exercise_name']."</option>";
                }
                
            ?>
        </select>
        <input hidden id="edit_workout_workout_id" value="<?php echo $_GET['workout_id'];?>" name="workout_id">
        </input>
        <input hidden type="number" value="<?php echo $_SESSION['user_id'];?>" data-user_id="<?php echo $_SESSION['user_id'];?>" id="edit_workout_user_id" name="user_id">
        <input type="number" placeholder="sets" id="edit_workout_sets" name="sets">
        <input type="number" placeholder="reps" id="edit_workout_reps" name="reps">
        <input type="number" placeholder="weight" id="edit_workout_weight" name="weight">
        <button type="submit">Submit</button>
    </form>

<?php
    include('../includes/footer.php');
?>