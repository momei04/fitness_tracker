<?php
    include('../includes/header.php');
    require_once('../../classes/Exercise.php');
    $exerciseClass = new Exercise();
?>
<link rel="stylesheet" href="../../style/exercise.css">
<div class="exercisePage">
    <!-- All Exercises -->
    <div class="content">
        <div class="modal">
            <div class="modal-content">
                <form action="../formValidation/formHandler.php" class="addExerciseForm">
                    <h3>
                        <?php $exerciseClass->getLanguageString('ADD_EXERCISE', $_SESSION['language_id']);?>
                    </h3>
                    <div>
                        <input type="text" name="exerciseName" id="exerciseName" placeholder="<?php $exerciseClass->getLanguageString('EXERCISE_NAME', $_SESSION['language_id']);?>">
                        <select name="muscleGroup" id="muscleGroup"></select>
                        <textarea name="description" id="description" placeholder="<?php $exerciseClass->getLanguageString('DESCRIPTION', $_SESSION['language_id']);?>"></textarea>
                        <button type="submit"><?php $exerciseClass->getLanguageString('SUBMIT_ADD_EXERCISE', $_SESSION['language_id']);?></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="exercise_wrapper">
            <?php
                $exerciseList = $exerciseClass->getAllExercises();
                foreach ($exerciseList as $exercise) {
                    echo 
                    "<div class='exercise' style=' background-size:cover; background-position:center; background-image: url(".$exercise['background_image'].")'>" . 
                        "<h4>".$exercise['exercise_name']."</h4>".
                        "<div class='layer' style='position:absolute; top:0; left:0'></div>".
                        "<p class='label' style='background-color: ".$exercise['label_color']."'>".$exercise['muscle_name']."</p>".
                    "</div>";
                }
            ?>
            
        </div>
        <div class='exercise add'>
            <h2><?php echo $exerciseClass->getLanguageString('ADD_EXERCISE', $_SESSION['language_id']); ?></h2>
        </div>
    </div>
</div>

<script>
    
    let addButton = document.querySelector('.exercise.add');
    let modal = document.querySelector('.modal');
    let status = 0;
    hideModal(modal);

    addButton.addEventListener('click', function() {
        if(status % 2 == 0){
            showModal(modal);
        } else{
            hideModal(modal);
        }
        status++;
    });

    function hideModal(element){
        element.style.width = '0%';
        element.style.height = '0%';
        element.style.display = 'none';
        element.style.overfow = 'hidden';
        element.style.opacity = '0';
    }

    function showModal(element){
        element.style.width = '100%';
        element.style.height = '100%';
        element.style.display = 'block';
        element.style.opacity = '1';
    }

</script>
<?php
    include('../includes/footer.php');
?>