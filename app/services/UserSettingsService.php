<?php

namespace App\Services;

use App\Models\Users;
use App\Repositories\UserSettingsRepository;

use Phalcon\Mvc\Model\ManagerInterface;
use Phalcon\Session\Manager as SessionManager;

class UserSettingsService
{
    protected SessionManager $session;
    protected ManagerInterface $modelsManager;

    public function __construct(SessionManager $session, ManagerInterface $modelsManager)
    {
        $this->session = $session;
        $this->modelsManager = $modelsManager;
    }

    public static function init(): self
    {
        $di = \Phalcon\Di\Di::getDefault();
        return new self(
            $di->get('session'),
            $di->get('modelsManager')
        );
    }

    public function getTheme(): ?string
    {
        $settings = $this->session->get('user_settings');
        return $settings['theme'] ?? null;
    }

    public function updateTheme(string $theme): bool
    {
        $user = $this->session->get('user');
        $user_id = $user['id'] ?? null;

        if (!$user_id) {
            return false;
        }

        $this->session->set('user_settings', ['theme' => $theme]);

        try {
            return UserSettingsRepository::updateThemeByUserId($user_id, $theme);
        } catch (\Exception $e) {
            file_put_contents('C:/zxc/work.txt', 'user_service_settings' . $e->getMessage() . PHP_EOL, FILE_APPEND);
            return false;
        }
    }

    public function setSessionDataByUser(Users $user): void
    {
        $this->session->set('user', [
            'id' => $user->user_id,
            'username' => $user->user_name,
            'email' => $user->email
        ]);

        $settings =  UserSettingsRepository::getSettingsByUserId($user->user_id);

        $this->session->set('user_settings', [
            'theme' => $settings->theme,
            'text_color' => $settings->text_color
        ]);
    }
}
