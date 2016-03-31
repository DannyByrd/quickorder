<?php

namespace app\controllers;

use Yii;
use app\models\Items;
use app\models\Address;
use app\models\SavedItems;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class AdminController extends Controller
{

    /**
     * Получает список всех заказов
     * @return mixed
     */
    function actionIndex()
    {
        $model = Address::find()->all();
        return $this->render('index', ['model' => $model]);
    }


}