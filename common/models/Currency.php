<?php

namespace common\models;

use yii\helpers\Console;

class Currency extends db\BaseCurrency
{
    /**
     * @param string $name
     * @param $value
     * @throws \yii\base\Exception
     */
    public static function updateValue(string $name, $value)
    {
        $model = Currency::findOne(['name' => $name]);
        if (!$model) {
            $model = new Currency(['name' => $name]);
        }

        $model->value = $value;
        if (!$model->save()) {
            throw new \yii\base\Exception('Unable to update a currency. ' . Console::errorSummary($model));
        }
    }
}
