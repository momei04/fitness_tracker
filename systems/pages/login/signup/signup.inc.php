<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pwd = $_POST['password'];
    $ort = $_POST['ort'];
    $street = $_POST['street'];
    $plz = $_POST['plz'];

    try {
        require_once '../dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        // Error Handlers
        $errors = [];
        if(isInputEmpty($username, $pwd, $email, $ort, $street, $plz)){
            $errors["empty_input"] = "Fill in all Fields!";
        }

        if(isEmailInvalid($email)){
            $errors["email_invalid"] = "Your Email is invalid!";
        }

        if(isUsernameTaken($pdo, $username)){
            $errors["username_taken"] = "The username you entered is already taken!";
        }

        if(isEmailRegistered($pdo, $email)){
            $errors["email_registered"] = "The email adress is already taken!";
        }

        require_once '../config_session.inc.php';

        if($errors){
            $_SESSION["errors_signup"] = $errors;
            header("Location: userAuth.inc.php");
            die();
        }else{
            createUser($pdo, $username, $pwd, $email, $vorname, $nachname, $ort,  $plz, $street);
            $user = getUser($pdo, $username);
            $user_id = $user['user_id'];
            $_SESSION['user_id'] = $user_id;
            $_SESSION['vorname'] = $user['vorname'];
            $_SESSION['nachname'] =$user['nachname'];
            $_SESSION['email'] =$user['email'];
            $_SESSION['plz'] = $user['plz'];
            $_SESSION['ort'] = $user['ort'];
            $_SESSION['street'] = $user['street'];
            //header("Location: ../workout/workoutOverview.php?signup=sucess");
            $pdo = null;
            $stmt = null;
            die();
        }

    } catch (PDOException $e) {

        die("Querry failed: " . $e->getMessage());
    }
}else{
    header("Location: ../userAuth.inc.php");
    die();
}