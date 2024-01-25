<?php

namespace App\Http\Controllers;

use App\Actions\CalculateCoffeePrice;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('coffee_sales', [
            'sales' => Sale::query()
                ->select('quantity', 'unit_cost', 'selling_price')
                ->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CalculateCoffeePrice $calculateCoffeePriceAction)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:100'],
            'unit_cost' => ['required', 'numeric', 'min:0', 'max:1000', 'decimal:0,2'],
        ]);

        Sale::query()->create([
            'quantity' => $request->quantity,
            'unit_cost' => $request->unit_cost,
            'selling_price' => $calculateCoffeePriceAction->execute(
                quantity: $request->quantity,
                unitCost: $request->unit_cost * 100
            )
        ]);

        return back();
    }
}
