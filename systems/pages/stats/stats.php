<?php
    include('../includes/header.php');
    require_once('../../classes/Workout.php');
    $workout = new Workout();
?>
    <h1><?php $workout->getLanguageString('STATS', $_SESSION['language_id']) ?></h1>
<?php
    include('../includes/footer.php');
?>