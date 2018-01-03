<?php

use yii\db\Migration;

class m171101_090015_category extends Migration
{
    public function safeUp()
    {
        $this->execute("SELECT * FROM `master_business_types`");
      
        $this->execute($sql);

    }

    public function safeDown()
    {
        echo "m171101_090015_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171101_090015_category cannot be reverted.\n";

        return false;
    }
    */
}
