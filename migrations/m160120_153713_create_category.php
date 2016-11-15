<?php

use yii\db\Schema;
use yii\db\Migration;

class m160120_153713_create_category extends Migration
{
	public function up(){
		$this->createTable('category', [
			'id' => "int(11)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'parent_id' => "SMALLINT(8)  NOT NULL",
			'slug' => "VARCHAR(100)  NOT NULL",
			'position' => "SMALLINT(8)  DEFAULT NULL",
			'title' => "VARCHAR(255)  NOT NULL",
			'description' => "VARCHAR(255)  NOT NULL",
			'keywords' => "VARCHAR(255)  NOT NULL",
		]);
		$this->createIndex('index_parent_id_slug_position', 'category', ['parent_id', 'slug', 'position']);
	}
	public function down(){
		$this->dropTable('category');
		return true;
	}
}