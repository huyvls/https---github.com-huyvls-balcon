<?php      
namespace App\Controllers;
use Phalcon\Mvc\Controller;
use App\Models\Users;
use App\Models\UserSettings;


class RegisterController extends BaseController
{
    public function indexAction(){

        if ($this->request->isPost()) {
        $data = $this->request->getJsonRawBody();
        $username = trim($data->username ?? null);
        $password = trim($data->password ?? null);
        $repassword = trim($data->repassword ?? null);
        $email = trim($data->email ?? null);
        $datereg = date('Y-m-d');

        $checkname = Users::findfirst([
            'conditions' => 'user_name = :username:',
            'bind'       => [
                'username' => $username ]
            ]);

        $checkemail = Users::findfirst([
            'conditions' => 'email = :email:',
            'bind'       => [
                'email' => $email ]
            ]);

            if ($username == null || $password == null || $repassword == null || $email == null){

                return $this->response->setJsonContent([
                    'success' => false,
                    'message' => 'Необходимо ввести все данные']);

            }
            if (  $password != $repassword){

                return $this->response->setJsonContent([
                    'success' => false,
                    'message' => 'Пароли не совпадают']);

            }
            if ($checkname){

                return $this->response->setJsonContent([
                    'success' => false,
                    'message' => 'Пользователь с таким именем уже существует']);

            }
            if ($checkemail){

                return $this->response->setJsonContent([
                    'success' => false,
                    'message' => 'Пользователь с таким email уже существует']);
                }
            else{
                $user = new Users;
                $user->user_name = $username;
                $user->password = $password;
                $user->email = $email;
                $user->registration_date = $datereg;

                if ($user->save()) {
                    $this->session->set ('reg', [
                        'Y'=> 1,
                        
                    ]);

                    $user_settings = new UserSettings;
                    $native_user = Users::findfirst([
                    'conditions' => 'email = :email:',
                    'bind'       => [
                        'email' => $email ]
                    ]);
                    $user_idd = $native_user->user_id;
                    $user_settings->user_id=$user_idd;
                    $user_settings->save();

                    return $this->response->setJsonContent([
                        'success' => true,
                        'message' => 'Ништяк']);
                }

            }


        }
    

        $this-> view->setVar("title","Регистрация");
        $this->view->pick("balcon/register");
        $this->view->setTemplateAfter('main');

    }
}


















       // if (empty($username) || empty($password)) {
        //     $this->flash->error("Логин и пароль обязательно");
        //     return $this->response->redirect("/");
        //     $need = 1;
        //     $this->view ->setVar("need", $need);
        // }