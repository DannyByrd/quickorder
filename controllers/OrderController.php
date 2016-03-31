<?php

namespace app\controllers;

use Yii;
use app\models\Items;
use app\models\Address;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class OrderController extends Controller
{

    /**
     * Получает и именует, для dropDownList, все товары из базы данных
     * Передает во view модель Address для оформление заказа
     * @return mixed
     */
    public function actionIndex()
    {


        $full_items = [];
        foreach (Items::find()->asArray()->all() as $key) {

            $full_items[] = ["id" => $key['id'], 'name' => $key['name'], 'price' => $key['price'],
                             "name-price" => $key['name'] . ' ' . $key['price']];
        }
        $address = new Address();
        return $this->render('index', ['items' => $full_items, 'address' => $address]);
    }


}