<?php

declare(strict_types=1);

function isInputEmpty(string $username, string $pwd, string $email){
    if(empty($username) || empty($pwd) || empty($email)){
        return true;
    }else {
        return false;
    }
}

function isEmailInvalid(string $email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }else {
        return false;
    }
}

function isUsernameTaken(object $pdo, string $username){
    if(getUsername($pdo,  $username)){
        return true;
    }else {
        return false;
    }
}

function isEmailRegistered(object $pdo, string $email){
    if(getEmail($pdo, $email)){
        return true;
    }else {
        return false;
    }

    
}

function createUser(object $pdo, string $username, string $pwd, string $email, string $vorname, string $nachname, string $ort, int $plz, string $street){
        setUser( $pdo, $username, $pwd, $email, $vorname, $nachname, $ort, $plz, $street);
}