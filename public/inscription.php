<?php

require_once 'bdd.php';

if(isset($_POST['envoi'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    createUsers($email, $password);
}