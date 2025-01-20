<?php

use PurpleCommunity\Controller\user\UserChangePasswordController;
use PurpleCommunity\Controller\user\UserForgotPasswordController;
use PurpleCommunity\Controller\user\UserLoginController;
use PurpleCommunity\Controller\user\UserLogoutController;
use PurpleCommunity\Controller\user\UserRegisterController;

require_once __DIR__ . '/../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

session_start();

// FAZER VERIFICAÇÃO SE O USUÁRIO ESTÁ LOGADO

if ($uri === '/') {
    echo 'Oii';
} elseif ($uri === '/login') {
    new UserLoginController();
} elseif ($uri === '/register') {
    new UserRegisterController();
} elseif ($uri === '/change-password') {
    new UserChangePasswordController();
} elseif ($uri === '/logout') {
    new UserLogoutController();
} elseif ($uri === '/forgot-password') {
    new UserForgotPasswordController();
} else {
    header('Location: /');
}
