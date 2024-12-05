<?php
session_start();
if($_SESSION['user']['logged_in'] === 1 && isset($_POST['submit'])) {

}else{
    header('location: ../../../template/pages/userAuth/userAuth.php');
}