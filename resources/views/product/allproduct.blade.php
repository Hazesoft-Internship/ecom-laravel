<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Product List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .actions form {
            display: flex;
            gap: 5px;
            align-items: center;
        }

        .actions input[type="number"] {
            width: 60px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .actions button {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            background-color: #28a745;
            color: white;
        }


    </style>
</head>

<body>
<div class="container">
    <h1>Product List</h1>
    <div
        style="
          display: flex;
          justify-content: space-between;
          align-items: center;
        ">
        <div>
            <a href="/addproduct" class="add-product">Add Product</a>
            <a href="/myproducts" class="my-product">My Products</a>
        </div>
        <div>
            <a href="/mycart" class="my-cart">Carts</a>
            <a href="/orderHistory" class="my-cart">Order History</a>
        </div>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td class="actions">
                    <form action="/addtocart-submit/{{$product->id}}" method="post">
                    @csrf
                        <input
                        type="number"
                        name="quantity"
                        value="1"
                        min="1"
                        max="{{$product->quantity}}"
                        required/>
                    <button
                        type="submit"
                        name="productID"
                        value="1">
                        Add to Cart
                    </button>
                    </form>
                </td>
            </tr>
        @endforeach

        @csrf
        <form
            action="/logout"
            onclick="return confirm('Are you sure?');"
            method="get"
            class="logout-form">
            <input type="submit" name="logout" value="Logout"/>
        </form>
</div>
</body>

</html>
