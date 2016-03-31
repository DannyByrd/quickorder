<?php

use yii\db\Migration;

class m160311_193411_address extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%address}}', [
            'id' => $this->primaryKey(),
            'shop_city' => $this->string(128),
            'shop_street' => $this->string(128),
            'shop_house_number' => $this->string(20),
            'client_city' => $this->string(128),
            'client_street' => $this->string(128),
            'client_house_number' => $this->string(20),
            'price' => $this->decimal(9,2)->notNull(), // Общая сумма заказа
         ],$tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%address}}');
        
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
