<?php

namespace App\Repositories;

use App\Models\UserSettings;


class UserSettingsRepository
{
    public static function getSettingsByUserId($user_id): ?UserSettings
    {
        return UserSettings::findFirst([
            'conditions' => 'user_id = :id:',
            'bind' => ['id' => $user_id]
        ]);
    }

    public static function updateThemeByUserId(string $user_id, string $theme): bool
    {
        $settings = self::getSettingsByUserId($user_id);
        if ($settings) {
            $settings->theme = $theme;
            $settings->update();
            return true;
        }

        return false;
    }
}
