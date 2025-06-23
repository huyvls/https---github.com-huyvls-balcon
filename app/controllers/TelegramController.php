<?php

namespace App\Controllers;


use App\Components\TMessagesHendler;

class TelegramController extends BaseController
{
    public function webhookAction()
    {
        $this->view->disable();

        $raw = file_get_contents("php://input");
        $update = json_decode($raw, true);


        if (isset($update['message'])) {
            $chatId = $update['message']['chat']['id'];
            $text = $update['message']['text'];

            $reply = "Ты написал: $text";

            $bot = new TMessagesHendler();
            $bot->sendMessage($chatId, "Ты написал: $text");
        }

        return '';
    }
}
