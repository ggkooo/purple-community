<?php

namespace PurpleCommunity\Controller\user;

use JetBrains\PhpStorm\NoReturn;
use PurpleCommunity\Model\DatabaseConnection;
use PurpleCommunity\Model\User;

class UserLoginController
{
    #[NoReturn] public function __construct()
    {
        $db_connection = new DatabaseConnection();

        $user = filter_input(INPUT_POST, 'user');
        $pswd = filter_input(INPUT_POST, 'password');
        $auth_user = new User($db_connection->getConnection());
        $auth_user->authUser($user, $pswd);
    }
}
