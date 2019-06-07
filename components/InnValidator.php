<?php

namespace app\components;

use app\models\Registration;
use yii\validators\Validator;

class InnValidator extends Validator
{

    public function init()
    {
        parent::init();
//        $this->message = 'Некорректный ИНН';
    }

    public function validateAttribute($model, $attribute)
    {
        $inn = $model->$attribute;
        $result = false;
        $inn = (string)$inn;
        if (!$inn) {
            $error_message = 'ИНН пуст';
        } elseif (preg_match('/[^0-9]/', $inn)) {
            $error_message = 'ИНН может состоять только из цифр';
        } elseif (!in_array($inn_length = strlen($inn), [10, 12])) {
            $error_message = 'ИНН может состоять только из 10 или 12 цифр';
        } else {
            $check_digit = function ($inn, $coefficients) {
                $n = 0;
                foreach ($coefficients as $i => $k) {
                    $n += $k * (int)$inn{$i};
                }
                return $n % 11 % 10;
            };
            switch ($inn_length) {
                case 10:
                    $n10 = $check_digit($inn, [2, 4, 10, 3, 5, 9, 4, 6, 8]);
                    if ($n10 === (int)$inn{9}) {
                        $result = true;
                    }
                    break;
                case 12:
                    $n11 = $check_digit($inn, [7, 2, 4, 10, 3, 5, 9, 4, 6, 8]);
                    $n12 = $check_digit($inn, [3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8]);
                    if (($n11 === (int)$inn{10}) && ($n12 === (int)$inn{11})) {
                        $result = true;
                    }
                    break;
            }
            if (!$result) {
                $error_message = 'Неправильное контрольное число';
            }
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
let inn = value;
let message;
if (typeof inn === 'number') {
    inn = inn.toString();
} else if (typeof inn !== 'string') {
    inn = '';
}
if (!inn.length) {
    message = 'ИНН пуст';
} else if (/[^0-9]/.test(inn)) {
    message = 'ИНН может состоять только из цифр';
} else if ([10, 12].indexOf(inn.length) === -1) {
    message = 'ИНН может состоять только из 10 или 12 цифр';
} else {
    let checkDigit = function (inn, coefficients) {
        let n = 0;
        for (let i in coefficients) {
            n += coefficients[i] * inn[i];
        }
        return parseInt(n % 11 % 10);
    };
    switch (inn.length) {
        case 10:
            let n10 = checkDigit(inn, [2, 4, 10, 3, 5, 9, 4, 6, 8]);
            if (n10 === parseInt(inn[9])) {
                result = true;
            }
            break;
        case 12:
            let n11 = checkDigit(inn, [7, 2, 4, 10, 3, 5, 9, 4, 6, 8]);
            let n12 = checkDigit(inn, [3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8]);
            if ((n11 === parseInt(inn[10])) && (n12 === parseInt(inn[11]))) {
                result = true;
            }
            break;
    }
    if (!result) {
        message = 'Неправильное контрольное число';
    }
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