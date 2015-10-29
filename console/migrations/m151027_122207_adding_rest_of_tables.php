<?php

use yii\db\Schema;
use yii\db\Migration;

class m151027_122207_adding_rest_of_tables extends Migration
{
    public function up()
    {
        $this->createTable('content', [
            'id'=>'int(10) unsigned not null auto_increment',
            'parent_id'=>'int(10) unsigned default null',
            'title'=>'varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL',
            'excerpt'=>'varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL',
            'content'=>'MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL',
            'created_by'=>'int(10) not null',
            'create_time'=>'int(10) not null',
            'updated_by'=>'int(10) not null',
            'update_time'=>'int(10) not null',
            'status'=>'tinyint(1) not null',
            'type'=>'int(1) NOT NULL',
            'PRIMARY KEY (`id`)',
        ]);

        $this->createTable('menu',[
            'id'=>'int(10) unsigned not null auto_increment',
            'title'=>'varchar(64) not null',
            'description'=>'varchar(255) default null',
            'created_by'=>'int(10) not null',
            'create_time'=>'int(10) not null',
            'updated_by'=>'int(10) not null',
            'update_time'=>'int(10) not null',
            'status'=>'tinyint(1) not null',
            'PRIMARY KEY (`id`)'
        ]);


    }

    public function down()
    {
       $this->dropTable('content','menu');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
