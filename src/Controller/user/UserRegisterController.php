<?php

namespace PurpleCommunity\Controller\user;

use JetBrains\PhpStorm\NoReturn;
use PurpleCommunity\Model\DatabaseConnection;
use PurpleCommunity\Model\User;

class UserRegisterController
{
    #[NoReturn] public function __construct()
    {
        $db_connection = new DatabaseConnection();

        $user = filter_input(INPUT_POST, 'user');
        $email = filter_input(INPUT_POST, 'email');
        $pswd = filter_input(INPUT_POST, 'password');
        $confirm_pswd = filter_input(INPUT_POST, 'confirm_password');

        $create_user = new User($db_connection->getConnection());
        $create_user->createUser($user, $email, $pswd, $confirm_pswd);
    }
}
