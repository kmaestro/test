<div class="xxx-currency-grid__block xxx-currency-grid__block--separately ">
    <div class="xxx-line-h-1 xxx-mb-15">
        <a
                class="xxx-text-bold xxx-fs-18 xxx-g-link xxx-g-link--no-bd">Конвертер валют
            ЦБ РФ</a>
    </div>
    <div class="xxx-tab-list-wrap xxx-tab-list-wrap--pt-0 xxx-tab-list-wrap--only-border-light xxx-mb-15">
        <ul class="xxx-tab__list xxx-tab__list--fix-scrollbar xxx-tab__list--overflow-auto">
            <li class="xxx-tab__item xxx-tab__item--p-b-5 active" data-tab="today"><span
                        class="xxx-fs-14"> Сегодня </span></li>
        </ul>
    </div>
    <div class="xxx-tab__content">
        <div class="xxx-tab__body active" id="today">
            <div class="blk-grid-content blk-grid-content--gap-10 ">
                <?php foreach (['RUB', 'USD', 'EUR', 'CNY', 'BYN'] as $v): ?>
                    <div class="xxx-input-converter ">
                        <input value="0" data-code="<?= $v ?>"
                               data-cur-multiplier="1" type="tel" inputmode="decimal"
                               class="xxx-input-converter__input xxx-full-width numberInput"><span
                                class="xxx-input-converter__before-text"> <?= $v ?> </span><span
                                class="xxx-input-converter__close" data-input-converter-clear=""><i
                                    class="ic-close_icon"></i></span><img class="xxx-input-converter__img"
                                                                          src="/flags/<?= $v?>.png"
                                                                          alt="<?= $v?>-icon"></div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>