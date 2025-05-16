<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Product List</title>
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

        .actions button {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .edit {
            background-color: #ffc107;
            color: #fff;
        }

        .delete {
            background-color: #dc3545;
            color: #fff;
        }


        .logout-form {
            text-align: center;
            margin-top: 20px;
        }

        .logout-form input[type="submit"] {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>Product List</h1>
    <a href="/addproduct" class="add-product">Add Product</a>
    <a href="/allproducts" class="my-product">All Products</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        @if(!empty($products))
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{ $product->name }}</td>
                    <td>Rs. {{$product->price}}</td>
                    <td>{{ $product->quantity }}</td>
                    <td class="actions">
                        <a href="/updateproduct/{{$product->id}}">
                            <button class="edit">Update</button>
                        </a>
                        <form action="/deleteproduct-submit/{{$product->id}}" method="post" style="display:inline;">
                            @csrf
                            <button type="submit" class="delete" onclick="return confirm('Are you sure?');">Delete
                            </button>
                        </form>
                    </td>
                </tr>

            @endforeach
        @else
            <tr>
                <td colspan="4" style="text-align: center;">No products available.</td>
            </tr>
        @endif
    </table>
    <form action="/logout" onclick="return confirm('Are you sure?');" method="get" class="logout-form">
        <input type="submit" name="logout" value="Logout">
    </form>
</div>
</body>

</html>
