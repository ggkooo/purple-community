<?php

namespace PurpleCommunity\Model;

use JetBrains\PhpStorm\NoReturn;
use PDO;

class User
{
    private PDO $pdo;

    public function __construct(PDO $pdo_instance)
    {
        $this->pdo = $pdo_instance;
    }

    public function encrypt(string $text_to_encrypt): string
    {
        $config = require __DIR__ . '/../../config.php';

        $encryption_key = $config['encryption_key'];
        $cypher = 'AES-128-CBC';
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cypher));
        $encrypted_text = openssl_encrypt($text_to_encrypt, $cypher, $encryption_key, 0, $iv);
        return base64_encode($iv . $encrypted_text);
    }

    public function decrypt(string $text_to_decrypt): string
    {
        $config = require __DIR__ . '/../../config.php';

        $encryption_key = $config['encryption_key'];
        $cypher = 'AES-128-CBC';
        $decoded_text = base64_decode($text_to_decrypt);
        $iv_length = openssl_cipher_iv_length($cypher);
        $iv = substr($decoded_text, 0, $iv_length);
        $encrypted_text = substr($decoded_text, $iv_length);
        return openssl_decrypt($encrypted_text, $cypher, $encryption_key, 0, $iv);
    }

    #[NoReturn] public function createUser(string $user, string $email, string $pswd, string $confirm_pswd): void
    {
        if ($pswd === $confirm_pswd) {
            $encrypted_email = $this->encrypt($email);
            $hashed_pswd = password_hash($pswd, PASSWORD_ARGON2ID);
            $statement = $this->pdo->prepare('INSERT INTO users (user, email, password) VALUES (:user, :email, :password)');
            $statement->bindValue(':user', $user);
            $statement->bindValue('email', $encrypted_email);
            $statement->bindValue(':password', $hashed_pswd);

            if ($statement->execute()) {
                echo 'User successfully created!';
            }
        } else {
            echo 'Passwords don\'t match. Try again.';
        }
    }

    #[NoReturn] public function authUser(string $user, string $password): void
    {
        $statement = $this->pdo->prepare('SELECT password FROM users WHERE user = :user');
        $statement->bindValue(':user', $user);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $result['password'])) {
            echo 'Correct credentials';
        } else {
            echo 'Invalid credentials';
        }
    }
}