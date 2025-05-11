<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
{{ $product["name"] }}    
{{ $product["price"] }}    
{{ $product["quantity"] }}    
{{ $product->user->first_name }}

    @csrf
    @can('edit-product', $product)
      <a href="/product/{{ $product["id"] }}/edit">

    <button type="submit" class="rounded-md m-2 bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">edit</button>
      </a>
    @endcan
@can('add-to-cart', $product)
<form method="POST" action="/cart/{{ $product["id"] }}">
    @csrf
    @error('quantity')
    <div class=" text-red-500">{{ $message }}</div>
    @enderror
<button type="submit">add to cart</button>
</form>
@endcan
</body>
</html>