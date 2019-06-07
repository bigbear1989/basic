<?php

/**
 * @var $this \yii\web\View
 */

use yii\helpers\Html;
use yii\helpers\Url;

echo Html::beginTag('div', ['class' => ['col-md-4 bordered']]);

echo Html::tag('h3', 'Регистрация выполнена успешно!');
echo Html::a('На страницу регистрации', Url::to('/registration/index'));

echo Html::endTag('div');