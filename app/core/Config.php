<?php

namespace app\core;
class Config
{
    private static $instance = null;
    private $config = [];

    private function __construct()
    {
        $this->config = [
            'db' => [
                'host' => getenv('DB_HOST'),
                'port' => getenv('DB_PORT'),
                'name' => getenv('DB_NAME'),
                'user' => getenv('DB_USER'),
                'password' => getenv('DB_PASSWORD'),
            ],
            'env' => getenv('APP_ENV'),
        ];
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get(string $key, $default = null)
    {
        $keys = explode('.', $key);
        $value = $this->config;

        foreach ($keys as $k) {
            if (!isset($value[$k])) {
                return $default;
            }
            $value = $value[$k];
        }

        return $value;
    }
}