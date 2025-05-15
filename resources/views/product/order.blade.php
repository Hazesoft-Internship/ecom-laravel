{{-- <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius --> --}}
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">


<div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center mb-6">Place Your Order</h2>

    <form method="POST" action="{{ route("order")}}">
        @csrf

        <div class="mb-4">
            <label for="address" class="block text-gray-700 font-medium mb-1">Shipping Address</label>
            <textarea id="address" name="address" rows="3"
                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>{{ old('address') }}</textarea>
            @error('address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

       <div class="mb-4">
    <label for="payment_method" class="block text-gray-700 font-medium mb-1">Payment Method</label>
    <select id="payment_method" name="payment_method"
        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
        required>
        <option value="">-- Select Payment Method --</option>

        @foreach($paymentmethods as $method)
            <option value="{{ $method }}" {{ old('payment_method') == $method ? 'selected' : '' }}>
                {{ $method }}
            </option>
        @endforeach
    </select>
    @error('payment_method')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>



        <div class="max-w-7xl mx-auto px-4 py-8">
            <h2 class="text-3xl font-bold text-center mb-6">Items</h2>

            <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                <table class="min-w-full text-sm text-left text-gray-700">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Description</th>
                            <th class="px-6 py-3">Quantity</th>
                            <th class="px-6 py-3">Type</th>
                            <th class="px-6 py-3">Price (Rs)</th>
                            <th class="px-6 py-3">Subtotal (Rs)</th>
                        </tr>

                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($orderItems as $orderitem)
                            <tr>
                                <td class="px-6 py-4">{{ $orderitem['product']->name }}</td>
                                <td class="px-6 py-4">{{ $orderitem['product']->description }}</td>
                                <td class="px-6 py-4">{{ $orderitem['quantity'] }}</td>
                                <td class="px-6 py-4">{{ $orderitem['product']->types }}</td>
                                <td class="px-6 py-4 font-semibold">{{ $orderitem['product']->price }}</td>
                                <td class="px-6 py-4 font-semibold">{{ $orderitem['product']->price * $orderitem['quantity']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                                      
                    <tr >
                        <td colspan="5" class="px-6 py-3 text-right font-semibold">Total (Rs)</td>
                        <td class="px-6 py-3 font-semibold">{{ $totalprice }}</td>
                    </tr>

                </table>
            </div>
        </div>
        <button type="submit"
            class="w-full bg-green-600 text-white py-3 rounded-md hover:bg-green-700 transition duration-300">
            Place Order
        </button>
    </form>
</div>