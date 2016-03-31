<?php

use yii\db\Migration;

class m160313_101824_saved_items extends Migration
{
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
          $this->createTable('{{%saved_items}}', [
            'id' => $this->primaryKey(),
            'address_id' => $this->integer(11)->notNull(),
            'item_id' => $this->integer(11)->notNull(),
           
         ],$tableOptions);

        $this->createIndex('FK_address', '{{%saved_items}}', 'address_id');
        $this->addForeignKey(
            'FK_saved_address', '{{%saved_items}}','address_id','{{%address}}','id'
        );

        $this->createIndex('FK_items', '{{%saved_items}}', 'item_id');
        $this->addForeignKey(
            'FK_saved_items', '{{%saved_items}}','item_id','{{%items}}','id'
        );



    }

    public function down()
    {
         $this->dropTable('{{%saved_items}}');

       
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
