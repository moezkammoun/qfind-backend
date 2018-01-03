<?php

use yii\db\Migration;

class m171101_083357_basic extends Migration {

        public function safeUp() {
                $this->execute("CREATE TABLE `users` (
                                `id` int(11) NOT NULL AUTO_INCREMENT,
                                `first_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
                                `last_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
                                `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
                                `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                                `username` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
                                `mobile` int(20) NOT NULL,
                                `status` int(4) NOT NULL,
                                `auth_key` varchar(254) COLLATE utf8_unicode_ci DEFAULT NULL,
                                `password_reset_token` varchar(254) COLLATE utf8_unicode_ci DEFAULT NULL,
                                `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                `role` int(5) NOT NULL,
                                `last_login` timestamp NULL DEFAULT NULL,
                                PRIMARY KEY (`id`)
                               ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

                $this->execute("CREATE TABLE `sellers` (
                                `id` int(11) NOT NULL AUTO_INCREMENT,
                                `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
                                `email_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
                                `phone` int(15) NOT NULL,
                                `address` text COLLATE utf8_unicode_ci,
                                `zip` int(10) DEFAULT NULL,
                                `country` int(10) DEFAULT NULL,
                                `state` int(10) DEFAULT NULL,
                                `city` int(10) DEFAULT NULL,
                                `contact_person` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
                                `registration_certificate` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
                                `digital_certificate` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
                                `logo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
                                PRIMARY KEY (`id`),
                                KEY `city` (`city`),
                                KEY `state` (`state`),
                                KEY `country` (`country`),
                                CONSTRAINT `sellers_ibfk_1` FOREIGN KEY (`country`) REFERENCES `countries` (`id`),
                                CONSTRAINT `sellers_ibfk_2` FOREIGN KEY (`state`) REFERENCES `states` (`id`),
                                CONSTRAINT `sellers_ibfk_3` FOREIGN KEY (`city`) REFERENCES `cities` (`id`)
                               ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

                $this->execute("CREATE TABLE `countries` (
                                `id` int(11) NOT NULL AUTO_INCREMENT,
                                `sortname` varchar(3) NOT NULL,
                                `name` varchar(150) NOT NULL,
                                `phonecode` int(11) NOT NULL,
                                PRIMARY KEY (`id`)
                               ) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8");

                $this->execute("CREATE TABLE `cities` (
                                `id` int(11) NOT NULL AUTO_INCREMENT,
                                `name` varchar(30) NOT NULL,
                                `state_id` int(11) NOT NULL,
                                PRIMARY KEY (`id`)
                               ) ENGINE=InnoDB AUTO_INCREMENT=48315 DEFAULT CHARSET=latin1");

                $this->execute("CREATE TABLE `admin_roles` (
                                `id` int(11) NOT NULL AUTO_INCREMENT,
                                `role_name` varchar(150) NOT NULL,
                                `cb` int(11) DEFAULT NULL,
                                `ub` int(11) DEFAULT NULL,
                                `doc` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                                `dou` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                                PRIMARY KEY (`id`)
                               ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
        }

        public function safeDown() {
                echo "m171101_083357_basic cannot be reverted.\n";

                return false;
        }

        /*
          // Use up()/down() to run migration code without a transaction.
          public function up()
          {

          }

          public function down()
          {
          echo "m171101_083357_basic cannot be reverted.\n";

          return false;
          }
         */
}
