<?php 

namespace App\Models;

use Phalcon\Mvc\Model;

class UserSettings extends Model
{
    public $id;

    public $user_id;

    public $theme;

    public $text_color;

    public function initialize()
    {
        $this->setSource("user_settings");
    }

}