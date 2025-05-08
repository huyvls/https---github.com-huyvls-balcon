<?php

namespace App\Repositories;

use App\Models\UserSettings;


class UserSettingsRepository
{
    public static function getSettingsByUserId(int $user_id): ?UserSettings
    {
        return UserSettings::findFirst([
            'conditions' => 'user_id = :id:',
            'bind' => ['id' => $user_id]
        ]);
    }

    public static function findUserSettings(int $userId): ?UserSettings
    {
        return UserSettings::findFirst([
            'conditions' => 'user_id = :user_id:',
            'bind' => ['user_id' => $userId],
        ]);
    }

    public static function updateThemeByUserId(int $user_id, string $theme): bool
    {
        $settings = self::getSettingsByUserId($user_id);
        if ($settings) {
            $settings->theme = $theme;
            $settings->update();
            return true;
        }

        return false;
    }

    public static function create(int $user_id): void
    {
        $settings = new UserSettings;
        $settings->assign(
            [
                'user_id' => $user_id
            ]
        );
        $settings->save();
        if (!$settings->save()) {
            throw new \Exception("Не удалось создать настройки");
        }
    }
}
