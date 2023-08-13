<?php

namespace app\controllers\api;

use app\form\CurrencyConversionForm;
use app\models\Currency;
use app\services\CurrencyConverterService;
use yii\helpers\Json;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;

class CurrencyConverterController extends Controller
{
    private CurrencyConverterService $converterService;

    public function __construct($id, $module, CurrencyConverterService $converterService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->converterService = $converterService;
    }

    public function actionConvert()
    {
        $model = new CurrencyConversionForm();

        $model->load(Json::decode(\Yii::$app->request->getRawBody()), '');
        if ($model->validate()) {
            $fromCurrency = strtoupper($model->fromCurrency);
            $toCurrencies = $model->toCurrencies;
            $amount = (float) $model->amount;

            $results = [];

            foreach ($toCurrencies as $toCurrency) {
                $toCurrency = strtoupper($toCurrency);
                $result = $this->converterService->convert($fromCurrency, $toCurrency, $amount);

                if ($result !== null) {
                    $results[$toCurrency] = $result;
                }
            }

            return $results;
        }
    }
}