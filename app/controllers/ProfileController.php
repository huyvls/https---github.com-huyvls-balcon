<?php      
namespace App\Controllers;
use App\Components\Profile\ProfileRequestDto,
App\Components\Profile\ProfileValidator,
App\Components\Profile\ProfileEditor;




class ProfileController extends BaseController
{
    public function indexAction()  {
    $user = $this->session->get("user");
    $email = $user['email'];
    $login = $user['username'];
    


    $this-> view->setVars ([
        'email' => $email,
        'login' => $login,
        'title' => 'Настройки'
    ]);
    $this->view->pick("balcon/profile");
    $this->view->setTemplateAfter('main');
}


    public function swapThemeRequestAction(): mixed{


        if ($this->request->isAjax()) {                             
            $usetting = $this->session->get('user_settings');
            $theme = $usetting['theme'];                                

            return $this->response->setJsonContent(['theme' => $theme]);
        }

        if ($this->request->isPost()){
            $rawBody = $this->request->getJsonRawBody();
            $theme = $rawBody->theme ?? null; 

            if ($theme){
                if($this->UserSettingsService->updateTheme($theme)){
                }

                try {
                $this->modelsManager->executeQuery(
                    "UPDATE App\Models\UserSettings SET theme = :theme: WHERE user_id = :user_id:",
                    [
                        "theme"  => $theme,
                        "user_id" => $user_id
                    ]
                );
                } catch (\Exception $e){
                file_put_contents('C:/zxc/work.txt', $e->getMessage() . PHP_EOL, FILE_APPEND);
                }

                return $this->response->setJsonContent(['theme' => $theme]);


            }
        }
    }


    public function editRequestAction(): mixed{

        if ($this->request->isPost()) {
            $data = $this->request->getJsonRawBody();
            $dto = ProfileRequestDto::fromJson($data);
            //todo Добравть ProfileEditor в DI
            $result = $this->ProfileEditor->edit($dto, $user['id']);

            return $this->response->setJsonContent($result)
            ->setStatusCode($result['success'] ? 200 : 400);

    
            
    
        }
    
    }
}
