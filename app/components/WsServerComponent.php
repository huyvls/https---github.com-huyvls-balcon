<?php

namespace App\Components;

class WsServerComponent
{
    public function WBSisRuning(string $OS): bool
    {
        $output = [];

        switch ($OS) {
            case 'Windows':
                exec('netstat -ano | findstr :8080', $output, $returnCode);
                break;

            case 'Linux':
                exec('netstat -tulnp | grep :8080', $output, $returnCode);
                break;
        }

        return !empty($output);
    }

    public function startWBS(string $OS): void
    {

        define('BASE_PATH', dirname(__DIR__, 2));

        $path = BASE_PATH . '/app/cli/WebSocketServer.php';
        switch ($OS) {
            case 'Windows':
                exec('start /B php ' . escapeshellarg($path) . ' > NUL 2>&1');
                break;

            case 'Linux':
                exec('php ' . escapeshellarg($path) . ' > /dev/null 2>&1 &');
                break;
        }
    }
}
