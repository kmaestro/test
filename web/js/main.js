
$(document).ready(function() {
    $('.numberInput').inputmask('numeric', {
        alias: 'decimal',
        allowMinus: false,
        digits: 4,
        rightAlign: false,
        onBeforeMask: function (value, opts) {
            return value === '' ? '0' : value;
        }
    });

    $('.xxx-input-converter input').on('input', function () {
        let amount = $(this).val();
        if (amount === '') {
            amount = 0;
        }
        let fromCurrency = $(this).data('code');
        let toCurrencies = [];
        $('.xxx-input-converter input').each(function () {
            toCurrencies.push($(this).data('code'));
        });
        data = {
            fromCurrency: fromCurrency,
            toCurrencies: toCurrencies,
            amount: Number.parseFloat(amount)
        };
        $.post('/api/currency-converter/convert', JSON.stringify(data), function (result) {
            for (let i in result) {
                if (result[i].to_currency !== result[i].from_currency) {
                    $('.xxx-input-converter input[data-code=' + i + ']').val(result[i].converted_amount);
                }
            }
        }, 'json');
    })
})