<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <form method="POST" action="/cart/update">
        @csrf
        @method('PATCH')
    
    <div class=" px-11">
    <h1 class=" text-5xl font-bold text-amber-700 mb-8">Carts </h1>
    @foreach ($cartItems as $cartItem)
    <div class="flex flex-col text-[16px] mb-6">

    <p class="">Product Name : {{ $cartItem->product->name }}
        <div class="flex gap-4">
        <p>quantity</p>
        <input class=" border border-amber-700" type="number" name="quantities[{{ $cartItem->id }}]" value="{{ $cartItem->quantity }}"/>
        @error('quantity')
        {{ $message }}
        @enderror
    </div>
    <p class="">Price : {{ $cartItem->product->price * $cartItem->quantity }}
          
                            <button form="delete-form-{{ $cartItem->id }}" class="bg-red-100 text-red-700 px-3 py-1 rounded hover:bg-red-200 transition">
                                Delete
                            </button>
         
    </div>
    
    @endforeach
    
    <button type="submit" class=" border bg-amber-900 text-white p-2 rounded-2xl">checkout</button>

    
</div>
</form>
     @foreach ($cartItems as $cartItem)
            <form action="/cart/delete/{{ $cartItem->id }}" method="POST" id="delete-form-{{ $cartItem->id }}">
                @csrf
            </form>
            @endforeach

</body>

</html>