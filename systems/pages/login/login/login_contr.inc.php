<?php

declare(strict_types=1);

function isUsernameWrong(array | bool $result){
    if(!$result){
        return true;
    }else{
        return false;
    }
}

function isPasswordWrong(string $password, string $hashedPassword){
    if(!password_verify($password, $hashedPassword)){
        return true;
    }else{
        return false;
    }
}

function isInputEmpty(string $username, string $password){
    if(empty($username) || empty($password)){
        return true;
    }else{
        return false;
    }
}