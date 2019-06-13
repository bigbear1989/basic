<?php

namespace app\controllers;


use app\models\Registration;
use yii\web\Controller;
use Yii;

class RegistrationController extends Controller
{

    /** 
     * Форма регистрации
     * Либо регистрация, если выполняется POST-запрос
     */
    public function actionIndex()
    {
        $model = new Registration();
        return $this->render('index', ['model' => $model]);
    }

    public function actionSave()
    {
        $model = new Registration();
        $request = Yii::$app->request;
        if ($request->isPost) {
            $model->load($request->post(), 'Registration');
            if ($model->validate()) {
                return $this->render('success', ['model' => $model]);
            }
        }
        return $this->render('index', ['model' => $model]);
    }
}
