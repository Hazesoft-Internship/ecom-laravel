
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .product-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product-form h1 {
            margin-bottom: 20px;
        }

        .product-form input {
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .product-form input[type="submit"] {
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
        }

        .logout-form {
            margin-top: 20px;
        }

        .logout-form input[type="submit"] {
            background-color: #dc3545;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
        }

        select {
            padding: 10px;
            width: 80%;
            font-size: small;
        }
    </style>
</head>

<body>
<div class="product-form">
    <h1>Product Store</h1>

    <form action="/updateproduct-submit/{{$product->id}}" method="post">
        @csrf
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" value="{{ $product->name }}" required><br><br>

        <label for="price">Product Price:</label>
        <input type="number" id="price" name="price" step="1" value="{{ $product->price }}" required><br><br>

        <label for="quantity">Product Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="{{ $product->quantity }}" required><br><br>

        <select id="type" name="type" required>
            <option value="Physical" {{ $product->type === 'Physical' ? 'selected' : '' }}>Physical</option>
            <option value="Digital" {{ $product->type === 'Digital' ? 'selected' : '' }}>Digital</option>
        </select><br /><br />

        <input type="submit" name="product-submit" value="Submit">
    </form>
    <form action="/logout" onclick="return confirm('Are you sure?');" method="get" class="logout-form">
        <input type="submit" name="logout" value="Logout">
    </form>
</div>
</body>

</html>

