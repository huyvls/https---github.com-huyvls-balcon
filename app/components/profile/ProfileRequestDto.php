<?php 
namespace App\Components\Profile;

class ProfileRequestDto{
    public function __construct(
    public readonly ? string $username,
    public readonly ? string $password,
    public readonly ? string $repassword,
    public readonly ? string $email
    ){
    }

    public static function fromJson(array $data): self
    {
        return new self(
            trim($data['username'] ?? ''),
            trim($data['password'] ?? ''),
            trim($data['repassword'] ?? ''),
            trim($data['email'] ?? '')
        );
    }

}