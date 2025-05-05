<?php

namespace App\Repositories;

use App\Models\Users;
use App\Models\UserSettings;
use App\Components\Auth\AuthRequestDto;


class UserRepository
{
    public static function autorisation(AuthRequestDto $data): ?Users
    {
        return Users::findFirst([
            'conditions' => '(user_name = :login: OR email = :login:) AND password = :password:',
            'bind' => ['login' => $data->login, 'password' => $data->password]
        ]);
    }

    public static function findUserSettings(int $userId): ?UserSettings
    {
        return UserSettings::findFirst([
            'conditions' => 'user_id = :user_id:',
            'bind' => ['user_id' => $userId],
        ]);
    }

    public static function getAllUsers(): Users
    {
        return UserSettings::findFirst([
            'conditions' => 'user_id = :user_id:',
            'bind' => ['user_id' => $userId],
        ]);
    }
}
