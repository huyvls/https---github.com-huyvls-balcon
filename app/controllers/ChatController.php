<?php

namespace App\Controllers;



class ChatController extends BaseController
{
    public function indexAction()
    {


        $this->view->pick("balcon/chats");
        $this->view->setTemplateAfter('main');
    }
}
