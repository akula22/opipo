<?php

use yii\db\Migration;
use yii\db\Schema;

class m151226_090624_create_pm_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%pm}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'username' => $this->string(100),
            'user_id' => $this->integer()->notNull(),
            'sender_id' => $this->integer()->notNull(),
            'text' => $this->text(),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(0),
        ], $tableOptions);
 
        $this->createIndex('idx_pm_username', '{{%pm}}', 'username');
        $this->createIndex('idx_pm_status', '{{%pm}}', 'status');
        $this->createIndex('idx_pm_user_id', '{{%pm}}', 'user_id');
        $this->createIndex('idx_pm_sender_id', '{{%pm}}', 'sender_id');

    }

    public function down()
    {
        $this->dropTable('{{%pm}}');
    }
}
