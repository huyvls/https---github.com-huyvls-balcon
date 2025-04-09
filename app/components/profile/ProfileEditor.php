<?php
namespace App\Components\Profile;

use App\Models\Users;


class ProfileEditor{
    public function __construct(
        private ProfileValidator $validator
    ){}

    public function edit(ProfileRequestDto $dto):array{
        if ($errors = $this->validator->validate($dto)){
            return ['success' => false, 'messages' => $errors];
        }
        else{
            //todo  Реализовать запись в модельку
        }

    }
}