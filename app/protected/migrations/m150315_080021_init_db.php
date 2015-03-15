<?php

class m150315_080021_init_db extends CDbMigration
{
    public function safeUp()
    {

        $this->createTable('series', array(
            'id' => 'pk',
            'title' => 'varchar(64) NULL',
            'url' => 'varchar(512) NULL',
            'updated' => 'datetime NOT NULL',
        ), 'ENGINE=InnoDB'
        );

        $this->createTable('season', array(
            'id' => 'int(10) NOT NULL AUTO_INCREMENT',
            'title' => 'varchar(64) NULL',
            'url' => 'varchar(512) NULL',
            'updated' => 'datetime NOT NULL',
            'series_id' => 'int(10) NULL',
            'PRIMARY KEY (`id`)',
            'KEY `season_id` (`series_id`)',
            'CONSTRAINT `Series` FOREIGN KEY (`series_id`) REFERENCES `series` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION'
        ), 'ENGINE=InnoDB'
        );

        $this->createTable('episode', array(
            'id' => 'int(10) NOT NULL AUTO_INCREMENT',
            'title' => 'varchar(64) NULL',
            'url' => 'varchar(512) NULL',
            'updated' => 'datetime NOT NULL',
            'season_id' => 'int(10) NULL',
            'PRIMARY KEY (`id`)',
            'KEY `season_id` (`season_id`)',
            'CONSTRAINT `Season` FOREIGN KEY (`season_id`) REFERENCES `season` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION'
        ), 'ENGINE=InnoDB'
        );

    }

    public function safeDown()
    {
        $this->dropTable('episode');
        $this->dropTable('season');
        $this->dropTable('series');
    }
}