<?php

namespace App\Components;

class TelegramHook
{

    private TMessagesHendler $bot;

    public function __construct()
    {
        $this->bot = new TMessagesHendler();
    }

    public function handle(string $raw): void
    {
        $update = json_decode($raw, true);
        if (!isset($update['message'])) {
            return;
        }

        $chatId = $update['message']['chat']['id'];
        $text = $update['message']['text'] ?? '';
        $username = $update['message']['from']['username'] ?? 'неизвестный пользователь';

        $reply = "Пользователь @$username написал: $text";

        $this->bot->sendMessage($chatId, $reply);
    }
}
