<div>
    <!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
    @foreach($products as $product)
        <div>
            <h3>Name:{{ $product->name }}</h3>
            <p>Description: {{ $product->description }}</p>
            <p>Quantity: {{ $product->quantity }}</p>
            <p>Type: {{ $product->types }}</p>
            <p>Price: Rs {{ $product->price }}</p>
            <form action="{{ "/cart/add/{$product->id}" }}" method="POST">
                @csrf
                <button type="submit" @if($product->quantity <= 0) disabled @endif>Add to cart</button>
            </form>

    @endforeach


</div>