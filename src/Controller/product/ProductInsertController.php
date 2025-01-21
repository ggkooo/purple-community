<?php

namespace PurpleCommunity\Controller\product;

use JetBrains\PhpStorm\NoReturn;
use PurpleCommunity\Model\DatabaseConnection;
use PurpleCommunity\Model\Product;

class ProductInsertController
{
    #[NoReturn] public function __construct()
    {
        $db_connection = new DatabaseConnection();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = filter_input(INPUT_POST, 'name');
            $description = filter_input(INPUT_POST, 'description');
            $category = filter_input(INPUT_POST, 'category');
            $price = filter_input(INPUT_POST, 'price');

            $product = new Product($db_connection->getConnection());
            $product->createProduct($name, $description, $category, $price);
        }
    }
}