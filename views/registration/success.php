<?php

/**
 * @var $this \yii\web\View
 * @var $model \app\models\Registration
 */

use yii\helpers\Html;
use yii\helpers\Url;

echo Html::beginTag('div', ['class' => ['col-md-4 bordered']]);

echo Html::tag('h3', 'Регистрация выполнена успешно!');
echo Html::tag('p', "Email: {$model->email}");
echo Html::tag('p', "Пароль: " . preg_replace('/(.)/', '*', $model->password));
echo Html::tag('p', "Наименование организации: " . $model->organizationName);
echo Html::tag('p', "ИНН: " . $model->inn);
if (!empty($model->kpp)) {
    echo Html::tag('p', "КПП: " . $model->kpp);
}
echo Html::a('На страницу регистрации', Url::to('/registration/index'));

echo Html::endTag('div');