<?php

namespace console\controllers;

use common\models\Currency;
use common\models\GroupChatMessage;
use console\controllers\helpers\CurrencyHelper;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class CurrencyController extends Controller
{
    /**
     * @var mixed
     */
    private $chatMessage = 'Текущий курс: 1 USD = %s RUB';

    /**
     * @return int
     * @throws \yii\base\Exception
     * @throws \Throwable
     */
    public function actionUpdate()
    {
        $value = CurrencyHelper::parseCurrency('usd');
        if ($value === false) {
            return ExitCode::DATAERR;
        }
        Console::stdout('USD/RUB: ' . $value . PHP_EOL);
        Currency::updateValue('usd', $value);
        GroupChatMessage::post(null,
            sprintf($this->chatMessage, number_format(floatval($value), 2, '.', '')),
            null
        );

        return ExitCode::OK;
    }
}