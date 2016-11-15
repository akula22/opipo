<?php

use yii\db\Schema;
use yii\db\Migration;

class m160120_154255_create_post extends Migration
{
	public function up(){
		$this->createTable('post', [
			'id' => "INT(11)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'slug' => "VARCHAR(200)  NOT NULL",
			'title' => "VARCHAR(255)  NOT NULL",
			'keywords' => "VARCHAR(255)  DEFAULT NULL",
			'description' => "VARCHAR(255)  DEFAULT NULL",
			'full' => "text  NOT NULL",
			'created_at' => "int(11)  NOT NULL",
			'updated_at' => "int(11)  DEFAULT NULL",
			'lang' => "VARCHAR(2)  NOT NULL",
			'short' => "text  NOT NULL",
			'main' => "TINYINT(1)  NOT NULL",
			'status' => "TINYINT(1)  NOT NULL",
			'user_id' => "int(11)  NOT NULL",
			'username' => "VARCHAR(100)  DEFAULT NULL",
			'cat_id' => "SMALLINT(4)  NOT NULL",
			'position' => "int(11)  NOT NULL",
		]);
		$this->createIndex('index_slug_created_at_lang_main_status_user_id_cat_id_position', 'post', ['slug', 'created_at', 'lang', 'main', 'status', 'user_id', 'cat_id', 'position']);
	}
	public function down(){
		$this->dropTable('post');
		return true;
	}
}