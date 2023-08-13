<?php

namespace app\services;

use app\models\Currency;

class CurrencyConverterService
{
    public function convert($fromCurrency, $toCurrency, float $amount): array
    {
        $fromCurrencyRate = Currency::find()->select('rate')->where(['code' => $fromCurrency])->orderBy('date DESC')->scalar();
        $toCurrencyRate = Currency::find()->select('rate')->where(['code' => $toCurrency])->orderBy('date DESC')->scalar();

        if ($fromCurrencyRate === null || $toCurrencyRate === null) {
            return [];
        }

        if ($amount == 0) {
            $conversionRate = 0;
        } else {
            $conversionRate = $fromCurrencyRate / $toCurrencyRate;
        }
        $convertedAmount = $amount * $conversionRate;

        return [
            'from_currency' => $fromCurrency,
            'to_currency' => $toCurrency,
            'amount' => round($amount, 4),
            'converted_amount' => round($convertedAmount, 4),
        ];
    }
}
