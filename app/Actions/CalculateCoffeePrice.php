<?php

namespace App\Actions;

class CalculateCoffeePrice
{
    const PROFIT_MARGIN = 0.25;

    const SHIPPING_COST = 1000;

    public function execute(int $quantity, int $unitCost): int
    {
        $cost = $quantity * $unitCost;

        return ceil($cost / (1 - self::PROFIT_MARGIN)) + self::SHIPPING_COST;
    }
}