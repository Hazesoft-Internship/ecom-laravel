    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="max-w-md mx-auto p-6 bg-white shadow-md rounded-lg">
    <!-- Headline -->
    <h2 class="text-2xl font-bold text-center mb-6">Edit Cart Item</h2>

    <form method="POST" action="{{ route('cart.update', $cartItem->id) }}">
        @csrf
        @method('POST')

        <!-- Product (Read-Only) -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Product</label>
            <input type="text" value="{{ $cartItem->product->name }}" class="w-full p-2 border border-gray-300 bg-gray-100 rounded" disabled>
        </div>

        <!-- Quantity -->
        <div class="mb-4">
            <label for="quantity" class="block text-gray-700 font-medium mb-1">Quantity</label>
            <input type="number" id="quantity" name="quantity" min="1"
                   class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ old('quantity', $cartItem->quantity) }}" required>
            @error('quantity')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-300">
            Update Cart
        </button>
    </form>
</div>
