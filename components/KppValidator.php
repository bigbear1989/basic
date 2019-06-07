<?php
/**
 * Created by PhpStorm.
 * User: medvedev.a
 * Date: 07.06.2019
 * Time: 13:35
 */

namespace app\components;


use yii\validators\Validator;


class KppValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        $kpp = $model->$attribute;
        $result = false;
        $kpp = (string)$kpp;
        if (!$kpp) {
            $error_message = 'КПП пуст';
        } elseif (strlen($kpp) !== 9) {
            $error_message = 'КПП может состоять только из 9 знаков (цифр или заглавных букв латинского алфавита от A до Z)';
        } elseif (!preg_match('/^[0-9]{4}[0-9A-Z]{2}[0-9]{3}$/', $kpp)) {
            $error_message = 'Неправильный формат КПП';
        } else {
            $result = true;
        }
        if (!$result) {
            $model->addError($error_message);
            return false;
        } else {
            return true;
        }

    }

    public function clientValidateAttribute($model, $attribute, $view)
    {

        return <<<JS
        let result = false;
        let kpp = value;
        let message;
        if (typeof kpp === 'number') {
            kpp = kpp.toString();
        } else if (typeof kpp !== 'string') {
            kpp = '';
        }
        if (!kpp.length) {
            return true;
            // message = 'КПП пуст';
        } else if (kpp.length !== 9) {
            message = 'КПП может состоять только из 9 знаков (цифр или заглавных букв латинского алфавита от A до Z)';
        } else if (!/^[0-9]{4}[0-9A-Z]{2}[0-9]{3}$/.test(kpp)) {
            message = 'Неправильный формат КПП';
        } else {
            result = true;
        }
        if (!result) {
            messages.push(message);
            return false;
        } else {
            return true
        }
JS;


    }

}