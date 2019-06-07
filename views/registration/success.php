<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Registration;
use yii\web\View;

/**
 * Форма регистрации
 * 
 * @var View $this
 * @var Registration $model
 */

echo Html::beginTag('div', ['class' => ['col-md-4 bordered']]);

echo Html::tag('h3', 'Регистрация выполнена успешно!');
echo Html::tag('p', "Email: " . $model->email);

# заменить все символы на '*'
echo Html::tag('p', "Пароль: " . preg_replace('/(.)/', '*', $model->password));
echo Html::tag('p', "Наименование организации: " . $model->organizationName);
echo Html::tag('p', "ИНН: " . $model->inn);
if (!empty($model->kpp)) {
    echo Html::tag('p', "КПП: " . $model->kpp);
}

echo Html::tag(
    'p',
    Html::a('На страницу регистрации', Url::to('/registration/index'))
);

echo Html::tag(
    'p',
    Html::a('На главную страницу', Url::home())
);

echo Html::endTag('div');
