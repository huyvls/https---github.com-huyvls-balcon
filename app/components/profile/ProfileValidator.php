<?php
namespace App\Components\Profile;
use App\Models\Users;

class ProfileValidator{
public function validate(ProfileRequestDto $dto):array{

    $errors = [];

    $reusername = Users::findfirst([
        'conditions' => 'username = :username:',
        'bind' => [
            'username' => $dto->username
        ]
    ]);
    if($reusername){
        $errors[] = 'Пользователь с таким именем уже есть, попробуй взять другой';
    }
    if($dto->password != $dto->repassword){
        $errors[] = 'Пароли не совпадают';
    }
    if (!filter_var($dto->email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Необходимо ввести корректный email';
    }
    return $errors;
}
}