<?php

namespace PurpleCommunity\Controller\user;

use JetBrains\PhpStorm\NoReturn;
use PurpleCommunity\Model\DatabaseConnection;
use PurpleCommunity\Model\User;

class UserRegisterController
{
    #[NoReturn] public function __construct()
    {
        require_once __DIR__ . '/../../../src/View/register-page.php';

        $db_connection = new DatabaseConnection();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = filter_input(INPUT_POST, 'user');
            $email = filter_input(INPUT_POST, 'user_email');
            $pswd = filter_input(INPUT_POST, 'user_password');
            $confirm_pswd = filter_input(INPUT_POST, 'user_confirm_password');

            $create_user = new User($db_connection->getConnection());
            $create_user->createUser($user, $email, $pswd, $confirm_pswd);
        }
    }
}
