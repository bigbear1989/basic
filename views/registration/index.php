<?php

/**
 * @var $this \yii\web\View
 * @var $model \app\models\Registration
 */

use app\models\Registration;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Форма регистрации';

echo Html::beginTag('div', ['class' => ['row']]);
echo Html::beginTag('div', ['class' => ['col-md-6']]);

echo Html::tag('h3', 'Регистрация представителя организации');
echo Html::tag('hr');
echo Html::tag('i', '* Обязательно', ['class' => 'text-danger']);


$form = ActiveForm::begin([]);
echo Html::hiddenInput('action', Registration::C_ACTION_REGISTRATION);

echo $form->field($model, 'email')
    ->label('Электронная почта <i class="text-danger">*</i>');

echo $form->field($model, 'password')
    ->passwordInput()->label('Пароль <i class="text-danger">*</i>')
    ->hint('Пароль должен состоять из букв, цифр и должен содержать не менее одной строчной буквы');

echo $form->field($model, 'organizationName')
    ->label('Наименование организации <i class="text-danger">*</i>');

echo $form->field($model, 'inn')
    ->label('ИНН <i class="text-danger">*</i>')
    // валидные 10- и 12- значные ИНН
    ->hint('Напр. 1234567894, 526317984689');

echo $form->field($model, 'kpp')
    ->hint('Необходимо заполнить, если организация является ИП');

echo Html::tag('hr');
echo Html::submitButton('Зарегистрировать', ['class' => 'btn btn-primary']);

$form::end();

echo Html::endTag('div');
echo Html::endTag('div');
