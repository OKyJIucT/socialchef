<?php

use yii\db\Schema;
use yii\db\Migration;

class m160417_141112_category_table extends Migration
{
    public function up()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'title' => $this->string('128')->notNull(),
            'slug' => $this->string('128')->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->addForeignKey('post_to_category', 'post', 'category_id', 'category', 'id');
    }

    public function down()
    {
        echo "m160417_141112_category_table cannot be reverted.\n";

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
