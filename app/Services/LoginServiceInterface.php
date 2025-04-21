<?php

namespace App\Services;

interface LoginServiceInterface
{
    public function login(array $data): array;
}
