<?php
require_once '../../../services/classes/Session/Session.php';
    $session = new Session\Session();

?>
    <link rel="stylesheet" href="../../style/workout.css">

<?php if(isset($_SESSION['user']['logged_in'])){?>
    <link rel="stylesheet" href="../../style/form.css">

    <button class="nav-button">menu</button>

<nav class="hidden">
    <div class="img-container">
        <img src="https://content.rsggroup.com/image/upload/q_auto,f_auto/v1620635033/GoldsGym/Studio%20Berlin/210310_GOLDSGYM_Interior_0463" alt="">
        <div class="layer"></div>
        <h2>Hello <?php echo $_SESSION['user']['first_name']?></h2>
    </div>
    <div class="menu-container">
        <menu>
            <a href="../exercises/exercises.php""><?php echo $session->getLanguageString('EXERCISES', $_SESSION['user']['language']);?></a>
            <a href="#"><?php echo $session->getLanguageString('STATISTICS', $_SESSION['user']['language']);?></a>
            <a href="../workouts/workout.php"><?php echo $session->getLanguageString('WORKOUTS', $_SESSION['user']['language']);?></a>
            <a href="#"><?php echo $session->getLanguageString('SETTINGS', $_SESSION['user']['language']);?></a>
            <a href="">
                <form action="../../../services/form_handler.php" method="post">
                    <input type="hidden" name="page" value="userAuth">
                    <input type="hidden" name="action" value="logout">
                    <button type="submit">Logout</button>
                </form>
            </a>
        </menu>
        <footer>
            <p>&copy; Moritz Meier</p>
        </footer>
    </div>

</nav>

<script src="../../js/menu.js"></script>

    <?php } ?>