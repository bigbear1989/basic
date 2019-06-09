<?php

namespace app\models;

use app\components\InnValidator;
use app\components\KppValidator;
use yii\base\Model;

class Registration extends Model
{

    const C_ACTION_REGISTRATION = 'C_ACTION_REGISTRATION';

    /**
     * Электронная почта
     *
     * @var string
     */
    public $email;

    /** 
     * Пароль
     * 
     * @var string
     */
    public $password;

    /**
     *  Наименование организации
     * 
     * @var string
     */
    public $organizationName;

    /** 
     * ИНН
     * ФЛ (ИП) - 12 символов
     * ЮЛ - 10 символов
     * 
     * @var int
     */
    public $inn;

    /** 
     * КПП
     * 
     * @var string
     */
    public $kpp = false;

    public function rules()
    {
        return [
            [['email', 'password', 'organizationName', 'inn'], 'required'],
            ['email', 'email'],
            [
                'password', 'match', 'pattern' => '/^(?=.*[a-zа-яё]+)[A-Za-zА-Яа-яЁё0-9]+$/',
                'message' => ''
            ],
            ['inn', InnValidator::class],

            // обязательно, если кол-во символов ИНН = 12 (ИП)
            ['kpp', 'required', 'when' => function ($model) {
                return strlen($model->inn) == 12;
            }, 'whenClient' => "
                    function (attribute, value) {
                        return $('#registration-inn').val().length == 12;
                    }
            ", 'message' => ''],
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
