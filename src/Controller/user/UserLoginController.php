<?php

namespace PurpleCommunity\Controller\user;

use JetBrains\PhpStorm\NoReturn;
use PurpleCommunity\Model\DatabaseConnection;
use PurpleCommunity\Model\User;

class UserLoginController
{
    #[NoReturn] public function __construct()
    {
        require_once __DIR__ . '/../../../src/View/login-page.php';

        $db_connection = new DatabaseConnection();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = filter_input(INPUT_POST, 'user');
            $pswd = filter_input(INPUT_POST, 'user_password');
            $auth_user = new User($db_connection->getConnection());
            $auth_user->authUser($user, $pswd);
        }
    }
}
