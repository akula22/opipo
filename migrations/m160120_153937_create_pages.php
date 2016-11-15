<?php

use yii\db\Schema;
use yii\db\Migration;

class m160120_153937_create_pages extends Migration
{
	public function up(){
		$this->createTable('pages', [
			'id' => "SMALLINT(8)  NOT NULL AUTO_INCREMENT PRIMARY KEY",
			'alias' => "VARCHAR(100)  NOT NULL",
			'title' => "VARCHAR(255)  NOT NULL",
			'keywords' => "VARCHAR(255)  DEFAULT NULL",
			'description' => "VARCHAR(255)  DEFAULT NULL",
			'full' => "text  NOT NULL",
			'created_at' => "int(11)  NOT NULL",
			'updated_at' => "int(11)  DEFAULT NULL",
			'lang' => "VARCHAR(2)  NOT NULL",
		]);
		$this->createIndex('index_alias_created_at_lang', 'pages', ['alias', 'created_at', 'lang']);
	}
	public function down(){
		$this->dropTable('pages');
		return true;
	}
}