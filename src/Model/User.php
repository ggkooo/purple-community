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
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE user = :user OR email = :email');
        $statement->bindValue(':user', $user);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
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
        } else {
            echo 'User or email already used';
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

    #[NoReturn] public function changePassword(string $user, string $pswd, string $new_pswd, string $confirm_new_pswd): void
    {
        if ($new_pswd === $confirm_new_pswd) {
            $statement = $this->pdo->prepare('SELECT password FROM users WHERE user = :user');
            $statement->bindValue(':user', $user);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if (password_verify($pswd, $result['password'])) {
                $hashed_pswd = password_hash($new_pswd, PASSWORD_ARGON2ID);
                $statement = $this->pdo->prepare('UPDATE users SET password = :new_password WHERE user = :user ');
                $statement->bindValue(':new_password', $hashed_pswd);
                $statement->bindValue(':user', $user);
                $statement->execute();
                // REMOVER COOKIE E REDIRECIONAR PARA A PÁGINA DE LOGIN
            } else {
                echo 'User password incorrect';
            }
        } else {
            echo 'The passwords don\'t match. Try again.';
        }
    }
}