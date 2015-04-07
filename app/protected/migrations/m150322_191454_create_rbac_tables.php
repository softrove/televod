<?php

class m150322_191454_create_rbac_tables extends CDbMigration
{

	public function safeUp()
	{

        $this->createTable('AuthItem', array(
            'name' => 'varchar(64) not null',
            'type' => 'integer not null',
            'description' => 'text',
            'bizrule' => 'text',
            'data' => 'text',
            'primary key (`name`)',
        ), 'ENGINE=InnoDB'
        );


        $this->createTable('AuthItemChild', array(
            'parent' => 'varchar(64) not null',
            'child' => 'varchar(64) not null',
            'primary key (`parent`,`child`)',
            'foreign key (`parent`) references `AuthItem` (`name`) on delete cascade on update cascade',
            'foreign key (`child`) references `AuthItem` (`name`) on delete cascade on update cascade'
        ), 'ENGINE=InnoDB'
        );

        $this->createTable('AuthAssignment', array(
            'itemname' => 'varchar(64) not null',
            'userid' => 'varchar(64) not null',
            'bizrule' => 'text',
            'data' => 'text',
            'primary key (`itemname`,`userid`)',
            'foreign key (`itemname`) references `AuthItem` (`name`) on delete cascade on update cascade'
        ), 'ENGINE=InnoDB'
        );
	}

	public function safeDown()
	{
        $this->dropTable('AuthAssignment');
        $this->dropTable('AuthItemChild');
        $this->dropTable('AuthItem');
	}
}