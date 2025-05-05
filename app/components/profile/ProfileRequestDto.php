<?php

namespace App\Components\Profile;

class ProfileRequestDto
{
    public function __construct(
        public  ?string $email,
        public  ?string $username,
        public  ?string $password,
        public  ?string $repassword
    ) {}

    public static function fromJson(array|object $data): self
    {
        if (is_object($data)) {
            $data = json_decode(json_encode($data), true);
        }
        return new self(
            isset($data['email']) ? trim($data['email']) : null,
            isset($data['username']) ? trim($data['username']) : null,
            isset($data['password']) ? trim($data['password']) : null,
            isset($data['repassword']) ? trim($data['repassword']) : null,

        );
    }
}
