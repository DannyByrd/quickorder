<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "saved_items".
 *
 * @property integer $id
 * @property integer $address_id
 * @property integer $item_id
 *
 * @property Address $address
 * @property Items $item
 */
class SavedItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'saved_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address_id', 'item_id'], 'required'],
            [['address_id', 'item_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address_id' => 'Address ID',
            'item_id' => 'Item ID',
        ];
    }

    /**
     * Сохраняет в таблицу saved_items id адрессов и товаров
     * @param $address_id
     * @param $items
     * @return bool
     * @throws \yii\db\Exception
     */

    public function saveItems($address_id,$items){

        foreach ($items as $key => $item) {
                $batch[] = [$address_id,$item];
        }
        Yii::$app->db->createCommand()
                     ->batchInsert('saved_items',['address_id','item_id'],$batch)
                     ->execute();
        return true;
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }

   
}
