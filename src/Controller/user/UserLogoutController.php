<?php

namespace PurpleCommunity\Controller\user;

use JetBrains\PhpStorm\NoReturn;
use PurpleCommunity\Model\DatabaseConnection;
use PurpleCommunity\Model\User;

class UserLogoutController
{
    #[NoReturn] public function __construct()
    {
        $db_connection = new DatabaseConnection();

        $logoutUser = new User($db_connection->getConnection());
        $logoutUser->logoutUser();
    }
}
