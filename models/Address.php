<?php

namespace app\models;

use Yii;
use app\models\Items;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $shop_city
 * @property string $shop_street
 * @property string $shop_house_number
 * @property string $client_city
 * @property string $client_street
 * @property string $client_house_number
 * @property string $price
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const NUMBER_SHOP = '0';
    const NUMBER_CLIENT = '1';

    protected $address_type;
    protected $items;

    /**
     * Устанавливает правила для сцераниев выборки типа доставки
     * @return array сценария
     */
    public function scenarios()
    {

        $scenarios = parent::scenarios();
        $scenarios['shop'] = ['shop_city', 'shop_street', 'shop_house_number', 'items'];
        $scenarios['home'] = ['client_city', 'client_street', 'client_house_number', 'items'];
        return $scenarios;

    }

    public static function tableName()
    {
        return 'address';
    }


    public function rules()
    {
        return [
            [['shop_city', 'shop_street', 'shop_house_number', 'items'], 'required'],
            [['client_city', 'client_street', 'client_house_number', 'items'], 'required'],


        ];
    }

    /**
     * Устанавливает тип тип адресса доставки 0 или 1
     * @param $type
     */

    public function setAddress_type($type)
    {
        $this->address_type = $type;
    }

    /**
     * Устанавливает id-шники товаров
     * @param $itemId
     */
    public function setItems($itemId)
    {
        $this->items = (array)$itemId;
    }


    /**
     * Возвращает массив с типами доставки
     * @return array
     */
    public function getAddress_type()
    {
        return [self::NUMBER_SHOP => 'Shop', self::NUMBER_CLIENT => 'Home'];
    }

    /**
     * Возвращает товары
     * @return mixed
     */

    public function getItems()
    {
        return $this->items;
    }

    /**
     * Устанавливает общую цену перед валидацией
     * @return bool
     */
    public function beforeValidate()
    {

        if ($this->items) {

            foreach ($this->items as $item) {
                $array_item[] = (int)$item;
            }
            $string_array = implode(',', $array_item);
            $prices = Items::find()
                ->where("id IN ($string_array) ")
                ->all();

            $price = 0;
            for ($i = 0; $i < count($prices); $i++) {
                $price += $prices[$i]->price;
            }
            $this->price = $price;
        }
        return parent::beforeValidate();
    }


    /**
     * Установить текстовые значение для элемента label на форме
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shop_city' => 'Город магазин',
            'shop_street' => 'Улица магазин',
            'shop_house_number' => 'Номер дома магазин',
            'client_city' => 'Город заказчика',
            'client_street' => 'Улица заказчика',
            'client_house_number' => 'Номер дома заказчика',
            'price' => 'Цена',
            'items' => 'Товары',
            'address_type' => 'Тип доставки'
        ];
    }

    /**
     * Возвращаем объект класса SavedItems и  устанавливаем связь hasMany для нахождение id-шников товаров
     * по параметру address_id из таблицы saved_items
     * @return \yii\db\ActiveQuery
     */
    public function getSavedItems()
    {
        return $this->hasMany(SavedItems::className(), ['address_id' => 'id']);
    }
}
