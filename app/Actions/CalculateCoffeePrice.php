<?php

namespace App\Actions;

class CalculateCoffeePrice
{
    const SHIPPING_COST = 1000;

    public function execute(float $profitMargin, int $quantity, int $unitCost): int
    {
        $cost = $quantity * $unitCost;

        return ceil($cost / (1 - $profitMargin)) + self::SHIPPING_COST;
    }
}