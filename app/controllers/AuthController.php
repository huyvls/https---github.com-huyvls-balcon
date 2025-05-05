<?php
namespace App\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\ResponseInterface;
use App\Models\UserSettings;
use App\Controllers\BaseController;
use App\Components\Auth\AuthRequestDto;
use App\Repositories\UserRepository;
use App\Services\UserSettingsService;


class AuthController extends BaseController 
{
    public function indexAction():?ResponseInterface{

        $this-> view->setVar("title","Авторизация");
        $this->view->pick("balcon/auth");
        $this->view->setTemplateAfter('main');
        
        if ($this->request->isPost()) {
        $authDto = AuthRequestDto::fromJson($this->request->getJsonRawBody());

        $user = UserRepository::autorisation($authDto);

        if ($user) {
            $userService = $this->di->get('UserSettingsService');
            $userService->setSessionDataByUser($user);

            return  $this->response->setJsonContent([
                'success' => true,
                'message' => 'Добро пожаловать,' . $user->user_name]);

        }
        else{
            return $this->response->setJsonContent([
                'success' => false,
                'message' => 'Неправильно, попробуй еще раз']);
        }
    }
    return null;
}

}