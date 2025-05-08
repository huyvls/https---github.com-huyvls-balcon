<?php

namespace App\Components\Register;

use App\Components\Register\RegisterValidator;
use App\Repositories\UserRepository;
use App\Repositories\UserSettingsRepository;
use Phalcon\Http\RequestInterface;


class AccountCreator
{

    public function __construct(protected RegisterValidator $validator) {}

    public function create(object  $request): array
    {
        if ($errors = $this->validator->validate($request)) {
            return ['success' => false, 'message' => $errors];
        } else {
            $userRepo = new UserRepository;
            $userSet = new UserSettingsRepository;
            $user = $userRepo::create($request);

            $userId = $user->user_id ?? null;

            file_put_contents('C:/zxc/workk.txt', $userId."\n", FILE_APPEND);

            if(!$userId){
                return ['success' => false, 'message' => 'Ошибка при создании пользователя'];
            }

            $userSet::create($userId);
            return ['success' => true, 'message' => 'Отлчино, Вы зарегистрированы'];
        }
    }
}
