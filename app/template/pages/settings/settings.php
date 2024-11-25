<?php
    session_start();
    include_once '../../includes/header.php';
    $helper = new Helper();
    $exercises = $helper->getAllExercises();
?>
<link rel="stylesheet" href="../../style/settings.css">
<div class="title-container">
    <h3><?php echo $helper->getLanguageString('SETTINGS', $_SESSION['user']['language']) ?></h3>
</div>