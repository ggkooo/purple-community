<?php

use PurpleCommunity\Model\DatabaseConnection;
use PurpleCommunity\Model\User;

require_once __DIR__ . '/../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

$db_connection = new DatabaseConnection();

if ($uri === '/') {
    echo 'Oii';
} elseif ($uri === '/login') {
    $user = filter_input(INPUT_POST, 'user');
    $pswd = filter_input(INPUT_POST, 'password');
    $auth_user = new User($db_connection->getConnection());
    $auth_user->authUser($user, $pswd);
} elseif ($uri === '/register') {
    $user = filter_input(INPUT_POST, 'user');
    $email = filter_input(INPUT_POST, 'email');
    $pswd = filter_input(INPUT_POST, 'password');
    $confirm_pswd = filter_input(INPUT_POST, 'confirm_password');
    $create_user = new User($db_connection->getConnection());
    $create_user->createUser($user, $email, $pswd, $confirm_pswd);
} else {
    header('Location: /');
}
