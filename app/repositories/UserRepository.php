<?php

namespace App\Repositories;

use App\Models\Users;
use App\Models\UserSettings;
use App\Components\Auth\AuthRequestDto;
use App\Components\Register\RegisterValidator;
use DateTime;

class UserRepository
{
    public static function autorisation(AuthRequestDto $data): ?Users
    {
        return Users::findFirst([
            'conditions' => '(user_name = :login: OR email = :login:) AND password = :password:',
            'bind' => ['login' => $data->login, 'password' => $data->password]
        ]);
    }

    public function findByUsername(string $username): ?Users
    {
        return Users::findFirst([
            'conditions' => 'user_name = :login:',
            'bind' => ['login' => $username]
        ]);
    }

    public function findByEmail(string $email): ?Users
    {
        return Users::findFirst([
            'conditions' => 'email = :email:',
            'bind' => ['email' => $email]
        ]);
    }

    public static function createUser(RegisterValidator $validator): UserSettings
    {
        Users::create([
            'user_name'  => $validator->username,
            'email' => $validator->email,
            'password' => $validator->password,
            'registration_date' => date('Y-m-d')

        ]);
        return new UserSettings;
    }

    public static function create(object $data): Users
    {
        $user = new Users;
        $user->assign(
            [
                'email' => $data->email,
                'user_name' => $data->username,
                'password' => $data->password
            ]
        );
        if ($user->save()) {
            return $user;
        } else {
            throw new \Exception("Не удалось создать пользователя");
        }
    }
}
