<?php
    session_start();
    include_once '../../includes/header.php';
    $helper = new Helper();
?>
<link rel="stylesheet" href="../../style/workout.css">

<?php
    $workout_info = $helper->getWorkoutDatails($_GET['workout_id']);
    $exercises = $helper->getWorkoutExercises($_GET['workout_id']);

?>
<?php if(!empty($workout_info)){ ?>
<div class="workout-detail-container">
    <div class="title-container">
        <h1><?php echo $workout_info[0]['workout_name'];?></h1>
        <button id="exercise_add">
            <i class="fa-solid fa-plus"></i>
        </button>
        <img src="<?php echo $workout_info[0]['cover_img_url']?>" alt="">
        <div class="layer"></div>
    </div>


    <div class="exercises_container">
        <table id="workout_overview_table">
            <thead>
                <tr>
                    <th><?php echo $helper->getLanguageString('EXERCISE', $_SESSION['user']['language']) ?></th>
                    <th><?php echo $helper->getLanguageString('SETS', $_SESSION['user']['language']) ?></th>
                    <th><?php echo $helper->getLanguageString('REPS', $_SESSION['user']['language']) ?></th>
                    <th><?php echo $helper->getLanguageString('WEIGHT', $_SESSION['user']['language']) ?></th>
                    <th><?php echo $helper->getLanguageString('EDIT', $_SESSION['user']['language']) ?></th>
                    <th><?php echo $helper->getLanguageString('DELETE', $_SESSION['user']['language']) ?></th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($exercises as $exercise){?>
                    <tr>
                        <td><?php echo $exercise['exercise_name'] ?></td>
                        <td><?php echo $exercise['sets'] ?></td>
                        <td><?php echo $exercise['reps'] ?></td>
                        <td><?php echo $exercise['weight'] ?></td>
                        <td><button class="exercise_history_button"
                                data-user_id="<?php echo $_SESSION['user']['user_id']?>"
                                data-workout_id="<?php echo $_GET['workout_id']?>"
                                data-exercise_id="<?php echo $exercise['exercise_id']?>"
                            ><i class="fa-solid fa-chart-column"></i></button></td>
                        <td>
                            <button class="delete_button"
                                    data-user_id="<?php echo $_SESSION['user']['user_id']?>"
                                    data-workout_id="<?php echo $_GET['workout_id']?>"
                                    data-exercise_id="<?php echo $exercise['exercise_id']?>">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="general_info">
        <div class="description">
            <h3>
                <?php echo $helper->getLanguageString('WORKOUT_DESCRIPTION', $_SESSION['user']['language']) ?>
            </h3>
            <p>
                <?php echo $workout_info[0]['workout_description']?>
            </p>
        </div>
        <div class="user_name">
            <h3><?php echo $workout_info[0]['user_name']?></h3>
        </div>
    </div>
</div>

    <div class="modal create_exercise">
        <button class="closeBtn">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="modal-content">
            <form>
                <?php $exercise_types = $helper->getExerciseTypes();?>
                <h3><?php echo $helper->getLanguageString('CREATE_EXERCISE', $_SESSION['user']['language']) ?></h3>
                <div class="input-container">
                    <select id="exercise">
                        <?php foreach ($exercise_types as $exercise_type){ ?>
                            <option value="<?php echo $exercise_type['id']?>"><?php echo $exercise_type['exercise_name']?></option>
                        <?php }?>
                    </select>
                </div>

                <div class="input-container">
                    <label for="sets">
                        <?php echo $helper->getLanguageString('SETS', $_SESSION['user']['language']) ?>
                    </label>
                    <input type="number" name="sets" id="sets" placeholder="<?php echo $helper->getLanguageString('SETS', $_SESSION['user']['language']) ?>">
                </div>
                <div class="input-container">
                    <label for="sets">
                        <?php echo $helper->getLanguageString('REPS', $_SESSION['user']['language']) ?>
                    </label>
                    <input type="number" name="sets" id="reps" placeholder="<?php echo $helper->getLanguageString('REPS', $_SESSION['user']['language']) ?>">
                </div>
                <div class="input-container">
                    <label for="sets">
                        <?php echo $helper->getLanguageString('WEIGHT', $_SESSION['user']['language']) ?>
                    </label>
                    <input type="number" name="sets" id="weight" placeholder="<?php echo $helper->getLanguageString('WEIGHT', $_SESSION['user']['language']) ?>">
                </div>
                <input id="action" type="hidden" name="action" value="create_exercise_workout">
                <input id="category" type="hidden" name="category" value="workout">
                <input id="user_id" type="hidden" name="user_id" value="<?php echo $_SESSION['user']['user_id'] ?>">
                <input id="workout_id" type="hidden" name="workout_id" value="<?php echo $_GET['workout_id'] ?>">
                <button id="create_exercise_form_submit">
                    <?php echo $helper->getLanguageString('CREATE_EXERCISE', $_SESSION['user']['language']) ?>
                </button>
            </form>
        </div>
    </div>


    <!--History Modal-->
    <div class="modal exercise_history">
        <button class="closeBtn">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="modal-content">

        </div>
    </div>
    <div class="modal-overview"></div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="../../js/pages/workout.js"></script>
<?php }else{
    header("Location: ../dashboard/dashboard.php");
}?>

<?php include_once '../../includes/footer.php';?>

