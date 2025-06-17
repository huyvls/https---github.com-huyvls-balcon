<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;


class BaseController extends Controller
{
    protected array $user = [];
    public function onConstruct()
    {
        $this->user = $this->session->get('user') ?? [];
    }

    protected function getUserId(): int
    {
        return $this->user['id'];
    }
}
