<?php

    if(isset($_SESSION['user'])){
        if ($_SESSION['user']['logged_in'] != null) {
            header("Location: template/pages/dashboard/dashboard.php");
            die();
        }else{
            header('location: template/pages/userAuth/userAuth.php');
            die();
        }
    }else{
        header('location: template/pages/userAuth/userAuth.php');
        die();
    }
?>



