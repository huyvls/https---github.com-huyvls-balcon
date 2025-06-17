<?php

namespace App\Repositories;

use Phalcon\Mvc\Model\Query\Builder;
use App\Models\Chat_connections;
use App\Models\Users;


class Chat_connectionsRepository
{

    public function getChatList(int $currentUser_id): ?\Phalcon\Mvc\Model\ResultsetInterface
    {
        $builder = new Builder();
        $builder->columns([
            'Chat_connections.*',
            'IF(Chat_connections.user1_id = :currentUserId:, User2.user_name, User1.user_name) as name',
        ])
            ->from(['Chat_connections' => Chat_connections::class])
            ->innerJoin(
                Users::class,
                'Chat_connections.user1_id = User1.user_id',
                'User1'
            )
            ->innerJoin(
                Users::class,
                'Chat_connections.user2_id = User2.user_id',
                'User2'
            )
            ->where('user1_id = :currentUserId: OR user2_id = :currentUserId:', [
                'currentUserId' => $currentUser_id
            ]);


        return $builder->getQuery()->execute(['currentUserId' => $currentUser_id]);
    }

    public function createChat(int $user_id, int $partnerId): bool | string
    {
        $chat = new Chat_connections();
        $chat->user1_id = min($user_id, $partnerId);
        $chat->user2_id = max($user_id, $partnerId);

        try {
            if ($chat->save()) {
                return true;
            }
            return  'user not exist';
        } catch (\Throwable $e) {
            return 'mess:' . $e->getMessage();
        }
    }


    public function deleteChat(int $chat_id): string
    {
        $currentChat = Chat_connections::findFirst([
            'conditions' => 'chat_id = :chat_id:',
            'bind' => ['chat_id' => $chat_id]
        ]);

        $currentChat->delete();
        return 'deleted';
    }
}
