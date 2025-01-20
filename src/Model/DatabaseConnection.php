<?php

namespace PurpleCommunity\Model;

use PDO;

class DatabaseConnection
{
    private PDO $pdo;
    public function __construct()
    {
        $config = require_once __DIR__ . '/../../config.php';
        return new PDO("mysql:host={$config['host']};dbname={$config['database']}", $config['username'], $config['password']);
    }
}