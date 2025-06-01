<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\ResponseInterface;
use App\Models\UserSettings;
use App\Controllers\BaseController;
use App\Components\Auth\AuthRequestDto;
use App\Repositories\UserRepository;
use App\Services\UserSettingsService;
use Throwable;

class AuthController extends BaseController
{
    public function indexAction(): void
    {
        $this->view->setVar("title", "Авторизация");
        $this->view->pick("balcon/auth");
        $this->view->setTemplateAfter('main');
    }

    public function authAction(): ?ResponseInterface
    {

        try {
            $authDto = AuthRequestDto::fromJson($this->request->getJsonRawBody());

            $user = UserRepository::autorisation(dto: $authDto);

            if ($user) {
                $userService = $this->di->get('UserSettingsService');
                $userService->setSessionDataByUser($user);

                $TEMA = $this->session->get('user_settings')['theme'];

                file_put_contents('C:/zxc/workk.txt', $TEMA . "\n", FILE_APPEND);

                return  $this->response->setJsonContent([
                    'success' => true,
                    'message' => 'Добро пожаловать,' . $user->user_name,
                    'theme'   =>  $this->session->get('user_settings')['theme']
                ]);
            } else {
                return $this->response->setJsonContent([
                    'success' => false,
                    'message' => 'Неправильно, попробуй еще раз'
                ]);
            }
        } catch (Throwable $e) {
            file_put_contents('C:/zxc/workk.txt', $e->getMessage(), FILE_APPEND);
            return $this->response->setStatusCode(500, 'server error')->setJsonContent([
                'success' => false,
                'message' => 'ошибка сервера'
            ]);
        }
        return null;
    }
}
