<?php

class m150407_140217_create_api_key_tables extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('apikey', array(
            'id' => 'pk',
            'key' => 'varchar(64) not null',
            'KEY `key_index` (`key`)'
        ), 'ENGINE=InnoDB'
        );

        $this->createTable('origin', array(
            'id' => 'pk',
            'url' => 'varchar(256) not null',
            'key_id' => 'int(10) NOT NULL',
            'foreign key (`key_id`) references `apikey` (`id`) on delete cascade on update cascade',
        ), 'ENGINE=InnoDB'
        );
	}

	public function safeDown()
	{
        $this->dropTable('origin');
        $this->dropTable('apikey');
	}
}