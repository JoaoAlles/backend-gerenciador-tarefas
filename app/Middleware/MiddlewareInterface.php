<?php

declare(strict_types=1);

namespace App\Middleware;

interface MiddlewareInterface
{
    public static function handle();
}