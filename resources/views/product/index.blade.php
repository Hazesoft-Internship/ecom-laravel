<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <div class=" p-2 flex gap-16 ">
    @foreach ($products as $product )
    <a href="/product/{{ $product["id"] }}">
        <div class=" bg-blue-200 p-11">
    <p>Name:{{ $product['name'] }}</p>
    <p>quantity:{{ $product['price'] }}</p>
    <p>price:{{ $product['quantity'] }}</p>
</div>
</a>

@endforeach
</div>
    <a href="/product/my-product"><button class=" p-2 bg-blue-600 text-white rounded-[3px] m-2">my product</button></a>
    <a href="/cart"><button class=" p-2 bg-gray-600 text-white rounded-[3px] m-2">my cart</button></a>
</body>
</html>