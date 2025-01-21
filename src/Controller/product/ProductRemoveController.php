<?php

namespace PurpleCommunity\Controller\product;

use JetBrains\PhpStorm\NoReturn;
use PurpleCommunity\Model\DatabaseConnection;
use PurpleCommunity\Model\Product;

class ProductRemoveController
{
    #[NoReturn] public function __construct()
    {
        $db_connection = new DatabaseConnection();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = filter_input(INPUT_GET, 'id');

            $product = new Product($db_connection->getConnection());
            $product->removeProduct($id);
        }
    }
}