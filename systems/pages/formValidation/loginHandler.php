<?php
    require_once('../../classes/DbConnect.php');
    require_once('../../classes/User.php');
    $con = new DbConnect();
    
    // 1 - getting the data
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = trim($_POST['username']);
        $vorname = trim($_POST['vorname']);
        $nachname = trim($_POST['nachname']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $street = trim($_POST['street']);
        $ort = trim($_POST['ort']);
        $plz = intval(trim($_POST['plz']));
        // Validating email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $cancel = true;
        }else{
            $email = trim($_POST['email']);
            //Hier login Prozess beginnen
        }
        $user = new User($username, $vorname, $nachname, $email, $password, $street, $ort, $plz);
        if($user->signUp($username, $vorname, $nachname, $email, $password, $street, $ort, $plz)){
            $user_id  = $user->getUserIdByName($username);
            $_SESSION['user_id'] = $user_id;
            header("Location: ../workout/workoutOverview.php?user_id=$user_id");
            die();
        }
    }
    
    
    

    // 2 - Cleaning the data
    