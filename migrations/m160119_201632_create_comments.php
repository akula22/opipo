<?php

use yii\db\Schema;
use yii\db\Migration;

class m160119_201632_create_comments extends Migration
{
	public function up(){
		$this->createTable('comments', [
			'id' => "INT(11)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'post' => "TEXT  NOT NULL",
			'created_at' => "int(11)  DEFAULT NULL",
			'updated_at' => "int(11)  DEFAULT NULL",
			'user_id' => "int(11)  NOT NULL",
			'post_id' => "int(11)  NOT NULL",
			'module' => "VARCHAR(200)  DEFAULT NULL",
			'username' => "VARCHAR(100)  NOT NULL",
		]);
		$this->createIndex('index_created_at_updated_at_user_id_post_id_username', 'comments', ['created_at', 'updated_at', 'user_id', 'post_id', 'username']);
	}
	public function down(){
		$this->dropTable('comments');
		return true;
	}
}