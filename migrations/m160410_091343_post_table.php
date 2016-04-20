<?php

use yii\db\Schema;
use yii\db\Migration;

class m160410_091343_post_table extends Migration
{
    public function up()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string('128')->notNull(),
            'short_text' => $this->text()->notNull(),
            'full_text' => $this->text()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createIndex('user_id', 'post', 'user_id');
        $this->createIndex('category_id', 'post', 'category_id');

        $this->addForeignKey('post_to_user', 'post', 'user_id', 'users', 'id');

    }

    public function down()
    {
        echo "m160410_091343_post_table cannot be reverted.\n";

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
