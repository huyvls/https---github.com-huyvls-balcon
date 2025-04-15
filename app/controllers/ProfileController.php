<?php      
namespace App\Controllers;
use App\Components\Profile\ProfileRequestDto,
App\Components\Profile\ProfileValidator,
App\Components\Profile\ProfileEditor;




class ProfileController extends BaseController
{
    public array $user = [];

    public function onConstruct()
    {
    $this->user = $this->session->get("user") ?? [];
    }
    public function indexAction()  {
    $email = $this->user['email'];
    $login = $this->user['username'];
    


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
                file_put_contents('C:/zxc/work.txt', 'user_service_settings_controller' . $e->getMessage() . PHP_EOL, FILE_APPEND);
                }

                return $this->response->setJsonContent(['theme' => $theme]);


            }
        }
    }


    public function editRequestAction(): mixed{
        
        if ($this->request->isPost()) {
        
        $data =  $this->request->getJsonRawBody();
        
        $dto = ProfileRequestDto::fromJson($data); 
           
        $ProfileEditor = $this->di->get('ProfileEditor');
                
        $result = $ProfileEditor->edit($dto, $this->user['id']);
        
        return $this->response->setJsonContent($result);

        }
    
    }
}
