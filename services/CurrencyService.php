<?php

namespace app\services;

use yii\base\Component;
use yii\httpclient\Client;
use app\models\Currency;

class CurrencyService extends Component
{
    public function updateExchangeRatesForDates($dates)
    {
        $client = new Client();

        /** @var \DateTimeImmutable $date */
        foreach ($dates as $date) {
            try {
                $url = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=" . $date->format('d/m/Y');

                $response = $client->createRequest()
                    ->setMethod('GET')
                    ->setUrl($url)
                    ->send();

            } catch (\Throwable $throwable) {
                continue;
            }
            if ($response->isOk) {
                $xmlData = $response->content;
                $xml = simplexml_load_string($xmlData);

                foreach ($xml->Valute as $valute) {
                    $currencyCode = (string)$valute->CharCode;
                    $rate = (float)str_replace(',', '.', $valute->Value);

                    $currency = Currency::findOne(['code' => $currencyCode, 'date' => $date->format('Y-m-d')]);
                    if (!$currency) {
                        $currency = new Currency();
                        $currency->code = $currencyCode;
                        $currency->date = $date->format('Y-m-d');
                    }

                    $currency->rate = $rate;
                    $currency->save();
                }
            }
            $currency = Currency::findOne(['code' => 'RUB', 'date' => $date->format('Y-m-d')]);

            if (!$currency) {
                $currency = new Currency();
                $currency->code = 'RUB';
                $currency->date = $date->format('Y-m-d');
            }
            $currency->rate = 1.0;
            $currency->save();
        }
    }
}
