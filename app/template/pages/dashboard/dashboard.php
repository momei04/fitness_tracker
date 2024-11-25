<?php
session_start();
    include_once '../../includes/header.php';
    $helper = new Helper();
    $total_reps = $helper->getTotalRepetitionsByUserId($_SESSION['user']['user_id']);
    $monthly_reps = $helper->getMonthlyRepsByExercise($_SESSION['user']['user_id'], 1);
    $done_percentage = $helper->getDoneWorkoutPercentageCurrentMonth($_SESSION['user']['user_id']);
    $most_exercises = $helper->getMostDoneExercises($_SESSION['user']['user_id']);
    $muscle_groups = $helper->getMostWorkedMuscleGroups($_SESSION['user']['user_id']);
?>
    <link rel="stylesheet" href="../../style/dashboard.css">
    <div class="dashboard-container">
        <div class="grid-item top-exercises-container">
            <div class="content-container">
                <h3>Deine top 3 Übungen im <?php echo date('M')?></h3>
                <div class="stats-container">
                    <?php foreach ($total_reps as $rep){?>

                        <div class="simple_stats_item">
                            <h4><?php echo $rep['total_reps'];?> Wdh.</h4>
                            <p><?php echo $rep['exercise_name'];?></p>
                        </div>
                    <?php }?>
                </div>
            </div>

        </div>
        <div class="grid-item workouts_done-container">
            <div class="flex">
                <input type="hidden" class="workout_ratio" data-done_percentage="<?php echo $done_percentage ?>">

                <canvas id="workouts_done" ></canvas>
                <h3><?php echo $done_percentage ?> %</h3>
            </div>

        </div>
        <div class="grid-item goals_overview">
            <?php foreach($muscle_groups as $muscle_group){?>
                <input type="hidden" class="most_trained_muscle" name="<?php echo $muscle_group['muscle_name']?>" value="<?php echo $muscle_group['count']?>">
            <?php } ?>
            <canvas id="must_trained_muscles"></canvas>
        </div>
        <div class="grid-item best-growing-exercises">
            <?php foreach($most_exercises as $exercise){?>
                <input type="hidden" class="most_exercise" name="<?php echo $exercise['exercise_name']?>" value="<?php echo $exercise['count']?>">
            <?php } ?>
            <canvas id="exercises_months"></canvas>
        </div>
        <div class="grid-item ">

            <?php $next_training = $helper->getNextEvent($_SESSION['user']['user_id']); ?>
            <h3 class="title">Next Event</h3>
            <div class="next-workout-preview">
                <?php if(isset($next_training[0])){ ?>
                <div>
                    <h4 class="sub-title"><?php echo $next_training[0]['name']?></h4>
                    <p class="time"><?php echo date_format(new DateTime($next_training[0]['date']),"d.m.Y") ?></p>
                </div>

                <p ><?php echo $next_training[0]['workout_type_name'] ?></p>
                <?php }else{ ?>
                    <p>Keine verfügbaren Events in nächster Zeit geplant</p>
                <?php }?>
            </div>
        </div>
        <div class="grid-item most-trained-group">

        </div>
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
<script>

</script>
