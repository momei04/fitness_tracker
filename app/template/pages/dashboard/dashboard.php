<?php
session_start();
    include_once '../../includes/header.php';
    $helper = new Helper();
    $total_reps = $helper->getTotalRepetitionsByUserId($_SESSION['user']['user_id']);
    $monthly_reps = $helper->getMonthlyRepsByExercise($_SESSION['user']['user_id'], 1);
?>
    <link rel="stylesheet" href="../../style/dashboard.css">
<div class="title-container">
    <h3><?php echo $helper->getLanguageString('STATISTICS', $_SESSION['user']['language']) ?></h3>
    <h6>Du hast diesen Monat einige Gewichte gestämmt</h6>
</div>
    <div class="dashboard-container">
        <?php foreach ($total_reps as $rep){?>
        <div class="simple_stats_item">
            <!--<canvas id="best_exercise"></canvas>-->
            <h4><?php echo $rep['total_reps'];?> Wdh.</h4>
            <p><?php echo $rep['exercise_name'];?></p>
        </div>
        <?php }?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../../js/pages/statistics.js"></script>
<?php
    include_once '../../includes/footer.php';
    /*
     * Übung mit den meisten Wiederholungen
     * SELECT reps * sets AS 'total_reps' FROM exercise WHERE exercise_id = ?
     *
     * Übungen mit dem meisten gewicht
     *
     * Übung mit der besten Steigerung
     *
     * Aufschlüsseln der Übungen nach Muskelgruppen
     *
     * Anzahl aller Workouts in Zeitraum
     *
     * Gesammtdauer für Workouts diesen Zeitraum
     *
     * Gray Areas -> Übungen mit wenigen Wiedwerholungen im Verglewich zum Vormonat
     *
     */
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
