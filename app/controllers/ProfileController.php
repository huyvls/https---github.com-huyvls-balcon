<?php      
namespace App\Controllers;
use App\Components\Profile\ProfileRequestDto,
App\Components\Profile\ProfileValidator,
App\Components\Profile\ProfileEditor;
use Phalcon\Http\ResponseInterface;



class ProfileController extends BaseController
{
    public array $user = [];

    public function onConstruct()
    {
    $this->user = $this->session->get("user") ?? [];
    }
    public function indexAction(): void  {
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


    public function getThemeRequestAction(): ResponseInterface{

        if ($this->request->isAjax()) {                             
            $usetting = $this->session->get('user_settings');
            $theme = $usetting['theme'];                                
            file_put_contents('C:/zxc/workk.txt', 'ajax отрабатывает'."\n" . $theme, FILE_APPEND);
            return $this->response->setJsonContent(['theme' => $theme]);
        }
        return $this->response
            ->setStatusCode(400, 'Bad Request')
            ->setJsonContent(['error' => true, 'message' => 'Invalid request']);
    }

    public function swapThemeRequestAction(): ResponseInterface{
        if ($this->request->isPost()){
            $rawBody = $this->request->getJsonRawBody();
            $theme = $rawBody->theme ?? null; 

            if ($theme){
                $this->UserSettingsService->updateTheme($theme);
                
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
