<?php 

namespace App\Models;

use Phalcon\Mvc\Model;

class UserSettings extends Model
{
    public int $id;

    public int $user_id;

    public string $theme;

    public string $text_color;

    public function initialize()
    {
        $this->setSource("user_settings");
    }

}