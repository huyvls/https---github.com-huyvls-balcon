<?php

namespace App\Controllers;

use App\Repositories\Chat_connectionsRepository;
use App\Repositories\Chat_valueRepository;
use App\Repositories\UserRepository;


class ChatController extends BaseController
{
    public function indexAction()
    {

        $this->view->setVar("title", 'Чаты');
        $this->view->pick("balcon/chats");
        $this->view->setTemplateAfter('main');
    }

    public function existRequestAction()
    {

        $username = $this->request->getJsonRawBody();

        $userModel = new UserRepository();

        $userModel->findByUsername($username->name);

        if ($userModel) {
            return $this->response->setJsonContent(['exists' => !is_null($userModel)]);
        }
    }

    public function getChatsRequestAction()
    {

        $chatModel = new Chat_connectionsRepository();

        $list = $chatModel->getChatList($this->getUserId());

        return $this->response->setJsonContent($list);
    }

    public function openChatRequestAction()
    {
        $chatModel = new Chat_valueRepository();

        $chat_id = $this->request->getJsonRawBody(); //объект

        $chatModel->getMessages($chat_id); // todo переписать 
    }

    public function createRequestAction()
    {
        $partner = $this->request->getJsonRawBody();

        $chatModel = new Chat_connectionsRepository();

        $userModel = new UserRepository();

        $partnerId = $userModel->getIdbyUsername($partner->name);

        $create = $chatModel->createChat($this->getUserId(), $partnerId);

        return $this->response->setJsonContent(['message' => $create]);
    }

    public function deleteRequestAction(){

        $request = $this->request->getJsonRawBody();

        $chatModel = new Chat_connectionsRepository();

        $result = $chatModel->deleteChat($request->chat_id);

        file_put_contents('C:/zxc/workk.txt', json_encode($request)."\n", FILE_APPEND);

        return $this->response->setJsonContent(['message'=>$result]);
    }
}
