<?php

use yii\db\Schema;
use yii\db\Migration;

class m160417_144841_add_fields_in_post extends Migration
{
    public function up()
    {
        $this->addColumn('post', 'image', $this->string('128'));
        $this->addColumn('post', 'slug', $this->string('128')->notNull());
    }

    public function down()
    {
        echo "m160417_144841_add_fields_in_post cannot be reverted.\n";

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
