<?php      
namespace App\Controllers;
use Phalcon\Mvc\Controller;
use App\Models\Users;
use App\Models\UserSettings;
use Phalcon\Http\Request;



class ProfileController extends Controller{
    public function indexAction(){
    $user = $this->session->get("user");
    $email = $user['email'];
    $login = $user['username'];
    

    if ($this->request->isPost()) {
        $data = $this->request->getJsonRawBody();
        $username = trim($data->username ?? null);
        $password = trim($data->password ?? null);
        $repassword = trim($data->repassword ?? null);
        $email = trim($data->email ?? null);

        if (!$repassword) {
            return $this->response->setJsonContent([
                'success' => false,
                'message' => 'Повтори']);

        }

    }



    $this-> view->setVar ("email", $email);
    $this-> view->setVar ("login", $login);
    $this->view->pick("balcon/profile");
    $this-> view->setVar("title","Настройки");
    $this->view->setTemplateAfter('main');
}


    public function swapThemeRequestAction(){

       


        if ($this->request->isAjax()) {                             
            $usetting = $this->session->get('user_settings');
            $theme = $usetting['theme'];                                
            

        
            return $this->response->setJsonContent(['theme' => $theme]);
          
        }

        if ($this->request->isPost()){
            $rawBody = $this->request->getJsonRawBody();
            $theme = $rawBody->theme ?? null; 

            
           
            if ($theme){
                $user = $this->session->get('user');
                $user_id = $user['id'];
                

                $this->session->set ('user_settings', [
                    'theme'=> $theme 
                ]);
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
}

