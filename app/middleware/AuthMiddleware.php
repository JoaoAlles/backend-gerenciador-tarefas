<?php

namespace App\Middleware;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware {
    public static function validatorToken() {
        $headers = getallheaders();
        $auth = $headers['Authorization'] ?? '';

        if (!str_starts_with($auth, 'Bearer ')) {
            throw new Exception('Token não fornecido', 401);
        }

        $token = str_replace('Bearer ', '', $auth);

        try {
            $decoded = JWT::decode($token, new Key($_ENV['JWT_SECRET'], 'HS256'));
            return $decoded->uid;
        } catch (Exception $e) {
            http_response_code(401);
            exit(json_encode(['erro' => 'Token inválido']));
        }
    }
}
