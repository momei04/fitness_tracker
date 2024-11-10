<?php

    if(!isset($_SESSION['user'])){
        if ($_SESSION['user']['logged_in'] == 1) {
            header("Location: template/pages/dashboard/dashboard.php");
            die();
        }else{header('location: template/pages/userAuth/userAuth.php');

        }

    }




?>



