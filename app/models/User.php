<?php
namespace app\models;

class User {
    public ?int $id = null;
    public string $name;
    public string $email;
    public ?string $password = null;
    public ?string $created_at = null;
}