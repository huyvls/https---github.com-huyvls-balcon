<?php

namespace App\Repositories;

use App\Models\Users;
use App\Components\Auth\AuthRequestDto;


class UserRepository
{
    public static function autorisation(AuthRequestDto $dto): ?Users
    {
        return Users::findFirst([
            'conditions' => '(user_name = :login: OR email = :login:) AND password = :password:',
            'bind' => ['login' => $dto->login, 'password' => $dto->password]
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

    public function CheckExistUser(int $user_id): bool
    {
        $user =  Users::findFirst([
            'conditions' => 'user_id = :user_id:',
            'bind' => ['user_id' => $user_id]
        ]);

        if (!$user) {
            return false;
        }

        return true;
    }

    public function getIdbyUsername(string $username): ?int
    {
        $user =  Users::findFirst([
            'conditions' => 'user_name = :login:',
            'bind' => ['login' => $username]
        ]);

        return $user->user_id;
    }


    // public static function createUser(RegisterValidator $validator): UserSettings
    // {
    //     Users::create([
    //         'user_name'  => $validator->username,
    //         'email' => $validator->email,
    //         'password' => $validator->password,
    //         'registration_date' => date('Y-m-d')

    //     ]);
    //     return new UserSettings;
    // }

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
