<!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
 
<div class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-center mb-6">Product List</h2>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Description</th>
                    <th class="px-6 py-3">Quantity</th>
                    <th class="px-6 py-3">Type</th>
                    <th class="px-6 py-3">Price (Rs)</th>
                    <th class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($products as $product)
                    <tr>
                        <td class="px-6 py-4">{{ $product->name }}</td>
                        <td class="px-6 py-4">{{ $product->description }}</td>
                        <td class="px-6 py-4">{{ $product->quantity }}</td>
                        <td class="px-6 py-4">{{ $product->types }}</td>
                        <td class="px-6 py-4 font-semibold">{{ $product->price }}</td>
                        <td class="px-6 py-4 flex space-x-2 justify-center">
                            <form action="{{ url("/product/update/{$product->id}") }}" method="GET">
                                @csrf
                                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">
                                    Edit
                                </button>
                            </form>
                            <form action="{{ url("/product/delete/{$product->id}") }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

