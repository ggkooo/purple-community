<?php

namespace PurpleCommunity\Controller\user;

use JetBrains\PhpStorm\NoReturn;
use PurpleCommunity\Model\DatabaseConnection;
use PurpleCommunity\Model\User;
use Random\RandomException;

class UserForgotPasswordController
{
    /**
     * @throws RandomException
     */
    #[NoReturn] public function __construct()
    {
        $db_connection = new DatabaseConnection();

        $email = filter_input(INPUT_POST, 'email');

        $forgot_pswd = new User($db_connection->getConnection());
        $forgot_pswd->forgotPassword($email);
    }
}
