<?php


namespace common\components;


use common\models\Currency;
use common\models\GroupChatMessage;

class ChatBot
{
    private $commands = [
        'dollar' => 'answerDollar',
    ];

    /**
     * @param string $message
     * @param $groupId
     * @throws \Throwable
     */
    public function parseMessage(string $message, $groupId)
    {
        if ($command = @$this->commands[$message]) {
            if ($answer = $this->$command()) {
                GroupChatMessage::post($groupId, $answer, null);
            }
        }
    }

    private $answerDollarTemplate = 'Текущий курс: 1 USD = %s RUB';

    private function answerDollar()
    {
        if ($currency = Currency::findOne(['name' => 'usd'])) {
            return sprintf($this->answerDollarTemplate, number_format(floatval($currency->value), 2, '.', ''));
        }
    }
}
