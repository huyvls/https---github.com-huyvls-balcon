<?php
require __DIR__ . '/../../vendor/autoload.php'; 
//require __DIR__ . '/../components/WsChat.php';
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Server\IoServer;
use App\Components\WsChat; 


$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new WsChat() 
        )
    ),
    8080 
);

echo "WebSocket сервер запущен на ws://localhost:8080\n";
$server->run();
