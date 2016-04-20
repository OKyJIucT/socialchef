<?php

use yii\db\Schema;
use yii\db\Migration;

class m150809_154559_table_user extends Migration
{
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'email' => $this->string('32')->notNull(),
            'username' => $this->string('32')->notNull(),
            'password' => $this->string('128')->notNull(),
            'auth_key' => $this->string('64'),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    public function down()
    {
        echo "m150809_154559_table_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
