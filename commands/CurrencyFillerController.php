<?php

namespace app\commands;

use yii\console\Controller;
use app\services\CurrencyService;

class CurrencyFillerController extends Controller
{
    public function actionIndex($startDate = 'now', $endDate = 'now')
    {
        $currentDate = new \DateTimeImmutable($startDate);
        $endDateTimestamp = new \DateTimeImmutable($endDate);

        $currencyService = new CurrencyService();

        while ($currentDate <= $endDateTimestamp) {
            $date = $currentDate->format('d/m/Y');
            echo "Updating exchange rates for $date...\n";
            $currencyService->updateExchangeRatesForDates([$currentDate]);

            $currentDate = $currentDate->modify('+1 day');
        }

        echo "Exchange rates update completed.\n";
    }
}
