<?php

namespace PurpleCommunity\Model;

use JetBrains\PhpStorm\NoReturn;
use PDO;

class Product
{
    private PDO $pdo;

    #[NoReturn] public function __construct(PDO $pdo_instance)
    {
        $this->pdo = $pdo_instance;
    }

    #[NoReturn] public function createProduct(string $name, string $description, string $category, float $price, string $img = '/assets/img/purple-community-logo-200x200.png'): void
    {
        $statement = $this->pdo->prepare('INSERT INTO products (name, description, category, price, image_path) VALUES (:name, :description, :category, :price, :image_path)');
        $statement->bindValue(':name', $name);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':category', $category);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':image_path', $img);
        if ($statement->execute()) {
            echo 'Produto adicionado com sucesso';
        }
    }

    #[NoReturn] public function removeProduct(int $id): void
    {
        $statement = $this->pdo->prepare('DELETE FROM products WHERE id = :id');
        $statement->bindValue(':id', $id);
        if ($statement->execute()) {
            echo 'Produto removido com sucesso';
        }
    }
}