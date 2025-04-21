<?php

namespace App\Services;

interface JwtServiceInterface
{
    public function createToken(int $userId): string;
}