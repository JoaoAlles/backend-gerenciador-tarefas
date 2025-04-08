<?php
namespace app\repositories;

use app\core\Database;
use app\models\User;
use PDO;

class RegisterRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function register(array $userData): ?User {
        // Verifica se o email já existe
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute([':email' => $userData['email']]);

        if ($stmt->fetch()) {
            return null; // Email já cadastrado
        }

        // Insere o novo usuário
        $stmt = $this->db->prepare("
            INSERT INTO users (name, email, password) 
            VALUES (:name, :email, :password)
        ");

        $success = $stmt->execute([
            ':name' => $userData['name'],
            ':email' => $userData['email'],
            ':password' => password_hash($userData['password'], PASSWORD_DEFAULT)
        ]);

        if (!$success) {
            return null;
        }

        // Retorna o usuário criado (opcional)
        $user = new User();
        $user->id = $this->db->lastInsertId();
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        return $user;
    }
}