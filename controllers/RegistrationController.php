<?php

namespace app\controllers;


use app\models\Registration;
use yii\web\Controller;

class RegistrationController extends Controller
{

    /**
     * @var $model 
     */
    public function actionIndex()
    {
        $request = \Yii::$app->request;
        $model = new Registration();
        if ($request->isPost && $request->post('action') == Registration::C_ACTION_REGISTRATION) {
            $model->load($request->post(), 'Registration');
            if ($model->validate()) {
                return $this->render('success', ['model' => $model]);
            }
        }
        return $this->render('index', ['model' => $model]);
    }
}
