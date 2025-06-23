<?php

namespace App\Components;


class TMessagesHendler
{
    private string $token = '7242283442:AAGpUxhxoGiUNcYx0hXzR2QXKJKlLgLZkKg';

    public function sendMessage($chatId, $text)
    {
        file_get_contents("https://api.telegram.org/bot{$this->token}/sendMessage?" . http_build_query([
            'chat_id' => $chatId,
            'text' => $text
        ]));
    }
}
