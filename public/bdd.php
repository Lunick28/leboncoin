<?php

function connection()
{
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=leboncoin;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function getAllUsers()
{
    $bdd = new PDO('mysql:host=localhost;dbname=leboncoin;charset=utf8', 'root', '');
    $response = $bdd->query('SELECT * FROM users');
    $response = $response->fetchAll();
    return $response;
}

function createUsers($email, $password)
{
    $bdd = new PDO('mysql:host=localhost;dbname=leboncoin;charset=utf8', 'root', '');
    $req = $bdd->prepare('INSERT INTO users VALUES(:email, :password)');
    $req->execute(array(
        'email' => $email,
        'password' => $password
    ));
}