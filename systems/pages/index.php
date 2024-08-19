
<?php
    /* include('includes/header.php'); */
    require_once('../classes/DbConnect.php');
    $db = new DbConnect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/style.css">

</head>
<body>

<!-- Adding a Workout -->

<div class="menu-grid">
    <div class="menu-item">
        <a href="workout.php">Workouts</a>
        <div class="layer"></div>
    </div>
    <div class="menu-item">
        <a href="#">Exercises</a>
        <div class="layer"></div>
    </div>
    <div class="menu-item">
        <a href="search.php">Suche</a>
        <div class="layer"></div>
    </div>
    <div class="menu-item">
        <a href="#">Link 2</a>
        <div class="layer"></div>
    </div>
</div>

    <script src="../formHandler.js"></script>
<?php
    include('includes/footer.php');
?>