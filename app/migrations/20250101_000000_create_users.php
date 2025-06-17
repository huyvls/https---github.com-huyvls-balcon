<?php

use Phalcon\Db\Column;
use Phalcon\Db\Index;

class CreateUsersTable extends \Phalcon\Mvc\Model\Migration
{
    public function up()
    {
        $this->morphTable('users', [
            'columns' => [
                new Column('user_id', [
                    'type'          => Column::TYPE_INTEGER,
                    'size'          => 11,
                    'unsigned'      => true,
                    'notNull'      => true,
                    'autoIncrement' => true,
                    'first'        => true
                ]),
                new Column('email', [
                    'type'    => Column::TYPE_VARCHAR,
                    'size'    => 100,
                    'notNull' => false,
                    'default' => null
                ]),
                new Column('password', [
                    'type'    => Column::TYPE_VARCHAR,
                    'size'    => 100,
                    'notNull' => false,
                    'default' => null
                ]),
                new Column('registration_date', [
                    'type'    => Column::TYPE_DATE,
                    'notNull' => false,
                    'default' => null
                ]),
                new Column('user_name', [
                    'type'    => Column::TYPE_VARCHAR,
                    'size'    => 100,
                    'notNull' => false,
                    'default' => null
                ])
            ],
            'indexes' => [
                new Index('PRIMARY', ['user_id'], 'PRIMARY')
            ],
            'options' => [
                'TABLE_TYPE'      => 'BASE TABLE',
                'ENGINE'         => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci'
            ]
        ]);
    }

    public function down()
    {
        $this->getConnection()->dropTable('users');
    }
}
