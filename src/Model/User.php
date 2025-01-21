<?php

namespace PurpleCommunity\Model;

use JetBrains\PhpStorm\NoReturn;
use PDO;
use Random\RandomException;

class User
{
    private PDO $pdo;

    public function __construct(PDO $pdo_instance)
    {
        $this->pdo = $pdo_instance;
    }

    private function encrypt(string $text_to_encrypt): string
    {
        $config = require __DIR__ . '/../../config.php';

        $encryption_key = $config['encryption_key'];
        $cypher = 'AES-128-CBC';
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cypher));
        $encrypted_text = openssl_encrypt($text_to_encrypt, $cypher, $encryption_key, 0, $iv);
        return base64_encode($iv . $encrypted_text);
    }

    private function decrypt(string $text_to_decrypt): string
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

    private function getUsersData(): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM users');
        $statement->execute();
        return $statement->fetchAll();
    }

    private function getUserPassword(string $user): array
    {
        $statement = $this->pdo->prepare('SELECT password FROM users WHERE user = :user');
        $statement->bindValue(':user', $user);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    #[NoReturn] public function createUser(string $user, string $email, string $pswd, string $confirm_pswd): void
    {
        $result = $this->getUsersData();
        for ($i = 0; $i < count($result); $i++) {
            if ($user === $result[$i]['user']) {
                echo 'User or email already used';
                exit();
            } elseif ($email === $this->decrypt($result[$i]['email'])) {
                echo 'User or email already used';
                exit();
            }
        }

        if ($pswd === $confirm_pswd) {
            $encrypted_email = $this->encrypt($email);
            $hashed_pswd = password_hash($pswd, PASSWORD_ARGON2ID);
            $statement = $this->pdo->prepare(
                'INSERT INTO users (user, email, password, is_admin) VALUES (:user, :email, :password, :is_admin)'
            );
            $statement->bindValue(':user', $user);
            $statement->bindValue('email', $encrypted_email);
            $statement->bindValue(':password', $hashed_pswd);
            $statement->bindValue(':is_admin', 'n');

            if ($statement->execute()) {
                header('Location: /login');
            }
        } else {
            header('Location: /register');
        }
    }

    #[NoReturn] public function authUser(string $user, string $password): void
    {
        $result = $this->getUserPassword($user);

        if (password_verify($password, $result['password'])) {
            setcookie('user', $user, time() + (86400 * 14), "/");
            $user_data = $this->getUsersData();

            for ($i = 0; $i < count($user_data); $i++) {
                if ($user_data[$i]['user'] === $user) {
                    $_SESSION['user_id'] = $user_data[$i]['id'];
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['isAdmin'] = $user_data[$i]['is_admin'];
                }
            }

            $_SESSION['user'] = $user;
            header('Location: /account'); // CORRECT CREDENTIALS
        } else {
            header('Location: /login'); // INVALID CREDETIALS
        }
    }

    #[NoReturn] public function changePassword(
        string $user,
        string $pswd,
        string $new_pswd,
        string $confirm_new_pswd
    ): void {
        if ($new_pswd === $confirm_new_pswd) {
            $result = $this->getUserPassword($user);

            if (password_verify($pswd, $result['password'])) {
                $hashed_pswd = password_hash($new_pswd, PASSWORD_ARGON2ID);
                $statement = $this->pdo->prepare('UPDATE users SET password = :new_password WHERE user = :user ');
                $statement->bindValue(':new_password', $hashed_pswd);
                $statement->bindValue(':user', $user);
                $statement->execute();
                setcookie('user', '', time() - (86400 * 14), "/");
                header('Location: /');
            } else {
                echo 'User password incorrect';
            }
        } else {
            echo 'The passwords don\'t match. Try again.';
        }
    }

    /**
     * @throws RandomException
     */
    #[NoReturn] public function forgotPassword(string $email): void
    {
        $result = $this->getUsersData();

        for ($i = 0; $i < count($result); $i++) {
            if ($email === $this->decrypt($result[$i]['email'])) {
                $id = $result[$i]['id'];
                $code = random_int(100000, 999999);
                $statement = $this->pdo->prepare(
                    'UPDATE users SET verification_code = :verification_code WHERE id = :id'
                );
                $statement->bindValue(':verification_code', $code);
                $statement->bindValue(':id', $id);
                $statement->execute();
                // FAZER LÓGICA PARA ENVIAR O EMAIL
            }
        }
        echo 'If this email is registered, we have sent a verification code';
    }

    #[NoReturn] public function logoutUser(): void
    {
        setcookie('user', '', time() - (86400 * 14), "/");
        session_unset();
        session_destroy();
        header('Location: /');
    }
}
