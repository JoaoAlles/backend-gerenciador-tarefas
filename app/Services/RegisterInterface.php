<?php

namespace App\Services;

interface RegisterInterface
{
    public function registerUser(array $userData): array;
}
