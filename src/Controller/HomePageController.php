<?php

namespace PurpleCommunity\Controller;

use JetBrains\PhpStorm\NoReturn;

class HomePageController
{
    #[NoReturn] public function __construct()
    {
        require_once __DIR__ . '/../../src/View/home-page.php';
    }
}
