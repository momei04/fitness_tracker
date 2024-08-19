<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST['username'];
    $pwd = $_POST['password'];

    try {
        require_once '../dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

    /* Error Handlers */
        $errors = [];
        if(isInputEmpty($username, $pwd)){
            $errors["empty_input"] = "Fill in all Fields!";
        }

        $result = getUser($pdo, $username);
        

        if(isUsernameWrong($result)){
            $errors["login_incorrect"] = "Incorrect Login Info!";
        }

        if(!isUsernameWrong($result)&&isPasswordWrong($pwd, $result['password'])){
            $errors["incorrect_password"] = "Incorrect Password!";
        }
        require_once '../config_session.inc.php';

        if($errors){
            $_SESSION["errors_login"] = $errors;

            header("Location: ../userAuth.inc.php");
            die();
        }else{
            session_start();

            $newSessionId = session_create_id();
            $sessionId = $newSessionId ."_". $result['user_id'];
            //session_id($newSessionId);

            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['vorname'] = $result['vorname'];
            $_SESSION['nachname'] =$result['nachname'];
            $_SESSION['email'] =$result['email'];
            $_SESSION['plz'] = $result['plz'];
            $_SESSION['ort'] = $result['ort'];
            $_SESSION['street'] = $result['street'];
            $_SESSION['username'] = htmlspecialchars($result['user_name']);
            $_SESSION["last_regeneration"] = time();
            $_SESSION['language_id'] = $result['user_language'];
            //redirecting the user
            header("Location: ../../workout/workoutOverview.php?signup=sucess");

            //close of the Connection to the db
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