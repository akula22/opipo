<?php

use yii\db\Schema;
use yii\db\Migration;

class m160119_202122_create_log extends Migration
{
	public function up(){
		$this->createTable('log', [
			'id' => "int(11)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'created_at' => "int(11)  NOT NULL",
			'category' => "VARCHAR(64)  NOT NULL",
			'user_id' => "int(11)  NOT NULL",
			'username' => "VARCHAR(100)  NOT NULL",
			'event' => "text  DEFAULT NULL",
		]);
		$this->createIndex('index_created_at_category_user_id_username', 'log', ['created_at', 'category', 'user_id', 'username']);
	}
	public function down(){
		$this->dropTable('log');
		return true;
	}
}