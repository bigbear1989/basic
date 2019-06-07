<?php
/**
 * Created by PhpStorm.
 * User: medvedev.a
 * Date: 06.06.2019
 * Time: 15:14
 */

namespace app\controllers;


use app\models\Registration;
use yii\web\Controller;

class RegistrationController extends Controller
{

    public function actionIndex()
    {
        $request = \Yii::$app->request;
        $model = new Registration();
        if ($request->isPost && $request->post('action') == Registration::C_ACTION_REGISTRATION) {
            $model->load($request->post(), 'Registration');
            if ($model->validate()) {
                return $this->render('success');
            }
        }
        return $this->render('index', ['model' => $model]);
    }


}