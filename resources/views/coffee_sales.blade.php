<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form
                        action="{{ route('coffee.sales.store') }}"
                        method="POST"
                        x-data="{
                            quantity: {{ old('quantity', 1) }},
                            unitCost: {{ old('unit_cost', 0) }},
                            sellingPrice() {
                                if (!this.unitCost) {
                                    return 'N/A'
                                }

                                const profitMargin = 0.25

                                const shippingCost = 1000

                                const cost = this.quantity * (this.unitCost * 100)

                                return '£' + Math.ceil((cost / (1 - profitMargin)) + shippingCost) / 100
                            },
                        }"
                    >
                        @csrf

                        <div>
                            <label for="quantity">Quantity</label>
                            <input class="mt-1" type="number" x-model="quantity" name="quantity" id="quantity" min="1" required>
                            @error('quantity')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-2">
                            <label for="unit_cost">Unit Cost (£)</label>
                            <input class="mt-1" type="number" x-model="unitCost" name="unit_cost" id="unit_cost" min="0" step=".01" required>
                            @error('unit_cost')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-2">
                            <label for="unit_cost">Selling Price</label>
                            <p x-text="sellingPrice()"></p>
                        </div>

                        <button type="submit" class="mt-2">Record Sale</button>
                    </form>

                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">Previous sales</h2>

                    <div class="relative overflow-x-auto mt-2">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Quantity
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Unit Cost
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Selling Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Sold at
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($sales as $sale)
                                    <tr class="bg-white border-b">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $sale->quantity }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $sale->formattedUnitCost() }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $sale->formattedSellingPrice() }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $sale->created_at->format('Y-m-d H:i') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No previous sales</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
