<?php
namespace App\Components\Profile;

use App\Models\Users;


class ProfileEditor{
    public function __construct( private ProfileValidator $validator){}


    public  function edit(ProfileRequestDto $dto, $user_id): array{
        if ($errors = $this->validator->validate($dto)){
            return ['success' => false, 'message' => $errors];
        }
        else{
            $user = Users::findByUserId($user_id);
            
if (!$user) {
    return ['success' => false, 'message' => 'Пользователь не найден.'];
}
            $messages = [];
            if ($dto->email) {
                $user->email = $dto->email;
                if ($user->save()) {
                    $messages[] = 'Email изменён';
                }
            }
        
            if ($dto->username) {
                $user->user_name = $dto->username;
                if ($user->save()) {
                    $messages[] = 'Имя пользователя изменено';
                }
            }
        
            if ($dto->password) {
                $user->password = $dto->password;
                if ($user->save()) {
                    $messages[] = 'Пароль изменён';
                }
            }
        
            if (empty($messages)) {
                return ['success' => false, 'message' => 'Ничего не было изменено.'];
            }
        
                return ['success' => true, 'message' => implode(', ', $messages)];
            }

        }
    }

