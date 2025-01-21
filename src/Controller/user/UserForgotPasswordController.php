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
        require_once __DIR__ . '/../../../src/View/forgot-password-page.php';

        $db_connection = new DatabaseConnection();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'user_email');

            $forgot_pswd = new User($db_connection->getConnection());
            $forgot_pswd->forgotPassword($email);
        }
    }
}
