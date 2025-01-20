<?php

namespace PurpleCommunity\Controller\user;

use JetBrains\PhpStorm\NoReturn;
use PurpleCommunity\Model\DatabaseConnection;
use PurpleCommunity\Model\User;

class UserChangePasswordController
{
    #[NoReturn] public function __construct()
    {
        $db_connection = new DatabaseConnection();

        $user = filter_input(INPUT_POST, 'user');
        $pswd = filter_input(INPUT_POST, 'password');
        $new_pswd = filter_input(INPUT_POST, 'new_password');
        $confirm_new_pswd = filter_input(INPUT_POST, 'confirm_new_password');

        $auth_user = new User($db_connection->getConnection());
        $auth_user->changePassword($user, $pswd, $new_pswd, $confirm_new_pswd);
    }
}
