<?php
    session_start();
    include_once '../../includes/header.php';
    $helper = new Helper();
    $exercises = $helper->getAllExercises();
?>
<link rel="stylesheet" href="../../style/exercise.css">

<div class="title-container">
    <h1><?php echo $helper->getLanguageString('EXERCISES', $_SESSION['user']['language']) ?></h1>
    <button id="add_exercise">Add a exercise</button>
</div>
<div class="exercise_container">
    <?php foreach ($exercises as $exercise) {?>
        <div class="grid_item img-container">
            <h3><?php echo $exercise['exercise_name'] ?></h3>
            <div class="layer"></div>
            <img src="<?php echo $exercise['background_img'] ?>" alt="">
        </div>
    <?php }?>
</div>


<!--Modal-->
<div class="modal create_exercise">
    <button class="closeBtn">
        <i class="fa-solid fa-xmark"></i>
    </button>
    <div class="modal-content">
        <form method="post" id="exercise_add">
            <?php $muscle_groups = $helper->getMuscleGroups();?>
            <h3>
                <?php echo $helper->getLanguageString('CREATE_EXERCISE', $_SESSION['user']['language']) ?>
            </h3>
            <div class="input-container">
                <label for="exercise_name"><?php echo $helper->getLanguageString('EXERCISE_NAME', $_SESSION['user']['language']) ?></label>
                <input type="text" id="exercise_name" placeholder="<?php echo $helper->getLanguageString('EXERCISE_NAME', $_SESSION['user']['language']) ?>">
            </div>
            <div class="input-container">
                <label for="muscle_group"><?php echo $helper->getLanguageString('MUSCLE_GROUP', $_SESSION['user']['language']) ?></label>
                <select name="muscle_group" id="muscle_group">

                    <?php foreach ($muscle_groups as $muscle_group){ ?>
                        <option data-color="<?php echo $muscle_group['id'] ?>" value="<?php echo $muscle_group['id'] ?>">
                            <?php echo $muscle_group['muscle_name'] ?>
                        </option>
                    <?php }?>
                </select>
            </div>
            <div class="input-container">
                <label for="background_img"><?php echo $helper->getLanguageString('BACKGROUND_IMG_URL', $_SESSION['user']['language']) ?></label>
                <input type="text" id="background_img" placeholder="<?php echo $helper->getLanguageString('BACKGROUND_IMG_URL', $_SESSION['user']['language']) ?>">
            </div>
            <div class="input-container">
                <button type="submit" id="exercise_add_submit"><?php echo $helper->getLanguageString('CREATE_EXERCISE', $_SESSION['user']['language']) ?></button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overview"></div>


<script src="../../js/pages/exercises.js"></script>
<script>

</script>