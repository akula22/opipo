<?php

use yii\db\Migration;

class m160118_104204_create_profile_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%profile}}', [
            'firstname' => $this->string(100)->notNull(),
            'lastname' => $this->string(100)->notNull(),
            'avatar' => $this->string(255)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'gender' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'country' => $this->integer(2)->notNull(),
            'city' => $this->integer(2)->notNull(),
        ], $tableOptions);
 
        $this->createIndex('idx_profile_firstname', '{{%profile}}', 'firstname');
        $this->createIndex('idx_profile_lastname', '{{%profile}}', 'lastname');
        $this->createIndex('idx_profile_avatar', '{{%profile}}', 'avatar');
        $this->createIndex('idx_profile_user_id', '{{%profile}}', 'user_id');
    }

    public function down()
    {
         $this->dropTable('{{%profile}}');
    }
}
