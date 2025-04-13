<?php

namespace app\services;

interface LoginServiceInterface
{
    public function login(array $data): array;
}
