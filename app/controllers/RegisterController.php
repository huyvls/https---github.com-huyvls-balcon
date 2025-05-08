<?php      
namespace App\Controllers;
use App\Components\Register\AccountCreator;
use App\Components\Register\RegisterValidator;
use Phalcon\Mvc\Controller;
use App\Repositories\UserRepository;
use App\Repositories\UserSettingsRepository;


class RegisterController extends BaseController
{
    public function indexAction(){

        if ($this->request->isPost()) {

            $data = $this->request->getJsonRawBody();

            $validator = new RegisterValidator(new UserRepository);
            $validator->validate($data);

            $creator = new AccountCreator($validator);
            $result = $creator->create($data);
            
            return $this->response->setJsonContent($result);
        }

        $this-> view->setVar("title","Регистрация");
        $this->view->pick("balcon/register");
        $this->view->setTemplateAfter('main');
    }
    
}

