<?php

use yii\db\Migration;

class m171103_051556_query03 extends Migration
{
    public function safeUp()
    {
        $this->execute("ALTER TABLE `categories_master` ADD `sort_order` INT(11) NOT NULL AFTER `status`");
        $this->execute("ALTER TABLE `industries_master` ADD `sort_order` INT(11) NOT NULL AFTER `status`");
        $this->execute("ALTER TABLE `master_business_types` ADD `sort_order` INT(11) NOT NULL AFTER `status`");

    }

    public function safeDown()
    {
        echo "m171103_051556_query03 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171103_051556_query03 cannot be reverted.\n";

        return false;
    }
    */
}
