<?php

use PurpleCommunity\Controller\HomePageController;
use PurpleCommunity\Controller\user\{
    UserChangePasswordController,
    UserForgotPasswordController,
    UserLoginController,
    UserLogoutController,
    UserRegisterController
};

require_once __DIR__ . '/../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];

session_start();

if ($uri === '/') {
    $_SESSION['page'] = 'Home';
    new HomePageController();
} elseif ($uri === '/login' && !isset($_SESSION['loggedIn'])) {
    $_SESSION['page'] = 'Login';
    new UserLoginController();
} elseif ($uri === '/register' && !isset($_SESSION['loggedIn'])) {
    $_SESSION['page'] = 'Register';
    new UserRegisterController();
} elseif ($uri === '/change-password' && isset($_SESSION['loggedIn'])) {
    $_SESSION['page'] = 'Change Password';
    new UserChangePasswordController();
} elseif ($uri === '/logout' && isset($_SESSION['loggedIn'])) {
    $_SESSION['page'] = 'Logout';
    new UserLogoutController();
} elseif ($uri === '/forgot-password' && !isset($_SESSION['loggedIn'])) {
    $_SESSION['page'] = 'Forgot Password';
    new UserForgotPasswordController();
} else {
    header('Location: /');
}
