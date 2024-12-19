<?php
require_once '../../../services/classes/Session/Session.php';
$session = new Session\Session();

?>
<link rel="stylesheet" href="../../style/workout.css">

<?php if (isset($_SESSION['user']['logged_in'])) { ?>
    <link rel="stylesheet" href="../../style/form.css">
    <nav id="sidebar">
        <ul>
            <li class="logo">
                <span>Fitness Tracker</span>
                <button id="toggle-btn">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </li>

            <li class="active">
                <a href="../settings/settings.php">
                    <i class="fa-solid fa-gear"></i>
                    <span><?php echo $session->getLanguageString('SETTINGS', $_SESSION['user']['language']); ?></span>
                </a>
            </li>
            <li>
                <a href="../workouts/workout.php">
                    <i class="fa-solid fa-dumbbell"></i>
                    <span><?php echo $session->getLanguageString('WORKOUTS', $_SESSION['user']['language']); ?></span>
                </a>
            </li>
            <li>
                <a href="../events/events.php">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span><?php echo $session->getLanguageString('EVENTS', $_SESSION['user']['language']); ?></span>
                </a>
            </li>
            <li>
                <a href="../dashboard/dashboard.php">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span><?php echo $session->getLanguageString('STATISTICS', $_SESSION['user']['language']); ?></span>
                </a>
            </li>
            <li>
                <a href="">
                    <form class="sidebar" action="../../../services/form_handler.php" method="post">
                        <input type="hidden" name="page" value="userAuth">
                        <input type="hidden" name="action" value="logout">
                        <button type="submit" class="logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </a>
            </li>
        </ul>
    </nav>



    <script src="../../js/menu.js"></script>

<?php } ?>