<?php
namespace App\Components\Profile;

use App\Models\Users;


class ProfileEditor{
    public function __construct(
        private ProfileValidator $validator
    ){}


    public function edit(ProfileRequestDto $dto, $user_id): array{
        if ($errors = $this->validator->validate($dto)){
            return ['success' => false, 'messages' => $errors];
        }
        else{
            
            $user = Users::findByUserId($user_id);
            if($dto->email){
            $user->email = $dto->email;  
            if ($user->save()){
            return ['success' => true, 'messages' => 'email изменен'];
            }
            }
            //todo доделать тоже самое для других полей

        }
    }
}