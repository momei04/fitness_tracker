<?php
    session_start();
    include_once '../../includes/header.php';
    $helper = new Helper();
    $workouts = $helper->getWorkouts($_SESSION['user']['user_id']);
    $weekdays = $helper->getWeekdays($_SESSION['user']['language']);
    $repeat_patterns = $helper->getRepeatPatterns($_SESSION['user']['language']);

    $events = $helper->getEvents($_SESSION['user']['user_id']);
?>
<link rel="stylesheet" href="../../style/events.css">

<div class="event-page">
    <form action="" id="add_event_form" method="post">
        <h3><?php echo 'Create a repeating workout event' ?></h3>


        <div>
            <div class="calendar-container">
                <div class="input-container">
                    <select name="workout" id="workout">
                        <?php foreach ($workouts as $workout) { ?>
                            <option value="<?php echo $workout['id'] ?>"><?php echo $workout['workout_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-container">
                    <label for="title">From Date</label>
                    <input type="text" name="title" id="title">
                </div>
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['user_id'] ?>" id="user_id">
                <!--Von / Bis auswählen-->
                <div class="flex">
                    <div class="input-container">
                        <label for="from_date">From Date</label>
                        <input type="date" name="from_date" id="from_date">
                    </div>
                    <div class="input-container">
                        <label for="till_date">Till Date</label>
                        <input type="date" name="till_date" id="till_date">
                    </div>
                </div>

                <!-- <div class="day-container">   <!--Choosing the weekdays-->
                <?php /*foreach($weekdays as $key => $value){ */?>
                <div class="input-container">
                    <input type="checkbox" name="<?php /*echo $value*/?>" id="<?php /*echo $key */?>" value="<?php /*echo $value */?>" content="<?php /*echo $value*/?>">
                    <label for="<?php /*echo $key */?>"><?php /*echo $value*/?></label>
                </div>

                <?php /*}*/?>
            </div>-->
            <div class="input-container repeat_pattern">
                <select name="repeat_pattern" id="repeat_pattern">
                    <?php foreach($repeat_patterns as $key => $value){ ?>
                        <div class="input-container">
                            <option name="<?php echo $value?>" id="<?php echo $key ?>" value="<?php echo $value ?>"><?php echo $value?></option>
                        </div>

                    <?php }?>
                </select>
            </div>
            <button type="submit">Submit</button>
        </div>
    </form>
    <div class="event-container">
        <div class="time-header"></div>
        <table id="event_content">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Workout Type</th>
                    <th>Info</th>
                    <th>done</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($events as $event){ ?>
                    <tr>
                        <td><?php echo $event['name'] ?></td>
                        <td><?php echo date_format(new DateTime($event['date']),"d.m.Y") ?></td>
                        <td><?php echo $event['workout_type_name'] ?></td>
                        <td><a href="../workouts/workout_detail.php?workout_id=<?php echo $_SESSION['user']['user_id'] ?>">zum Workout</a></td>
                        <td><input type="checkbox" name="done" class="done" data-user_id="<?php echo $_SESSION['user']['user_id']?>" data-event_id="<?php echo $event['event_id']?>" <?php if($event['done']=== 1){echo 'checked';} ?>></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<script>

</script>
<script src="../../js/pages/events.js"></script>
