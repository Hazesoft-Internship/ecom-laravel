@if($errors->any())
    <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-container max-w-lg mx-auto p-6 bg-white shadow-lg rounded-lg">
    <!-- Headline: Create or Update -->
    <h2 class="text-2xl font-semibold text-center mb-6">
        {{ isset($product->id) ? 'Update Product' : 'Create New Product' }}
    </h2>

    <form method="POST" action="{{ isset($product->id) ? route('product.update') : route('product.store')  }}">
        @csrf
        <!-- Product ID hidden field for edit -->
        @if(isset($product->id))
            <input type="hidden" name="product_id" value="{{ $product->id }}">
        @endif

        <!-- Product Name -->
        <div class="form-group flex flex-col mb-4">
            <label for="name" class="text-gray-700 font-medium">Product Name:</label>
            <input type="text" id="name" name="name" class="form-control p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('name', $product->name ?? '') }}" required>
            @error('name')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Description -->
        <div class="form-group flex flex-col mb-4">
            <label for="description" class="text-gray-700 font-medium">Description:</label>
            <textarea id="description" name="description" class="form-control p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" required>{{ old('description', $product->description ?? '') }}</textarea>
            @error('description')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Price -->
        <div class="form-group flex flex-col mb-4">
            <label for="price" class="text-gray-700 font-medium">Price:</label>
            <input type="number" id="price" name="price" class="form-control p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('price', $product->price ?? '') }}" required step="0.01">
            @error('price')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Quantity -->
        <div class="form-group flex flex-col mb-4">
            <label for="quantity" class="text-gray-700 font-medium">Quantity:</label>
            <input type="number" id="quantity" name="quantity" class="form-control p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('quantity', $product->quantity ?? '') }}" required>
            @error('quantity')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Product Type -->
        <div class="form-group flex flex-col mb-4">
            <label for="types" class="text-gray-700 font-medium">Product Type:</label>
            <select id="types" name="types" class="form-control p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="physical" {{ old('types', $product->types ?? '') == 'physical' ? 'selected' : '' }}>Physical</option>
                <option value="digital" {{ old('types', $product->types ?? '') == 'digital' ? 'selected' : '' }}>Digital</option>
            </select>
            @error('types')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="form-group mb-4">
            <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-md hover:bg-blue-600 transition duration-300">
                {{ isset($product->id) ? 'Update Product' : 'Create Product' }}
            </button>
        </div>
    </form>
</div>
