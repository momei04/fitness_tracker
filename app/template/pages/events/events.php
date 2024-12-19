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

    <form action="" id="add_event_form" method="post">
        <h3><?php echo 'Create a repeating workout event' ?></h3>
        <div>
            <div class="calendar-container">
                <div class="input-container">
                    <label for="workout">Workout</label>
                    <select name="workout" id="workout">
                        <?php foreach ($workouts as $workout) { ?>
                            <option value="<?php echo $workout['id'] ?>"><?php echo $workout['workout_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-container">
                    <label for="title">Title</label>
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
            </div>
            <div class="input-container repeat_pattern">
                <label for="repeat_pattern">Repeat Pattern</label>
                <select name="repeat_pattern" id="repeat_pattern">
                    <?php foreach($repeat_patterns as $pattern){ ?>
                            <option name="<?php echo $pattern['title']?>" id="<?php echo $pattern['title'] ?>" value="<?php echo $pattern['value'] ?>"><?php echo $pattern['title']?></option>
                    <?php }?>
                </select>
            </div>
            <button type="submit">Submit</button>
        </div>
    </form>
    <div class="event-container">
        <div class="time-header"></div>
        <table id="event_content" class="display">
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
<script>

</script>
<script src="../../js/pages/events.js"></script>
