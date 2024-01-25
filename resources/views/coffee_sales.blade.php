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
                            quantity: 1,
                            unitCost: 0,
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
                            <input class="mt-1" type="number" x-model="quantity" name="quantity" id="quantity" min="1">
                            @error('quantity')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-2">
                            <label for="unit_cost">Unit Cost (£)</label>
                            <input class="mt-1" type="number" x-model="unitCost" name="unit_cost" id="unit_cost" min="0">
                            @error('unit_cost')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-2">
                            <label for="unit_cost">Selling Price</label>
                            <p x-text="sellingPrice()"></p>
                            @error('unit_cost')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="mt-2">Record Sale</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
