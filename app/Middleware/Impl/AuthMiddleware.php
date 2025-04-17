<?php

declare(strict_types=1);

namespace App\Middleware\Impl;

use app\core\Response;
use App\Middleware\MiddlewareInterface;
use DateTimeImmutable;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware implements MiddlewareInterface
{

    public static function handle()
    {
        try {
            $headers = getallheaders();
            $auth = $headers['Authorization'] ?? '';

            if (!str_starts_with($auth, 'Bearer ')) {
                throw new Exception('Token não fornecido', 401);
            }

            $token = str_replace('Bearer ', '', $auth);

            $decoded = JWT::decode($token, new Key($_ENV['JWT_SECRET'], 'HS256'));
            self::validateToken($decoded);
            return true;
        } catch (Exception $e) {
            $message = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
            Response::json($message, $e->getCode() ?: 401);
            exit;
        }
    }

    /**
     * @throws Exception
     */
    private static function validateToken(object $payload)
    {
        $now = new DateTimeImmutable();

        if ($payload->exp < $now->getTimestamp()) {
            throw new Exception('Token expirado', 401);
        }

    }
}
