<?php
use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;

class CreateUserSettingsTable extends \Phalcon\Mvc\Model\Migration
{
    public function up()
    {
        $this->morphTable('user_settings', [
            'columns' => [
                new Column('id', [
                    'type'          => Column::TYPE_INTEGER,
                    'size'          => 11,
                    'unsigned'      => true,
                    'notNull'      => true,
                    'autoIncrement' => true,
                    'first'        => true
                ]),
                new Column('user_id', [
                    'type'     => Column::TYPE_INTEGER,
                    'size'     => 11,
                    'notNull'  => true,
                    'unsigned' => true
                ]),
                new Column('theme', [
                    'type'    => Column::TYPE_VARCHAR,
                    'size'    => 10,
                    'notNull' => false,
                    'default' => 'light'
                ]),
                new Column('test_color', [
                    'type'    => Column::TYPE_VARCHAR,
                    'size'    => 100,
                    'notNull' => false,
                    'default' => '0, 0, 0'
                ])
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY'),
                new Index('idx_user_id', ['user_id'])
            ],
            'references' => [
                new Reference(
                    'fk_user_settings_user_id',
                    [
                        'referencedTable'   => 'users',
                        'referencedSchema'  => 'public',
                        'columns'           => ['user_id'],
                        'referencedColumns' => ['user_id'],
                        'onDelete'         => 'CASCADE',
                        'onUpdate'         => 'CASCADE'
                    ]
                )
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
        $this->getConnection()->dropTable('user_settings');
    }
}