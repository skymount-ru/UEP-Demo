<?php


namespace console\controllers\helpers;


class CurrencyHelper
{
    const CURRENCY_URL = 'http://www.xe.com/currencytables/?from=USD';
    const USD_PATTERN = '/Russian Ruble\<\/td\>\<td class=\"historicalRateTable-rateHeader\"\>([\d.]+)\<\/td/';

    public static function parseCurrency(string $string)
    {
        $content = file_get_contents(static::CURRENCY_URL);
        if (preg_match(static::USD_PATTERN, $content, $matches)) {
            return $matches[1];
        }

        return false;
    }
}