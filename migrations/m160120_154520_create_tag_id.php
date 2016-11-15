<?php

use yii\db\Schema;
use yii\db\Migration;

class m160120_154520_create_tag_id extends Migration
{
	public function up(){
		$this->createTable('tag_id', [
			'model_id' => "int(11)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'tag_id' => "int(11)  NOT NULL",
			'ord' => "VARCHAR(100)  DEFAULT NULL",
		]);
		$this->createIndex('index_model_id_tag_id', 'tag_id', ['model_id', 'tag_id']);
	}
	public function down(){
		$this->dropTable('tag_id');
		return true;
	}
}