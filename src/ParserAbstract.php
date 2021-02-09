<?php declare(strict_types=1);

namespace MaxCurrency;

require_once __DIR__ . '/../vendor/autoload.php';

use MaxCurrency\Entity\Currency;
use MaxCurrency\Entity\CurrencyData;

/**
 * Parser model
 *
 * @author Konstantin Shtykov <konstantine.shtikov@yandex.ru>
 */
abstract class ParserAbstract
{
    const API_URL = 'https://www.cbr-xml-daily.ru/daily_json.js';

    public function getCurrencyData(string $currency): Currency
    {
        /** @var CurrencyData */
        $currencyData = $this->request();
        return $currencyData->getValute($currency);
    }

    abstract protected function request(): CurrencyData;
}
