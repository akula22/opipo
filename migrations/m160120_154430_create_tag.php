<?php

use yii\db\Schema;
use yii\db\Migration;

class m160120_154430_create_tag extends Migration
{
	public function up(){
		$this->createTable('tag', [
			'id' => "int(11)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'name' => "VARCHAR(100)  NOT NULL",
			'count' => "int(11)  NOT NULL",
		]);
		$this->createIndex('index_name_count', 'tag', ['name', 'count']);
	}
	public function down(){
		$this->dropTable('tag');
		return true;
	}
}