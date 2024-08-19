<?php

/* In here goes everything thst has to do with a DB  
Only the controller has acess to this file
*/

declare(strict_types=1);

function getUsername(object $pdo, string $username){
    $query = "SELECT user_name FROM users WHERE user_name = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getUser(object $pdo, string $username){
    $query = "SELECT * FROM users WHERE user_name = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getUserId(object $pdo, string $username){
    $query = "SELECT user_id FROM users WHERE user_name = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function getEmail(object $pdo, string $email){
    $query = "SELECT email FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function setUser(object $pdo, string $username, string $pwd, string $email, string $vorname, string $nachname, string $ort, int $plz, string $street){
    $query = "INSERT INTO users (user_name, password, email, vorname, nachname, ort, plz, street) VALUES(:username, :password, :email, :vorname, :nachname, :ort, :plz, :street)";
    $stmt = $pdo->prepare($query);

    $options = [
        'cost' => 12
    ];
    $hasedPassword = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $hasedPassword);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":vorname", $vorname);
    $stmt->bindParam(":nachname", $nachname);
    $stmt->bindParam(":ort", $ort);
    $stmt->bindParam(":plz", $plz);
    $stmt->bindParam(":street", $street);
    $stmt->execute();
}