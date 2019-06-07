<?php

namespace app\models;

//use app\components\InnValidator;
use app\components\InnValidator;
use app\components\KppValidator;
use yii\base\Model;

class Registration extends Model
{
    const C_ACTION_REGISTRATION = 'C_ACTION_REGISTRATION';

    public $email;
    public $password;
    public $organizationName;
    public $inn;
    public $isIp = false;
    public $kpp = false;

    public function rules()
    {
        return [
            [['email', 'password', 'organizationName', 'inn'], 'required'],
            ['email', 'email'],
            ['password', 'match', 'pattern' => '/^(?=.*[a-zа-яё]+)[A-Za-zА-Яа-яЁё0-9]+$/',
                'message' => 'Пароль не соответствует формату, указанному в подсказке'],
            ['inn', InnValidator::class],
            ['kpp', 'required', 'when' => function ($model) {
                return strlen($model->inn) == 12;
            }, 'whenClient' => "
                    function (attribute, value) {
                        return $('#registration-inn').val().length == 12;
                    }
            ", 'message' => 'Необходимо заполнить для ИП'],
            ['kpp', KppValidator::class],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Электронная почта',
            'password' => 'Пароль',
            'organizationName' => 'Наименование организации',
            'inn' => 'ИНН',
            'kpp' => 'КПП',
        ];
    }
}