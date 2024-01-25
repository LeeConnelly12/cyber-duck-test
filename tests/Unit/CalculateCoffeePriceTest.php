<?php

namespace Tests\Unit;

use App\Actions\CalculateCoffeePrice;
use PHPUnit\Framework\TestCase;

class CalculateCoffeePriceTest extends TestCase
{
    /**
     * @dataProvider exampleCoffeePrices
     */
    public function test_it_calculates_coffee_prices_correctly(array $coffeePrices)
    {
        $sellingPrice = (new CalculateCoffeePrice)->execute(
            profitMargin: $coffeePrices['profitMargin'],
            quantity: $coffeePrices['quantity'],
            unitCost: $coffeePrices['unitCost']
        );

        $this->assertEquals($coffeePrices['expectedPrice'], $sellingPrice);
    }

    public static function exampleCoffeePrices(): array
    {
        return [
            [
                [
                    'profitMargin' => 0.25,
                    'quantity' => 1,
                    'unitCost' => 1000,
                    'expectedPrice' => 2334
                ],
            ],
            [
                [
                    'profitMargin' => 0.25,
                    'quantity' => 2,
                    'unitCost' => 2050,
                    'expectedPrice' => 6467
                ],
            ],
            [
                [
                    'profitMargin' => 0.25,
                    'quantity' => 5,
                    'unitCost' => 1200,
                    'expectedPrice' => 9000
                ],
            ],
            [
                [
                    'profitMargin' => 0.15,
                    'quantity' => 1,
                    'unitCost' => 1000,
                    'expectedPrice' => 2177
                ],
            ],
            [
                [
                    'profitMargin' => 0.15,
                    'quantity' => 2,
                    'unitCost' => 2050,
                    'expectedPrice' => 5824
                ],
            ],
            [
                [
                    'profitMargin' => 0.15,
                    'quantity' => 5,
                    'unitCost' => 1200,
                    'expectedPrice' => 8059
                ],
            ],
        ];
    }
}
