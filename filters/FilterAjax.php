<?php

namespace app\filters;

use Yii;
use yii\base\ActionFilter;
use yii\web\HttpException;

class FilterAjax extends ActionFilter
{

    /**
     * Проверяет является ли запрос ajax
     * @param \yii\base\Action $action
     * @return bool
     * @throws HttpException
     */
    public function beforeAction($action)
    {


        if (!Yii::$app->request->isAjax) {
            throw new  HttpException(500, 'Bad request');
            return false;
        }

        return parent::beforeAction($action);

    }


    public function afterAction($action, $result)
    {
        return parent::afterAction($action, $result);
    }


}