<?php
use Brick\Money\Money;
use Brick\Money\Formatter\IntlMoneyFormatter;
use NumberFormatter;

if (!function_exists('format_money')) {
    function format_money(Money $money, string $locale = 'fr_BE'): string
    {
        $numberFormatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);

        $moneyFormatter = new IntlMoneyFormatter($numberFormatter);

        return $moneyFormatter->format($money);
    }
}
