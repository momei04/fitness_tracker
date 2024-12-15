<?php

use Settings\Settings;

session_start();
require_once '../../classes/Settings/Settings.php';
if($_SESSION['user']['logged_in'] === 1) {
    $username = $_POST['user_name'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $street = $_POST['street'];
    $plz = $_POST['plz'];
    $ort = $_POST['ort'];
    $house_nr = $_POST['house_nr'];
    $language_id =$_POST['language_id'];

    define("user_attributes", ['user_name', 'first_name', 'last_name', 'email', 'street', 'plz', 'ort', 'house_nr', 'language_id']);
    $error_msg = null;
    $settings = new Settings();
    foreach(user_attributes as $attribute) {
        if (isset($_POST[$attribute]) && $_POST[$attribute] != null) {
            switch ($attribute) {
                case 'user_name':
                    if(count($settings->updateUsername($_SESSION['user']['user_id'], $username)) === 0) {
                        $_SESSION['user']['user_name'] = $username;
                    }
                    break;
                case 'first_name':
                    if(count($settings->updateFirstName($_SESSION['user']['user_id'], $first_name)) === 0) {
                        $_SESSION['user']['first_name'] = $first_name;
                    }
                    break;
                case 'last_name':
                    if(count($settings->updateLastName($_SESSION['user']['user_id'], $last_name)) === 0) {
                        $_SESSION['user']['last_name'] = $last_name;
                    }
                    break;

                case 'email':
                    if(count($settings->updateEmail($_SESSION['user']['user_id'], $email)) === 0) {
                        $_SESSION['user']['email'] = $email;
                    }
                    break;
                case 'street':
                    if(count($settings->updateStreet($_SESSION['user']['user_id'], $street)) === 0) {
                        $_SESSION['user']['street'] = $street;
                    }
                    break;
                case 'ort':
                    if(count($settings->updateOrt($_SESSION['user']['user_id'], $ort)) === 0) {
                        $_SESSION['user']['ort'] = $ort;
                    }
                    break;
                case 'language_id':
                    if(count($settings->updateLanguage($_SESSION['user']['user_id'], $language_id)) === 0) {
                        $_SESSION['user']['language_id'] = $language_id;
                    }
                    break;
                case 'house_nr':
                    if(count($settings->updateHouseNr($_SESSION['user']['user_id'], $house_nr)) === 0) {
                        $_SESSION['user']['house_nr'] = $house_nr;
                    }
                    break;
            }

            if ($error_msg != null) {
                var_dump($error_msg);
            }else{
                header('location: ../../../template/pages/settings/settings.php');
            }
        }
    }
}else{
    header('location: ../../../template/pages/userAuth/userAuth.php');
}