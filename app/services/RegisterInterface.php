<?php

namespace app\services;

interface RegisterInterface
{
    public function registerUser(array $userData): array;
}
