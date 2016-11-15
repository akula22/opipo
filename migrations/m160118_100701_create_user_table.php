<?php

use yii\db\Migration;

class m160118_100701_create_user_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
 
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(100)->notNull(),
            'auth_key' => $this->string(32),
            'password_hash' => $this->string(255)->notNull(),
            'password_reset_token' => $this->string(255),
            'email' => $this->string(200)->notNull(),
            'role' => $this->string(16)->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'client' => $this->string(255),
            'client_id' => $this->string(255),
        ], $tableOptions);
 
        $this->createIndex('idx_user_username', '{{%user}}', 'username');
        $this->createIndex('idx_user_email', '{{%user}}', 'email');
        $this->createIndex('idx_user_status', '{{%user}}', 'status');
        $this->createIndex('idx_user_role', '{{%user}}', 'role');
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
