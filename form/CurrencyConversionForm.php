<?php

namespace app\form;

use yii\base\Model;

class CurrencyConversionForm extends Model
{
    public $fromCurrency;
    public $toCurrencies;
    public $amount;

    public function rules()
    {
        return [
            [['fromCurrency', 'toCurrencies', 'amount'], 'required'],
            ['toCurrencies', 'each', 'rule' => ['string']],
            ['amount', 'number'],
        ];
    }
}
