<?php

use yii\db\Migration;

class m171101_091916_category extends Migration
{
    public function safeUp()
    {
    $this->execute("ALTER TABLE `master_business_types` CHANGE `status` `status` TINYINT NOT NULL");
    $this->execute("ALTER TABLE `industries_master` CHANGE `category_id` `parent_id` INT(11) NOT NULL");
    $this->execute("ALTER TABLE `industries_master` ADD `image` VARCHAR(250) NOT NULL AFTER `parent_id`");
    $this->execute("ALTER TABLE `master_business_types` CHANGE `category_id` `parent_id` INT(11) NOT NULL");   
    $this->execute("ALTER TABLE `master_business_types` ADD `image` VARCHAR(250) NOT NULL AFTER `parent_id`");   
    $this->execute("ALTER TABLE `categories_master` CHANGE `category_id` `parent_id` INT(11) NOT NULL");   
    $this->execute("ALTER TABLE `categories_master` ADD `image` VARCHAR(250) NOT NULL AFTER `parent_id`");   
    
    }

    public function safeDown()
    {
        echo "m171101_091916_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171101_091916_category cannot be reverted.\n";

        return false;
    }
    */
}
