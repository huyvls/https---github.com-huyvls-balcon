<?php

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;

class CreateChatTables extends \Phalcon\Mvc\Model\Migration
{
    public function up()
    {
        $this->morphTable('chat_connections', [
            'columns' => [
                new Column('chat_id', [
                    'type' => Column::TYPE_INTEGER,
                    'autoIncrement' => true,
                    'first' => true
                ]),
                new Column('user1_id', [
                    'type' => Column::TYPE_INTEGER,
                    'notNull' => true
                ]),
                new Column('user2_id', [
                    'type' => Column::TYPE_INTEGER,
                    'notNull' => true
                ]),
                new Column('created_at', [
                    'type' => Column::TYPE_TIMESTAMP,
                    'default' => 'CURRENT_TIMESTAMP'
                ])
            ],
            'indexes' => [
                new Index('PRIMARY', ['chat_id'], 'PRIMARY'),
                new Index('uk_user_pair', ['user1_id', 'user2_id'], 'UNIQUE')
            ]
        ]);

        $this->morphTable('chat_value', [
            'columns' => [
                new Column('id', [
                    'type' => Column::TYPE_INTEGER,
                    'autoIncrement' => true,
                    'first' => true
                ]),
                new Column('chat_id', [
                    'type' => Column::TYPE_INTEGER,
                    'notNull' => true
                ]),
                new Column('sender_user_id', [
                    'type' => Column::TYPE_INTEGER,
                    'notNull' => true
                ]),
                new Column('message', [
                    'type' => Column::TYPE_TEXT,
                    'notNull' => true
                ]),
                new Column('sent_at', [
                    'type' => Column::TYPE_TIMESTAMP,
                    'default' => 'CURRENT_TIMESTAMP'
                ])
            ],
            'indexes' => [
                new Index('PRIMARY', ['message_id'], 'PRIMARY'),
                new Index('idx_chat_id', ['chat_id']),
                new Index('idx_user_id', ['user_id'])
            ],
            'references' => [
                new Reference(
                    'fk_chat_value_chat_id',
                    [
                        'referencedTable' => 'chat_connections',
                        'referencedSchema' => 'public',
                        'columns' => ['chat_id'],
                        'referencedColumns' => ['chat_id'],
                        'onDelete' => 'CASCADE'
                    ]
                ),
                new Reference(
                    'fk_chat_value_user_id',
                    [
                        'referencedTable' => 'users',
                        'referencedSchema' => 'public',
                        'columns' => ['user_id'],
                        'referencedColumns' => ['user_id'],
                        'onDelete' => 'CASCADE'
                    ]
                )
            ]
        ]);
    }

    public function down()
    {
        $this->getConnection()->dropTable('chat_value');
        $this->getConnection()->dropTable('chat_connections');
    }
}
