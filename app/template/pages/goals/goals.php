<?php
session_start();
include_once '../../includes/header.php';
$helper = new Helper();
$total_reps = $helper->getTotalRepetitionsByUserId($_SESSION['user']['user_id']);
$monthly_reps = $helper->getMonthlyRepsByExercise($_SESSION['user']['user_id'], 1);
?>

<div class="title-container">
    <h3><?php echo $helper->getLanguageString('MY_GOALS', $_SESSION['user']['language']) ?></h1>
</div>