<?php

namespace app\services;

interface JwtServiceInterface
{
    public function createToken(int $userId): string;
}