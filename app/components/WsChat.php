<?php

namespace App\Components;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use SplObjectStorage;
use GuzzleHttp\Client;

class WsChat implements MessageComponentInterface
{

    protected array $rooms = [];

    public function onOpen(ConnectionInterface $conn): void
    {
        $query = $conn->httpRequest->getUri()->getQuery();
        parse_str($query, $params);
        $chatId = $params['chatId'] ?? null;

        echo "Новое соединение: " . $conn->resourceId . "\n";
        echo "URL запроса: " . $conn->httpRequest->getUri() . "\n";

        if (!$chatId) {
            echo "chatId не передан\n";
            $conn->close();
            return;
        }

        $conn->chatId = $chatId;


        if (!isset($this->rooms[$chatId])) {
            $this->rooms[$chatId] = new SplObjectStorage();
        }

        $this->rooms[$chatId]->attach($conn);

        echo "Пользователь подключён к чату [$chatId] \n";
    }

    public function onMessage(ConnectionInterface $from, $msg): void
    {
       
        $chatId = $from->chatId ?? null;
        if (!$chatId || !isset($this->rooms[$chatId])) {
            echo "Попытка отправки в несуществующую комнату\n";
            return;
        }

        $data = json_decode($msg, true);

        $httpClient = new Client();
        
        $httpClient->post('http://127.0.0.1/saveMessages', [
            'json' => [
                'chat_id' => $chatId,
                'text' => $data['text'],
                'sender_id' => $data['sender']
            ]
        ]);
        
        foreach ($this->rooms[$chatId] as $client) {
            if ($from !== $client) {
                $client->send($msg);
            }
        }
    }




    public function onClose(ConnectionInterface $conn): void
    {
        $chatId = $conn->chatId ?? null;

        if ($chatId && isset($this->rooms[$chatId])) {
            $this->rooms[$chatId]->detach($conn);
            echo "Пользователь отключён от чата [$chatId] \n";

            if (count($this->rooms[$chatId]) === 0) {
                unset($this->rooms[$chatId]);
            }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e): void
    {
        echo "Ошибка соединения ({$conn->resourceId}): {$e->getMessage()}\n";
        var_dump($e);
        $conn->close();
    }

}