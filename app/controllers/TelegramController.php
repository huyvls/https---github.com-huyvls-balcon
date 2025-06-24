<?php

namespace App\Controllers;

use App\Components\TMessagesHendler;
use App\Components\TelegramHook;

class TelegramController extends BaseController
{
    public function webhookAction()
    {
        $this->view->disable();

        $raw = file_get_contents("php://input");

        $handler = new TelegramHook();
        $handler->handle($raw);

        return '';
    }
}
