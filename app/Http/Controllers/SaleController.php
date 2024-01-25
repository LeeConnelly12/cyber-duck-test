<?php

namespace App\Http\Controllers;

use App\Actions\CalculateCoffeePrice;
use App\Models\Product;
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
            'products' => Product::query()
                ->select('id', 'name', 'profit_margin')
                ->get(),
            'sales' => Sale::query()
                ->with('product:id,name')
                ->latest()
                ->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CalculateCoffeePrice $calculateCoffeePriceAction)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:100'],
            'unit_cost' => ['required', 'numeric', 'min:0', 'max:1000', 'decimal:0,2'],
        ]);

        $product = Product::find($request->product_id);

        Sale::query()->create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'unit_cost' => $request->unit_cost * 100,
            'selling_price' => $calculateCoffeePriceAction->execute(
                profitMargin: $product->profit_margin,
                quantity: $request->quantity,
                unitCost: $request->unit_cost * 100
            )
        ]);

        return back();
    }
}
