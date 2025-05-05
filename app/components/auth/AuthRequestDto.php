<?php

namespace App\Components\Auth;

class AuthRequestDto
{

    public string $login;
    public string $password;

    public static function fromJson($data): self
    {
        $dto = new self();
        $dto->login = $data->username ?? '';
        $dto->password = $data->password ?? '';
        return $dto;
    }
}
