<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Address;
use app\models\SavedItems;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\filters\FilterAjax;


class AjaxController extends Controller
{

    /**
     * подключает фильтр для ajax-запросов
     */
    public function behaviors()
    {
        return [
            [
                'class' => FilterAjax::className(),
            ]
        ];
    }

    /**
     * Валидатор POST-запросов
     * Подключает необходимый сценарий для выборки типа доставки
     * Осуществляет проверку на валидность данных
     * В случае успешной валидации сохраняет в таблицу SavedItems id-адресса и id-товара
     * @return mixed
     */

    public function actionValidateAddress()
    {

        $model = new Address();

        if ($model->load(Yii::$app->request->post())) {

            if (!Yii::$app->request->post()['Address']['address_type']) {
                $model->scenario = 'shop';
            } else {
                $model->scenario = 'home';
            }


            Yii::$app->response->format = Response::FORMAT_JSON;
            $validate = ActiveForm::validate($model);

            if (!empty($validate)) return $validate;


            $model->save();
            $saved_items = new SavedItems();
            $result = $saved_items->saveItems($model->id, $model->items);
            if($result){
                return $this->redirect('/admin/index');
            }


        }
    }
}