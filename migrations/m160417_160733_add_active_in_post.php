<?php

use yii\db\Schema;
use yii\db\Migration;

class m160417_160733_add_active_in_post extends Migration
{
    public function up()
    {
        $this->addColumn('post', 'active', $this->smallInteger(1)->defaultValue(1));
    }

    public function down()
    {
        echo "m160417_160733_add_active_in_post cannot be reverted.\n";

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
