<?php

namespace App\Components\Register;

use Phalcon\Http\RequestInterface;
use App\Repositories\UserRepository;

class RegisterValidator
{
    public function __construct(private UserRepository $userRep) {}

    private array $errors = [];


    public  function validate(object $request): ?array
    {


        $username = $request->username;

        $email = $request->email;

        $password = $request->password;

        $repassword = $request->repassword;

        if (empty($username)) {
            $this->errors[] = 'Имя пользователя обязательно';
        }
        if ($this->userRep->findByUsername($username)) {
            $this->errors[] = 'Человек с таким именем уже есть';
        }
        if ($this->userRep->findByEmail($email)) {
            $this->errors[] = 'Человек с таким email уже есть';
        }
        if ($password != $repassword) {
            $this->errors[] = 'Пароли не совпадают';
        }
        if ($email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Необходимо ввести корректный email';
            }
        }
        return $this->errors;
    }
}
