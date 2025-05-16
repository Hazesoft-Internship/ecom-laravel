<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
            background-color: #f8f8f8;
        }

        .total-row {
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Checkout</h1>

        <form action="/addorder-submit/{{ $cartItems['cart_id'] }}" method="post">

            @csrf
            <div class="form-group">
                <label for="address">Shipping Address</label>
                <textarea
                    id="address"
                    name="address"
                    rows="4"
                    placeholder="Enter your shipping address" required></textarea>
            </div>
            <div class="form-group">
                <label for="paymentType">Payment Type</label>
                <select id="paymentType" name="paymentType">

                    @foreach ($cartItems['availablePaymentMethod'] as $paymentType )
                    <option value={{$paymentType}}>
                        {{$paymentType}}
                    </option>
                    @endforeach


                </select>
            </div>
            <h2>Cart Details</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($cartItems["products"] as $item)
                    <tr>
                        <td>{{$item['product_name']}}</td>
                        <td>{{$item['cart_quantity']}}</td>
                        <td>
                            {{$item['product_price']}}
                        </td>
                        <td>
                            {{$item['product_price'] * $item['cart_quantity'], 2}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>

                    <tr>
                        <td colspan="3" class="total-row">Tax</td>
                        <td class="total-row" name="tax">
                            {{$cartItems["tax"]}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="total-row">Grand Total</td>
                        <td class="total-row" name="total">
                            {{$cartItems["grandTotal"]}}
                        </td>
                    </tr>
                </tfoot>
            </table>
            <div style="text-align: center; margin-top: 20px">
                <button type="submit" class="btn">Place Order</button>
            </div>
        </form>
    </div>
</body>

</html>